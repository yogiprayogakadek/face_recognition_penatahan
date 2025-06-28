<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPegawai = Pegawai::count();
        $laki = Pegawai::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Pegawai::where('jenis_kelamin', 'Perempuan')->count();

        $today = now()->format('Y-m-d');

        // Hitung Kehadiran Hari Ini
        $hadirMasuk = Kehadiran::whereDate('tanggal_absensi', $today)
            ->where('tipe', 'masuk')->count();

        $hadirPulang = Kehadiran::whereDate('tanggal_absensi', $today)
            ->where('tipe', 'pulang')->count();

        // Pegawai yang belum hadir (berdasarkan 'masuk')
        $belumHadirMasuk = $totalPegawai - $hadirMasuk;
        $belumHadirPulang = $totalPegawai - $hadirPulang;

        // === Data Chart Area 7 Hari Terakhir ===
        $labels = collect();
        $masukCounts = collect();
        $pulangCounts = collect();

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');

            $masuk = Kehadiran::whereDate('tanggal_absensi', $date)
                ->where('tipe', 'masuk')->count();

            $pulang = Kehadiran::whereDate('tanggal_absensi', $date)
                ->where('tipe', 'pulang')->count();

            $labels->push(Carbon::parse($date)->format('d M'));
            $masukCounts->push($masuk);
            $pulangCounts->push($pulang);
        }

        // Ambil aturan aktif
        $aturanMasuk = Rule::where('is_active', true)->where('tipe', 'masuk')->first();
        $aturanPulang = Rule::where('is_active', true)->where('tipe', 'pulang')->first();

        return view('main.dashboard.index', [
            'totalPegawai' => $totalPegawai,
            'laki' => $laki,
            'perempuan' => $perempuan,

            'hadirMasuk' => $hadirMasuk,
            'belumHadirMasuk' => $belumHadirMasuk,

            'hadirPulang' => $hadirPulang,
            'belumHadirPulang' => $belumHadirPulang,

            'attendanceChartData' => [
                'labels' => $labels,
                'masuk' => $masukCounts,
                'pulang' => $pulangCounts
            ],

            'aturanMasuk' => $aturanMasuk,
            'aturanPulang' => $aturanPulang,
        ]);
    }

    public function chart(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $range = $request->range;

        // Jika pakai filter tanggal manual
        if ($start && $end) {
            $startDate = Carbon::parse($start);
            $endDate = Carbon::parse($end);
        }
        // Jika pakai tombol range 7/30/90 hari
        else {
            $days = $range ?? 7;
            $startDate = Carbon::today()->subDays($days - 1);
            $endDate = Carbon::today();
        }

        $labels = collect();
        $masukCounts = collect();
        $pulangCounts = collect();

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $label = $date->format('d M');

            $masuk = Kehadiran::whereDate('tanggal_absensi', $date)
                ->where('tipe', 'masuk')
                ->count();

            $pulang = Kehadiran::whereDate('tanggal_absensi', $date)
                ->where('tipe', 'pulang')
                ->count();

            $labels->push($label);
            $masukCounts->push($masuk);
            $pulangCounts->push($pulang);
        }

        return response()->json([
            'labels' => $labels,
            'masuk' => $masukCounts,
            'pulang' => $pulangCounts
        ]);
    }

    public function dashboardPegawai()
    {
        $pegawai = auth()->user()->pegawai;

        $today = now()->toDateString();

        $kehadiranMasuk = $pegawai->kehadiran()
            ->where('tipe', 'masuk')
            ->whereDate('tanggal_absensi', $today)
            ->latest('created_at')
            ->first();

        $kehadiranPulang = $pegawai->kehadiran()
            ->where('tipe', 'pulang')
            ->whereDate('tanggal_absensi', $today)
            ->latest('created_at')
            ->first();

        $aturanMasuk = Rule::where('tipe', 'masuk')->where('is_active', true)->first();
        $aturanPulang = Rule::where('tipe', 'pulang')->where('is_active', true)->first();

        $histori = Kehadiran::where('pegawai_id', $pegawai->id)
            ->select('tanggal_absensi')
            ->distinct()
            ->orderBy('tanggal_absensi', 'desc')
            ->take(7)
            ->get()
            ->map(function ($item) use ($pegawai) {
                $item->masuk = Kehadiran::where('pegawai_id', $pegawai->id)
                    ->where('tanggal_absensi', $item->tanggal_absensi)
                    ->where('tipe', 'masuk')
                    ->first();
                $item->pulang = Kehadiran::where('pegawai_id', $pegawai->id)
                    ->where('tanggal_absensi', $item->tanggal_absensi)
                    ->where('tipe', 'pulang')
                    ->first();
                return $item;
            });

        return view('main.dashboard.pegawai.index', compact(
            'kehadiranMasuk',
            'kehadiranPulang',
            'aturanMasuk',
            'aturanPulang',
            'histori'
        ));
    }
}
