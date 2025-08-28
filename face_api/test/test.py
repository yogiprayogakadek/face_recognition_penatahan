import face_recognition
from PIL import Image
import numpy as np

# Ganti dengan path ke gambar yang Anda gunakan untuk registrasi
image_path = "1.jpg" 

try:
    # Baca gambar menggunakan PIL
    img_pil = Image.open(image_path).convert('RGB')
    img_np = np.array(img_pil)

    print(f"Gambar berhasil dimuat. Ukuran: {img_pil.size}, Mode: {img_pil.mode}")

    # Deteksi wajah
    face_encodings = face_recognition.face_encodings(img_np)

    if face_encodings:
        print(f"✅ Wajah terdeteksi! Jumlah wajah: {len(face_encodings)}")
        # print(f"Encoding wajah pertama: {face_encodings[0][:10]}...") # Contoh: tampilkan 10 elemen pertama
    else:
        print("❌ Tidak ada wajah terdeteksi dalam gambar ini.")
except FileNotFoundError:
    print(f"Error: Gambar tidak ditemukan di {image_path}")
except Exception as e:
    print(f"Terjadi kesalahan saat memproses gambar: {e}")