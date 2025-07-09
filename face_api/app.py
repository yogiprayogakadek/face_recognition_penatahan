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
        enc = np.array(eval(row['encodings']))
        encodings_list.append({
            'pegawai_id': row['pegawai_id'],
            'encoding': enc
        })
    return encodings_list


# Inisialisasi logging ke file dan terminal
logging.basicConfig(
    level=logging.INFO,
    format="%(asctime)s [%(levelname)s] %(message)s",
    handlers=[
        logging.FileHandler("log.txt", encoding='utf-8'),
        logging.StreamHandler()
    ]
)

@app.route('/register_face', methods=['POST'])
def register_face():
    images = request.files.getlist('images[]')
    pegawai_id = request.form.get('pegawai_id')

    if not images:
        return jsonify({"error": "Tidak ada gambar yang dikirim"}), 400

    encodings = []
    for img_file in images:
        try:
            if img_file.content_length == 0:
                logging.warning("⚠️ File kosong dilewati.")
                continue

            # Coba buka gambar
            try:
                img_pil = Image.open(img_file.stream)
                logging.info("✔️ Gambar berhasil dibuka.")
            except Exception as e:
                logging.error(f"❌ Tidak bisa membuka gambar: {e}")
                continue

            # Konversi ke RGB jika belum
            if img_pil.mode != 'RGB':
                img_pil = img_pil.convert('RGB')

            # Info gambar
            logging.info(f"Tipe gambar: {img_pil.mode}, Ukuran: {img_pil.size}")

            # Convert ke numpy
            img = np.array(img_pil)

            # Ekstrak face encoding
            faces = face_recognition.face_encodings(img)
            if faces:
                encodings.append(faces[0])
                logging.info("✅ Face encoding berhasil diambil.")
            else:
                logging.warning("⚠️ Tidak ada wajah terdeteksi dalam gambar.")
        except Exception as e:
            logging.error(f"❌ Gagal memproses gambar: {e}")
            continue


    if not encodings:
        return jsonify({"error": "Tidak ada wajah terdeteksi"}), 400

    mean_encoding = np.mean(encodings, axis=0)

    # Cek duplikat
    known_encodings = load_all_encodings()
    for item in known_encodings:
        if str(item['pegawai_id']) == str(pegawai_id):
            continue

        match = face_recognition.compare_faces(
            [item['encoding']], mean_encoding, tolerance=0.45
        )
        if match[0]:
            return jsonify({
                "error": "Wajah sudah terdaftar pada akun lain",
                "matched_pegawai_id": item['pegawai_id']
            }), 409

    return jsonify({"encodings": mean_encoding.tolist()})

@app.route('/verify_face', methods=['POST'])
def verify_face():
    image = request.files.get('image')
    encodings_raw = request.form.get('known_encodings')

    if not image or image.content_length == 0:
        return jsonify({"matched": False, "error": "Gambar tidak ditemukan"}), 400

    if not encodings_raw:
        return jsonify({"matched": False, "error": "Field 'known_encodings' tidak ditemukan"}), 400

    try:
        known_encodings = json.loads(encodings_raw)
    except Exception as e:
        return jsonify({
            "matched": False,
            "error": "Data encoding rusak",
            "detail": str(e)
        }), 400

    try:
        img_pil = Image.open(image.stream).convert('RGB')
        img = np.array(img_pil)

        unknown_encs = face_recognition.face_encodings(img)
        if not unknown_encs:
            return jsonify({"matched": False, "error": "Tidak ada wajah ditemukan"}), 400

        unknown_enc = unknown_encs[0]

        for item in known_encodings:
            encoding = item["encoding"] if isinstance(item, dict) and "encoding" in item else item
            distance = face_recognition.face_distance([encoding], unknown_enc)[0]
            if distance < THRESHOLD:
                return jsonify({"matched": True, "pegawai_id": item.get("pegawai_id", None)})

        return jsonify({"matched": False})
    except Exception as e:
        return jsonify({
            "matched": False,
            "error": "Gagal memproses gambar",
            "detail": str(e)
        }), 500

if __name__ == '__main__':
    app.run(debug=DEBUG_MODE, port=PORT)
