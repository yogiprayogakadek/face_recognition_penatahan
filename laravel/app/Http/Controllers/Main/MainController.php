<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\FaceEncoding;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MainController extends Controller
{
    // services.python_api.url
    public function showAbsensiPage()
    {
        $rules = Rule::where('is_active', true)->get();;
        return view('index', compact('rules'));
    }

    public function verifyFace(Request $request)
    {
        $request->validate([
            'image' => 'required|image'
        ]);

        $encodings = FaceEncoding::all()->map(function ($item) {
            return [
                'pegawai_id' => $item->pegawai_id,
                'encoding' => $item->encodings
            ];
        })->toArray();

        $response = Http::asMultipart()
            ->attach('image', fopen($request->file('image')->getRealPath(), 'r'), 'input.jpg')
            ->attach('known_encodings', json_encode($encodings))
            ->timeout(10)
            ->post(config('services.python_api.url') . '/verify_face');

        if (!$response->successful()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal koneksi ke server Python',
                'data' => $response->body()
            ], 500);
        }

        $data = $response->json();

        if (!$data['matched']) {
            return response()->json([
                'status' => false,
                'message' => 'Wajah tidak dikenali.'
            ]);
        }

        $now = now()->setTimezone('Asia/Makassar');
        $nowTime = $now->format('H:i:s');
        $today = $now->copy()->startOfDay();

        // Ambil semua aturan aktif
        $rules = Rule::where('is_active', true)->get();
        $ruleMasuk = $rules->firstWhere('tipe', 'masuk');
        $rulePulang = $rules->firstWhere('tipe', 'pulang');

        $tipe = null;

        // Tentukan tipe absensi berdasarkan waktu
        if ($ruleMasuk && $nowTime >= $ruleMasuk->start_time && $nowTime <= $ruleMasuk->end_time) {
            $tipe = 'masuk';
        } elseif ($rulePulang) {
            $endPulang = $rulePulang->end_time ?? '23:59:59';
            if ($nowTime >= $rulePulang->start_time && $nowTime <= $endPulang) {
                $tipe = 'pulang';
            } elseif ($rulePulang->end_time && $nowTime > $rulePulang->end_time) {
                return response()->json([
                    'status' => false,
                    'message' => 'Waktu absensi sudah melewati batas karena diatur sampai jam ' . $rulePulang->end_time . '.'
                ]);
            } elseif (!$rulePulang->end_time && $nowTime > '23:59:59') {
                return response()->json([
                    'status' => false,
                    'message' => 'Waktu absensi sudah melewati batas karena diatur sampai akhir hari.'
                ]);
            }
        }

        if (!$tipe) {
            return response()->json([
                'status' => false,
                'message' => 'Belum waktunya absensi.'
            ]);
        }

        // Cek apakah sudah absen hari ini
        $already = Kehadiran::where('pegawai_id', $data['pegawai_id'])
            ->where('tipe', $tipe)
            ->where('checked_in_at', '>=', $today)
            ->exists();

        if ($already) {
            return response()->json([
                'status' => false,
                'message' => 'Kamu sudah absen ' . $tipe . ' hari ini.'
            ]);
        }

        $isLate = false;
        $activeRule = $rules->firstWhere('tipe', $tipe);

        if ($tipe === 'masuk' && $activeRule && $activeRule->late_after && $nowTime > $activeRule->late_after) {
            $isLate = true;
        }

        Kehadiran::create([
            'pegawai_id' => $data['pegawai_id'],
            'aturan_kehadiran_id' => $activeRule->id,
            'tipe' => $tipe,
            'checked_in_at' => $now,
            'is_late' => $isLate
        ]);

        $pegawai = Pegawai::find($data['pegawai_id']);

        return response()->json([
            'status' => true,
            'message' => 'Absensi ' . $tipe . ' berhasil.',
            'late' => $isLate,
            'nama' => $pegawai ? $pegawai->nama : 'Pengguna'
        ]);
    }
}
