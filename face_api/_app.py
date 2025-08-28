import os
import json
import numpy as np
from dotenv import load_dotenv
from flask import Flask, request, jsonify
from flask_cors import CORS
import face_recognition
from PIL import Image
import io
import logging

import mysql.connector

# Load variabel dari .env
load_dotenv()

# Ambil dari .env
DEBUG_MODE = os.getenv("FLASK_DEBUG", "false").lower() == "true"
PORT = int(os.getenv("FLASK_RUN_PORT", 5000))
THRESHOLD = float(os.getenv("FACE_MATCH_THRESHOLD", 0.5))

app = Flask(__name__)
CORS(app)  # Mengizinkan akses lintas-origin (dari Laravel atau frontend lainnya)

# Inisialisasi logging ke file dan terminal
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[
        logging.FileHandler("log.txt", encoding='utf-8'),
        logging.StreamHandler()
    ]
)

# Fungsi untuk ambil semua encoding dari database
def load_all_encodings():
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="db_face_recognition_penatahan"
    )
    cursor = conn.cursor(dictionary=True)
    cursor.execute("SELECT pegawai_id, encodings FROM face_encodings")
    result = cursor.fetchall()
    conn.close()

    # Convert string encodings ke list of float
    encodings_list = []
    for row in result:
        try:
            enc_data = json.loads(row['encodings'])
            if isinstance(enc_data, list) and len(enc_data) > 0 and isinstance(enc_data[0], list):
                enc = np.array(enc_data[0])
                encodings_list.append({
                    'pegawai_id': row['pegawai_id'],
                    'encoding': enc
                })
            else:
                logging.warning(f"⚠️ Data encoding untuk pegawai_id {row['pegawai_id']} tidak valid.")
        except Exception as e:
            logging.error(f"❌ Gagal memuat encoding untuk pegawai_id {row['pegawai_id']}: {e}")

    return encodings_list


@app.route('/register_face', methods=['POST'])
def register_face():
    images = request.files.getlist('images[]')
    pegawai_id = request.form.get('pegawai_id')

    logging.info(f"Menerima permintaan register_face untuk pegawai_id: {pegawai_id}")
    logging.info(f"Jumlah gambar diterima: {len(images)}")

    if not images:
        logging.warning("⚠️ Tidak ada gambar yang dikirim.")
        return jsonify({"error": "Tidak ada gambar yang dikirim"}), 400

    encodings = []
    for i, img_file in enumerate(images):
        logging.info(f"Memproses gambar ke-{i+1} (Nama file: {img_file.filename})")
        try:
            if img_file.content_length == 0:
                logging.warning(f"⚠️ Gambar ke-{i+1} kosong, dilewati.")
                continue

            # Coba buka gambar
            try:
                img_pil = Image.open(img_file.stream)
                logging.info(f"✔️ Gambar ke-{i+1} berhasil dibuka.")
            except Exception as e:
                logging.error(f"❌ Gambar ke-{i+1}: Tidak bisa membuka gambar: {e}")
                continue

            # Konversi ke RGB jika belum
            if img_pil.mode != 'RGB':
                img_pil = img_pil.convert('RGB')
                logging.info(f"Gambar ke-{i+1}: Dikonversi ke RGB.")

            # Info gambar
            logging.info(f"Gambar ke-{i+1}: Tipe: {img_pil.mode}, Ukuran: {img_pil.size}")

            # Convert ke numpy
            img = np.array(img_pil)

            # Ekstrak face encoding
            faces = face_recognition.face_encodings(img)
            if faces:
                encodings.append(faces[0])
                logging.info(f"✅ Gambar ke-{i+1}: Face encoding berhasil diambil ({len(faces)} wajah terdeteksi).")
            else:
                logging.warning(f"⚠️ Gambar ke-{i+1}: Tidak ada wajah terdeteksi dalam gambar ini.")
        except Exception as e:
            logging.error(f"❌ Gambar ke-{i+1}: Gagal memproses gambar: {e}", exc_info=True) # Tambah exc_info=True untuk stack trace
            continue

    if not encodings:
        logging.error("❌ Setelah memproses semua gambar, tidak ada wajah yang terdeteksi.")
        return jsonify({"error": "Tidak ada wajah terdeteksi"}), 400

    mean_encoding = np.mean(encodings, axis=0)
    logging.info(f"Berhasil menghitung rata-rata encoding dari {len(encodings)} wajah.")

    # Cek duplikat
    known_encodings = load_all_encodings()
    logging.info(f"Memuat {len(known_encodings)} encoding dari database untuk pemeriksaan duplikat.")
    for item in known_encodings:
        if str(item['pegawai_id']) == str(pegawai_id):
            continue

        match = face_recognition.compare_faces(
            [item['encoding']], mean_encoding, tolerance=0.45
        )
        if match[0]:
            logging.warning(f"⚠️ Wajah yang didaftarkan sudah terdaftar pada pegawai_id: {item['pegawai_id']}")
            return jsonify({
                "error": "Wajah sudah terdaftar pada akun lain",
                "matched_pegawai_id": item['pegawai_id']
            }), 409

    logging.info(f"Pendaftaran wajah untuk pegawai_id {pegawai_id} berhasil.")
    return jsonify({"encodings": mean_encoding.tolist()})

