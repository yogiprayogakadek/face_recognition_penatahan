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
            'jabatan' => 'Admin',
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
                'jabatan' => 'Perbekel',
                'nomor_telp' => '0878-8554-0293',
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
                'jabatan' => 'Sekdes',
                'nomor_telp' => '0852-6639-6277',
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
                'jabatan' => 'Kaur Perencanaan',
                'nomor_telp' => '0822-4737-7809',
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
                'jabatan' => 'Kaur Keuangan',
                'nomor_telp' => '0857-9209-3556',
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
                'jabatan' => 'Kasi Kesra',
                'nomor_telp' => '0821-4570-9157',
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
                'jabatan' => 'Kaur Pemerintahan',
                'nomor_telp' => '0821-4431-9161',
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
                'jabatan' => 'Kaur Umum',
                'nomor_telp' => '0823-4116-4757',
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
                'jabatan' => 'Kasi Pelayanan',
                'nomor_telp' => '0851-0152-5976',
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
                'jabatan' => 'Stap Operator',
                'nomor_telp' => '0817-0353-5800',
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
                'jabatan' => 'Petugas Kebersihan',
                'nomor_telp' => '0831-2952-1856',
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
                'jabatan' => 'Kawil Tegayang',
                'nomor_telp' => '0819-3316-0225',
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
                'jabatan' => 'Kawil Penatahan Kelod',
                'nomor_telp' => '0853-3885-3748',
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
                'jabatan' => 'Kawil Mongan',
                'nomor_telp' => '0812-3739-8939',
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
                'jabatan' => 'Kawil Bedugul',
                'nomor_telp' => '0856-3718-302',
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
                'jabatan' => 'Kawil Kekeran',
                'nomor_telp' => '0857-9283-6828',
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
                'jabatan' => 'Kawil Penatahan Kaja',
                'nomor_telp' => '0822-3644-9785',
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
