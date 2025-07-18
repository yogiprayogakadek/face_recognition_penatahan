<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        return view('main.profile.index', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $user = User::findOrFail($id);
        $pegawai = $user->pegawai; // asumsi: relasi 1:1 User -> Pegawai

        DB::beginTransaction();

        try {
            // Update email user
            $user->email = $request->email;

            // Ganti password jika ada input password baru
            if ($request->filled('new_password')) {
                $user->password = Hash::make($request->new_password);
            }

            $user->save();

            // Update data pegawai
            $pegawaiData = [
                'nama' => $request->nama,
                'nomor_telp' => $request->nomor_telp,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status_perkawinan' => $request->status_perkawinan,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'email' => $request->email,
                'alamat' => $request->alamat,
            ];

            // Cek dan update foto profil jika ada
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/assets/images/users/foto_profil', $filename);

                $pegawaiData['foto_profil'] = 'assets/images/users/foto_profil/' . $filename;
            }

            $pegawai->update($pegawaiData);

            DB::commit();
            return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui.');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);

            return back()->withInput()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