@app.route('/verify_face', methods=['POST'])
def verify_face():
    image = request.files.get('image')
    
    encodings_file = request.files.get('known_encodings')
    encodings_raw = request.form.get('known_encodings')

    if encodings_file:
        encodings_raw = encodings_file.read().decode('utf-8')
    elif not encodings_raw:
        logging.error("❌ Field 'known_encodings' tidak ditemukan dalam request.files maupun request.form.")
        return jsonify({"matched": False, "error": "Field 'known_encodings' tidak ditemukan"}), 400

    if not image or image.content_length == 0:
        logging.error("❌ Gambar tidak ditemukan atau kosong untuk verifikasi.")
        return jsonify({"matched": False, "error": "Gambar tidak ditemukan"}), 400

    try:
        known_encodings = json.loads(encodings_raw)
        logging.info(f"Berhasil memuat {len(known_encodings)} known encodings untuk verifikasi.")
    except Exception as e:
        logging.error(f"❌ Data encoding rusak saat parse JSON: {e}", exc_info=True)
        return jsonify({
            "matched": False,
            "error": "Data encoding rusak",
            "detail": str(e)
        }), 400

    try:
        img_pil = Image.open(image.stream).convert('RGB')
        img = np.array(img_pil)
        logging.info(f"Gambar verifikasi dibuka. Tipe: {img_pil.mode}, Ukuran: {img_pil.size}")

        unknown_encs = face_recognition.face_encodings(img)
        if not unknown_encs:
            logging.warning("⚠️ Tidak ada wajah ditemukan dalam gambar verifikasi.")
            return jsonify({"matched": False, "error": "Tidak ada wajah ditemukan"}), 400

        unknown_enc = unknown_encs[0]
        logging.info("Wajah terdeteksi dalam gambar verifikasi.")

        for item in known_encodings:
            try:
                encoding_data = item.get("encoding")
                if not encoding_data:
                    logging.warning(f"⚠️ Item encoding untuk pegawai_id {item.get('pegawai_id', 'unknown')} tidak memiliki data encoding.")
                    continue
                
                encoding = np.array(encoding_data)
                
                distance = face_recognition.face_distance([encoding], unknown_enc)[0]
                logging.info(f"Membandingkan dengan pegawai_id {item.get('pegawai_id', 'unknown')}, Jarak: {distance:.4f} (Threshold: {THRESHOLD})")

                if distance < THRESHOLD:
                    logging.info(f"✅ Wajah cocok dengan pegawai_id: {item.get('pegawai_id', 'unknown')}")
                    return jsonify({"matched": True, "pegawai_id": item.get("pegawai_id", None)})
            except Exception as e:
                logging.error(f"❌ Gagal membandingkan encoding untuk pegawai_id {item.get('pegawai_id', 'unknown')}: {e}", exc_info=True)
                continue

        logging.info("Tidak ada wajah yang cocok ditemukan.")
        return jsonify({"matched": False})
    except Exception as e:
        logging.error(f"❌ Gagal memproses gambar verifikasi: {e}", exc_info=True)
        return jsonify({
            "matched": False,
            "error": "Gagal memproses gambar",
            "detail": str(e)
        }), 500

if __name__ == '__main__':
    app.run(debug=DEBUG_MODE, port=PORT)