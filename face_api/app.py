import os
import json
import numpy as np
from dotenv import load_dotenv
from flask import Flask, request, jsonify
from flask_cors import CORS
import face_recognition

import mysql.connector

# Load variabel dari .env
load_dotenv()

# Ambil dari .env
DEBUG_MODE = os.getenv("FLASK_DEBUG", "false").lower() == "true"
PORT = int(os.getenv("FLASK_RUN_PORT", 5000))
THRESHOLD = float(os.getenv("FACE_MATCH_THRESHOLD", 0.5))

app = Flask(__name__)
CORS(app)  # Mengizinkan akses lintas-origin (dari Laravel atau frontend lainnya)


# @app.route('/register_face', methods=['POST'])
# def register_face():
#     images = request.files.getlist('images[]')
#     encodings = []

#     for img in images:
#         img_data = face_recognition.load_image_file(img)
#         faces = face_recognition.face_encodings(img_data)
#         if faces:
#             encodings.append(faces[0])  # Ambil wajah pertama saja

#     if not encodings:
#         return jsonify({"error": "Tidak ada wajah terdeteksi"}), 400

#     # Hitung rata-rata encoding
#     mean_encoding = np.mean(encodings, axis=0).tolist()
#     return jsonify({"encodings": mean_encoding})

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


@app.route('/register_face', methods=['POST'])
def register_face():
    images = request.files.getlist('images[]')
    pegawai_id = request.form.get('pegawai_id')

    encodings = []
    for img in images:
        img_data = face_recognition.load_image_file(img)
        faces = face_recognition.face_encodings(img_data)
        if faces:
            encodings.append(faces[0])  # Ambil wajah pertama

    if not encodings:
        return jsonify({"error": "Tidak ada wajah terdeteksi"}), 400

    mean_encoding = np.mean(encodings, axis=0)

    # Cek duplicate
    known_encodings = load_all_encodings()
    for item in known_encodings:
        if str(item['pegawai_id']) == str(pegawai_id):
            continue  # Skip jika dibandingkan dengan diri sendiri

        match = face_recognition.compare_faces(
            [item['encoding']], mean_encoding, tolerance=0.45
        )
        if match[0]:
            return jsonify({
                "error": "Wajah sudah terdaftar pada akun lain",
                "matched_pegawai_id": item['pegawai_id']
            }), 409  # 409 = Conflict

    return jsonify({"encodings": mean_encoding.tolist()})


@app.route('/verify_face', methods=['POST'])
def verify_face():
    image = request.files.get('image')
    encodings_raw = request.form.get('known_encodings')

    if not encodings_raw:
        return jsonify({
            "matched": False,
            "error": "Field 'known_encodings' tidak ada."
        }), 400

    try:
        known_encodings = json.loads(encodings_raw)
    except Exception as e:
        return jsonify({
            "matched": False,
            "error": "Data encoding tidak valid",
            "detail": str(e)
        }), 400

    unknown_image = face_recognition.load_image_file(image)
    unknown_encs = face_recognition.face_encodings(unknown_image)

    if not unknown_encs:
        return jsonify({"matched": False, "error": "Tidak ada wajah ditemukan"}), 400

    unknown_enc = unknown_encs[0]

    for item in known_encodings:
        encoding = item["encoding"] if isinstance(item, dict) and "encoding" in item else item
        distance = face_recognition.face_distance([encoding], unknown_enc)[0]
        if distance < THRESHOLD:
            return jsonify({"matched": True, "pegawai_id": item.get("pegawai_id", None)})

    return jsonify({"matched": False})


if __name__ == '__main__':
    app.run(debug=DEBUG_MODE, port=PORT)
