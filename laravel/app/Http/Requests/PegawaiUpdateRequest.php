<?php

namespace App\Http\Requests;

use App\Models\Pegawai;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PegawaiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $pegawai = Pegawai::find($this->route('id'));
        $userId = $pegawai?->user_id; // safe navigation
        return [
            'nama' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'nomor_telp' => ['required', 'regex:/^(^\+62|62|0)[2-9]{1}[0-9]{7,11}$/'],
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'status_perkawinan' => 'required|in:belum kawin,kawin,cerai hidup,cerai mati',
            'pendidikan_terakhir' => 'required|in:tidak sekolah,sd,smp,sma,d1,d2,d3,d4,s1,s2,s3',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'alamat' => 'required|string',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional, hanya jika upload baru
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'nomor_telp.required' => 'Nomor telepon wajib diisi.',
            'nomor_telp.regex' => 'Format nomor telepon tidak valid. Gunakan format Indonesia, contoh: 081234567890 atau +6281234567890.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus laki-laki atau perempuan.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'status_perkawinan.in' => 'Status perkawinan tidak valid.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
            'pendidikan_terakhir.in' => 'Pendidikan terakhir tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto_profil.image' => 'File foto harus berupa gambar.',
            'foto_profil.mimes' => 'Format foto harus jpeg, jpg, atau png.',
            'foto_profil.max' => 'Ukuran foto maksimal 2MB.',
        ];
    }
}
