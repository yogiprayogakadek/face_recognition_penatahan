<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
            'role' => 'admin',
            'is_active' => true
        ]);

        Pegawai::create([
            'nama' => 'Administrator',
            'nomor_telp' => '08223717787',
            'tempat_lahir' => 'Denpasar',
            'tanggal_lahir' => '1998-10-10',
            'jenis_kelamin' => 'Laki-laki',
            'status_perkawinan' => 'belum kawin',
            'pendidikan_terakhir' => 's2',
            'user_id' => $user->id,
            'foto_profil' => null,
            'alamat' => 'Denpasar'
        ]);
    }
}
