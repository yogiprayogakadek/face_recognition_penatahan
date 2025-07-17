<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\FaceEncoding;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log; // Import Log Facade

class MainController extends Controller
{
    public function showAbsensiPage()
    {
        $rules = Rule::where('is_active', true)->get();
        return view('index', compact('rules'));
    }

    // Metode ini sekarang hanya akan digunakan jika Anda ingin frontend juga memuat encodings secara terpisah
    // Jika semua perbandingan di backend, maka metode ini bisa dipertimbangkan untuk dihapus/disesuaikan
    public function getFaceEncodings()
    {
        try {
            $encodings = FaceEncoding::all()->map(function ($item) {
                return [
                    'label' => $item->pegawai->nama,
                    'descriptors' => $item->encodings // Pastikan ini array PHP karena casting di model
                ];
            })->toArray();

            return response()->json($encodings);
        } catch (\Exception $e) {
            Log::error('Error fetching face encodings for frontend: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengambil data encodings wajah untuk frontend: ' . $e->getMessage()
            ], 500);
        }
    }

    public function verifyFace(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image'
            ]);

            // AMBIL SEMUA ENCODINGS DARI DATABASE UNTUK DIKIRIM KE PYTHON API
            $encodings = FaceEncoding::all()->map(function ($item) {
                return [
                    'pegawai_id' => $item->pegawai_id,
                    'encoding' => $item->encodings // ini akan jadi array PHP jika ada cast di model
                ];
            })->toArray();

            // PENTING: Encode array encodings menjadi JSON string sebelum dikirim
            $knownEncodingsJson = json_encode($encodings);

            $response = Http::asMultipart()
                ->attach('image', fopen($request->file('image')->getRealPath(), 'r'), 'input.jpg')
                // AKTIFKAN KEMBALI DAN KIRIM known_encodings KE PYTHON API
                ->attach('known_encodings', $knownEncodingsJson, 'known_encodings.json')
                ->timeout(20) // Tambah timeout sedikit untuk proses yang lebih lama
                ->post(config('services.python_api.url') . '/verify_face');

            if (!$response->successful()) {
                Log::error('Python API connection failed or returned error: ' . $response->body());
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal koneksi atau respons dari server Python.',
                    'details' => $response->body() // Tambahkan detail untuk debugging
                ], $response->status()); // Gunakan status code dari Python API
            }

            $data = $response->json();

            // Log respons dari Python API untuk debugging
            Log::info('Python API response: ' . json_encode($data));

            // Periksa apakah ada masalah di respons Python (misal: "error" key)
            if (isset($data['error'])) {
                return response()->json([
                    'status' => false,
                    'message' => $data['error']
                ], 400); // Bad request from Python
            }

            // Jika Python API mengembalikan descriptor dan perbandingan dilakukan di JS,
            // maka logika di bawah ini akan diubah.
            // Saat ini, saya berasumsi Python API langsung mengembalikan 'matched' dan 'pegawai_id'
            if (!isset($data['matched']) || !$data['matched']) {
                return response()->json([
                    'status' => false,
                    'message' => 'Wajah tidak dikenali atau tidak cocok.'
                ]);
            }

            $now = now()->setTimezone('Asia/Makassar');
            $nowTime = $now->format('H:i:s');
            $today = $now->copy()->startOfDay();

            $rules = Rule::where('is_active', true)->get();
            $ruleMasuk = $rules->firstWhere('tipe', 'masuk');
            $rulePulang = $rules->firstWhere('tipe', 'pulang');

            $tipe = null;

            if ($ruleMasuk && $nowTime >= $ruleMasuk->start_time && $nowTime <= $ruleMasuk->end_time) {
                $tipe = 'masuk';
            } elseif ($rulePulang && $nowTime >= $rulePulang->start_time) { // Cek hanya start_time untuk pulang
                // Jika ada end_time, periksa juga
                if ($rulePulang->end_time && $nowTime > $rulePulang->end_time) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Waktu absensi pulang sudah melewati batas (hingga ' . Carbon::parse($rulePulang->end_time)->format('H:i') . ' WITA).'
                    ]);
                }
                $tipe = 'pulang';
            }


            if (!$tipe) {
                // Tentukan pesan yang lebih informatif jika tidak ada aturan yang cocok
                $messageParts = [];
                if ($ruleMasuk) {
                    $messageParts[] = 'masuk pada ' . Carbon::parse($ruleMasuk->start_time)->format('H:i');
                }
                if ($rulePulang) {
                    $messageParts[] = 'pulang pada ' . Carbon::parse($rulePulang->start_time)->format('H:i');
                }
                $message = 'Belum waktunya absensi. Waktu absensi ' . implode(' dan ', $messageParts) . ' WITA.';

                return response()->json([
                    'status' => false,
                    'message' => $message
                ]);
            }

            $already = Kehadiran::where('pegawai_id', $data['pegawai_id'])
                ->where('tipe', $tipe)
                ->where('tanggal_absensi', $today) // Memastikan absensi hari ini
                ->exists();

            if ($already) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda sudah absen ' . $tipe . ' hari ini.'
                ]);
            }

            $isLate = false;
            $activeRule = $rules->firstWhere('tipe', $tipe);

            if ($tipe === 'masuk' && $activeRule && $activeRule->late_after && $nowTime > $activeRule->late_after) {
                $isLate = true;
            }

            Kehadiran::create([
                'pegawai_id' => $data['pegawai_id'],
                'aturan_kehadiran_id' => $activeRule->id ?? null, // Aturan mungkin null jika tidak ada
                'tipe' => $tipe,
                'checked_in_at' => $now,
                'is_late' => $isLate,
                'tanggal_absensi' => Carbon::now()->setTimezone('Asia/Makassar')->toDateString() // Simpan tanggal saja
            ]);

            $pegawai = Pegawai::find($data['pegawai_id']);

            return response()->json([
                'status' => true,
                'message' => ($isLate ? 'terlambat ' : '') . 'berhasil ' . $tipe . '.',
                'late' => $isLate,
                'nama' => $pegawai ? $pegawai->nama : 'Pengguna'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::warning('Validation Error in verifyFace: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal: ' . $e->getMessage(),
                'errors' => $e->errors()
            ], 422); // Unprocessable Entity
        } catch (\Exception $e) {
            Log::error('General Error in verifyFace: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server: ' . $e->getMessage()
            ], 500);
        }
    }
}
