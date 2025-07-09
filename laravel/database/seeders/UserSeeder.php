<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

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

        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {
            $user = User::create([
                'email' => 'pegawai' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ]);

            Pegawai::create([
                'nama' => $faker->name,
                'nomor_telp' => substr(preg_replace('/\D/', '', $faker->phoneNumber), 0, 13),
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'status_perkawinan' => $faker->randomElement(['belum kawin', 'kawin']),
                'pendidikan_terakhir' => $faker->randomElement(['sma', 'd3', 's1', 's2']),
                'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => $faker->address
            ]);
        }
    }
}
