<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::whereHas('user', function ($query) {
            $query->where('role', 'pegawai');
        })->with('user')->get();
        return view('main.pegawai.index', compact('data'));
    }



    public function create()
    {
        return view('main.pegawai.create');
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->validated();

        DB::beginTransaction();

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make(12345678),
                'role' => 'pegawai'
            ]);

            if (!$user) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Gagal membuat user.');
            }

            // inisialisasi data pegawai
            $pegawai = [
                'nama' => $request->nama,
                'nomor_telp' => $request->nomor_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_perkawinan' => $request->status_perkawinan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'user_id' => $user->id,
            ];

            // Cek dan simpan foto profil jika ada
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/assets/images/users/foto_profil', $filename);

                $pegawai['foto_profil'] = 'assets/images/users/foto_profil/' . $filename;
            }

            // Simpan ke tabel pegawai
            $store = Pegawai::create($pegawai);

            if (!$store) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Gagal menyimpan data pegawai.');
            }

            DB::commit();

            return redirect()->back()->with('success', 'Data pegawai berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th); // Mencatat error ke log Laravel

            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $pegawai = Pegawai::with('user')->find($id);
        return view('main.pegawai.update', compact('pegawai'));
    }

    public function update(PegawaiUpdateRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $pegawai = Pegawai::findOrFail($id);

            // Update data pegawai
            $pegawai->update([
                'nama' => $data['nama'],
                'nomor_telp' => $data['nomor_telp'],
                'tempat_lahir' => $data['tempat_lahir'],
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'status_perkawinan' => $data['status_perkawinan'],
                'pendidikan_terakhir' => $data['pendidikan_terakhir'],
                // 'email' => $data['email'],
                'alamat' => $data['alamat'],
            ]);

            $pegawai->user->update([
                'email' => $data['email']
            ]);

            // Cek dan simpan foto profil jika ada
            if ($request->hasFile('foto_profil')) {
                // Hapus foto lama jika ada
                if ($pegawai->foto_profil && file_exists(public_path($pegawai->foto_profil))) {
                    unlink('public/assets/images/users/foto_profil/' . $pegawai->foto_profil);
                }

                $file = $request->file('foto_profil');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/assets/images/users/foto_profil', $filename);

                $pegawai->update([
                    'foto_profil' => 'assets/images/users/foto_profil/' . $filename,
                ]);
            }

            return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data. ' . $th->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User ' . ($user->is_active ? 'diaktifkan' : 'dinonaktifkan') . ' dengan sukses.'
        ]);
    }

    public function destroy($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);

            // Nonaktifkan user yang berelasi
            if ($pegawai->user) {
                $pegawai->user->update(['is_active' => false]);
            }

            // Hapus data pegawai
            $pegawai->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data pegawai berhasil dihapus dan user dinonaktifkan.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $th->getMessage()
            ], 500);
        }
    }

    public function showRestore()
    {
        $data = Pegawai::onlyTrashed()->get();
        // dd($data[0]->id);
        return view('main.pegawai.restore', compact('data'));
    }

    public function restore($id)
    {
        try {
            $pegawai = Pegawai::onlyTrashed()->findOrFail($id);
            $pegawai->restore();

            return response()->json([
                'status' => true,
                'message' => 'Data pegawai berhasil dipulihkan.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memulihkan data: ' . $th->getMessage()
            ], 500);
        }
    }
}
