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
            'jabatan' => 'admin',
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

        // for ($i = 1; $i <= 50; $i++) {
        //     $user = User::create([
        //         'email' => 'pegawai' . $i . '@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'role' => 'pegawai',
        //         'is_active' => true,
        //     ]);

        //     Pegawai::create([
        //         'nama' => $faker->name,
        //         'nomor_telp' => substr(preg_replace('/\D/', '', $faker->phoneNumber), 0, 13),
        //         'tempat_lahir' => $faker->city,
        //         'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
        //         'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
        //         'status_perkawinan' => $faker->randomElement(['belum kawin', 'kawin']),
        //         'pendidikan_terakhir' => $faker->randomElement(['sma', 'd3', 's1', 's2']),
        //         'user_id' => $user->id,
        //         'foto_profil' => null,
        //         'alamat' => $faker->address
        //     ]);
        // }

        $dataUser = [
            [
                'email' => 'i.nengah.suartika@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.made.dwi.wismaya.putra@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.wayan.sueca@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'ni.wayan.deli.ekayanti@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'ni.wayan.sri.mira.artini@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.wayan.gede.renata@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.nyoman.erik.rimbawa@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.nengah.suarma@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'sang.ayu.made.ayuningtyas@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.wayan.ari.sanjaya@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.wayan.widiarka@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.nengah.suaba.santika@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.nengah.suryawan@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'agus.ery.suryana@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'i.made.agustiana@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
            [
                'email' => 'made.dwi.adhigunarsa.putra@gmail.com',
                'password' => Hash::make('12345678'),
                'role' => 'pegawai',
                'is_active' => true,
            ],
        ];


        $dataPegawai = [
            [
                'nama' => 'I Nengah Suartika',
                'jabatan' => 'perbekel',
                'nomor_telp' => '087885540293',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Tegayang',
            ],
            [
                'nama' => 'I Made Dwi Wismaya Putra',
                'jabatan' => 'sekdes',
                'nomor_telp' => '085266396277',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'belum kawin',
                'pendidikan_terakhir' => 'd2',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Penatahan Kelod',
            ],
            [
                'nama' => 'I Wayan Sueca',
                'jabatan' => 'kaur perencanaan',
                'nomor_telp' => '082247377809',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Bedugul',
            ],
            [
                'nama' => 'Ni Wayan Deli Ekayanti',
                'jabatan' => 'kaur keuangan',
                'nomor_telp' => '085792093556',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Perempuan',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Kekeran',
            ],
            [
                'nama' => 'Ni Wayan Sri Mira Artini',
                'jabatan' => 'kasi kesra',
                'nomor_telp' => '082145709157',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Perempuan',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 's1',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Kekeran',
            ],
            [
                'nama' => 'I Wayan Gede Renata',
                'jabatan' => 'kaur pemerintahan',
                'nomor_telp' => '082144319161',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Mongan',
            ],
            [
                'nama' => 'I Nyoman Erik Rimbawa',
                'jabatan' => 'kaur umum',
                'nomor_telp' => '082341164757',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Penatahan Kaja',
            ],
            [
                'nama' => 'I Nengah Suarma',
                'jabatan' => 'kasi pelayanan',
                'nomor_telp' => '085101525976',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Tegayang',
            ],
            [
                'nama' => 'Sang Ayu Made Ayuningtyas',
                'jabatan' => 'stap operator',
                'nomor_telp' => '081703535800',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Perempuan',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 's1',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Penatahan Kelod',
            ],
            [
                'nama' => 'I Wayan Ari Sanjaya',
                'jabatan' => 'petugas kebersihan',
                'nomor_telp' => '083129521856',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'belum kawin',
                'pendidikan_terakhir' => 'smp',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Bedugul',
            ],
            [
                'nama' => 'I Wayan Widiarka',
                'jabatan' => 'kawil tegayang',
                'nomor_telp' => '081933160225',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'belum kawin',
                'pendidikan_terakhir' => 'd2',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Tegayang',
            ],
            [
                'nama' => 'I Nengah Suaba Santika',
                'jabatan' => 'kawil penatahan kelod',
                'nomor_telp' => '085338853748',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'P Kelod',
            ],
            [
                'nama' => 'I Nengah Suryawan',
                'jabatan' => 'kawil mongan',
                'nomor_telp' => '081237398939',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Mongan',
            ],
            [
                'nama' => 'Agus Ery Suryana',
                'jabatan' => 'kawil bedugul',
                'nomor_telp' => '08563718302',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Bedugul',
            ],
            [
                'nama' => 'I Made Agustiana',
                'jabatan' => 'kawil kekeran',
                'nomor_telp' => '085792836828',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 'slta',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Kekeran',
            ],
            [
                'nama' => 'Made Dwi Adhigunarsa Putra',
                'jabatan' => 'kawil penatahan kaja',
                'nomor_telp' => '082236449785',
                'tempat_lahir' => $faker->city,
                'tanggal_lahir' => $faker->date('Y-m-d', '2000-01-01'),
                'jenis_kelamin' => 'Laki-laki',
                'status_perkawinan' => 'kawin',
                'pendidikan_terakhir' => 's1',
                // 'user_id' => $user->id,
                'foto_profil' => null,
                'alamat' => 'Penatahan Kaja',
            ],
        ];

        foreach ($dataUser as $index => $dtUser) {
            $user = User::create($dtUser);

            $dataPegawai[$index] += ['user_id' => $user->id];
        }

        foreach ($dataPegawai as $d) {
            Pegawai::create($d);
        }
    }
}
