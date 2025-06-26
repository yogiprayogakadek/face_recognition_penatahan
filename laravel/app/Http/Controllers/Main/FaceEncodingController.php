<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\FaceEncoding;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FaceEncodingController extends Controller
{
    protected $pythonApiURL;

    public function __construct()
    {
        $this->pythonApiURL = config('services.python_api.url');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $data = Pegawai::with('faceEncoding')->get();
            return view('main.face_encoding.index', compact('data'));
        }

        abort_if(!$user->pegawai, 404, 'Pegawai tidak ditemukan.');

        return view('main.face_encoding.pegawai.index', [
            'data' => $user->pegawai
        ]);
    }

    public function create($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $this->authorize('manageFaceEncoding', $pegawai);

        $view = auth()->user()->role === 'admin'
            ? 'main.face_encoding.create'
            : 'main.face_encoding.pegawai.create';

        return view($view, compact('pegawai'));
    }

    // public function registerFace(Request $request)
    // {
    //     try {
    //         // Validasi
    //         $request->validate([
    //             'images' => 'required|array|min:1',
    //             'images.*' => 'image|mimes:jpg,jpeg,png'
    //         ]);
    //     } catch (\Illuminate\Validation\ValidationException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $e->errors()
    //         ], 422);
    //     }

    //     $pegawaiId = $request->pegawai_id; // dari request ajax

    //     // Kirim semua images ke server Flask
    //     $formData = [];

    //     foreach ($request->file('images') as $i => $img) {
    //         $formData[] = [
    //             'name'     => "images[]",
    //             'contents' => fopen($img->getRealPath(), 'r'),
    //             'filename' => "image{$i}.jpg"
    //         ];
    //     }

    //     try {
    //         $http = Http::timeout(10);

    //         foreach ($request->file('images') as $i => $img) {
    //             $http = $http->attach(
    //                 'images[]',
    //                 fopen($img->getRealPath(), 'r'),
    //                 "image{$i}.jpg"
    //             );
    //         }

    //         // PADA FLASK
    //         $response = $http->post($this->pythonApiURL . '/register_face', [
    //             'pegawai_id' => $pegawaiId
    //         ]);

    //         $body = $response->json();

    //         \Log::info('Response dari Python:', $body);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Gagal terhubung ke server Python',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }

    //     if (!$response->successful()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Python server error',
    //             'response' => $response->body()
    //         ], 500);
    //     }

    //     // Simpan hasil encoding ke DB
    //     $data = $response->json();
    //     FaceEncoding::updateOrCreate(
    //         ['pegawai_id' => $pegawaiId],
    //         ['encodings' => $data['encodings']] // JSON format
    //     );

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Wajah berhasil diregistrasi'
    //     ]);
    // }

    public function registerFace(Request $request)
    {
        try {
            $request->validate([
                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpg,jpeg,png'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 422);
        }

        $pegawaiId = $request->pegawai_id;

        try {
            $http = Http::timeout(15);
            foreach ($request->file('images') as $i => $img) {
                $http = $http->attach(
                    'images[]',
                    fopen($img->getRealPath(), 'r'),
                    "image{$i}.jpg"
                );
            }

            $response = $http->post($this->pythonApiURL . '/register_face', [
                'pegawai_id' => $pegawaiId
            ]);

            if ($response->status() === 409) {
                $matchedId = $response->json()['matched_pegawai_id'];
                $matchedPegawai = Pegawai::find($matchedId);

                return response()->json([
                    'status' => false,
                    'message' => $response->json()['error'],
                    'matched_pegawai_id' => $matchedId,
                    'matched_pegawai_nama' => $matchedPegawai ? $matchedPegawai->nama : 'Tidak ditemukan'
                ], 409);
            }

            if (!$response->successful()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Python server error',
                    'response' => $response->body()
                ], 500);
            }

            $data = $response->json();

            FaceEncoding::updateOrCreate(
                ['pegawai_id' => $pegawaiId],
                ['encodings' => $data['encodings']]
            );

            return response()->json([
                'status' => true,
                'message' => 'Wajah berhasil diregistrasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal terhubung ke server Python',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // public function verifyFace(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image'
    //     ]);

    //     $encodings = FaceEncoding::all()->map(function ($item) {
    //         return [
    //             'pegawai_id' => $item->pegawai_id,
    //             'encoding' => $item->encodings
    //         ];
    //     })->toArray();

    //     $response = Http::asMultipart()
    //         ->attach('image', fopen($request->file('image')->getRealPath(), 'r'), 'input.jpg')
    //         ->attach('known_encodings', json_encode($encodings))
    //         ->timeout(10)
    //         ->post($this->pythonApiURL . '/verify_face');

    //     if (!$response->successful()) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Gagal koneksi ke server Python',
    //             'data' => $response->body()
    //         ], 500);
    //     }

    //     $data = $response->json();

    //     if (!$data['matched']) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Wajah tidak dikenali.'
    //         ]);
    //     }

    //     $now = now()->setTimezone('Asia/Makassar');
    //     $nowTime = $now->format('H:i:s');

    //     // CARI RULE YANG SESUAI JAM SEKARANG
    //     $rule = Rule::where('start_time', '<=', $nowTime)
    //         ->where('end_time', '>=', $nowTime)
    //         ->first();

    //     if (!$rule) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Kamu tidak bisa absen di luar jam yang ditentukan.'
    //         ]);
    //     }

    //     $tipe = $rule->tipe; // 'masuk' atau 'pulang'
    //     $today = $now->copy()->startOfDay();

    //     // CEK APAKAH SUDAH ABSEN JENIS YANG SAMA HARI INI
    //     $already = Kehadiran::where('pegawai_id', $data['pegawai_id'])
    //         ->where('tipe', $tipe)
    //         ->where('checked_in_at', '>=', $today)
    //         ->exists();

    //     if ($already) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Kamu sudah absen ' . $tipe . ' hari ini.'
    //         ]);
    //     }

    //     // CEK KETERLAMBATAN
    //     $isLate = false;
    //     if ($rule->late_after && $nowTime > $rule->late_after) {
    //         $isLate = true;
    //     }

    //     // CARI RULE YANG AKTIF
    //     $activeRule = Rule::where('is_active', true)->first();

    //     // SIMPAN ABSENSI
    //     Kehadiran::create([
    //         'pegawai_id' => $data['pegawai_id'],
    //         'aturan_kehadiran_id' => $activeRule->id,
    //         'tipe' => $tipe,
    //         'checked_in_at' => $now,
    //         'is_late' => $isLate
    //     ]);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Absensi ' . $tipe . ' berhasil' . ($isLate ? ', namun kamu terlambat.' : '.'),
    //         'late' => $isLate
    //     ]);
    // }
}
