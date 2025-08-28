<?php

namespace Database\Seeders;

use App\Models\Kehadiran;
use App\Models\Rule;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KehadiranSeeder extends Seeder
{
    public function run(): void
    {
        $jumlahPegawai = User::count();
        $startDate = Carbon::parse('2024-01-01');
        $endDate = Carbon::now();

        // Ambil aturan aktif
        $rules = Rule::where('is_active', true)->get();

        $ruleMasuk = $rules->where('tipe', 'masuk')->first();
        $rulePulang = $rules->where('tipe', 'pulang')->first();

        if (!$ruleMasuk || !$rulePulang) {
            echo "Aturan masuk atau pulang tidak ditemukan. Pastikan ada aturan aktif.\n";
            return;
        }

        $data = [];

        foreach ($startDate->copy()->toPeriod($endDate) as $date) {
            for ($pegawaiId = 1; $pegawaiId <= $jumlahPegawai; $pegawaiId++) {

                // === Masuk ===
                if (mt_rand(1, 100) <= 90) { // 90% hadir
                    $jamMasuk = Carbon::parse($date->format('Y-m-d') . ' ' . $ruleMasuk->start_time)
                        ->addMinutes(mt_rand(0, 10));

                    $isLate = false;
                    if ($ruleMasuk->late_after) {
                        $isLate = $jamMasuk->gt(
                            Carbon::parse($date->format('Y-m-d') . ' ' . $ruleMasuk->late_after)
                        );
                    }

                    $data[] = [
                        'pegawai_id' => $pegawaiId,
                        'aturan_kehadiran_id' => $ruleMasuk->id,
                        'checked_in_at' => $jamMasuk,
                        'tanggal_absensi' => $date->format('Y-m-d'),
                        'tipe' => 'masuk',
                        'is_late' => $isLate,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                // === Pulang ===
                if (mt_rand(1, 100) <= 95) { // 95% pulang
                    $jamPulang = Carbon::parse($date->format('Y-m-d') . ' ' . $rulePulang->start_time)
                        ->addMinutes(mt_rand(0, 60));

                    $data[] = [
                        'pegawai_id' => $pegawaiId,
                        'aturan_kehadiran_id' => $rulePulang->id,
                        'checked_in_at' => $jamPulang,
                        'tanggal_absensi' => $date->format('Y-m-d'),
                        'tipe' => 'pulang',
                        'is_late' => false,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Insert batch
        foreach (array_chunk($data, 500) as $chunk) {
            Kehadiran::insert($chunk);
        }

        echo "Seeder kehadiran selesai. Total: " . count($data) . " data.\n";
    }
}
