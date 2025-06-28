<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use App\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::today()->format('Y-m-d');

        $pegawaiList = Pegawai::with([])->get()->map(function ($pegawai) use ($tanggalHariIni) {
            // Cari absen masuk hari ini
            $masuk = Kehadiran::where('pegawai_id', $pegawai->id)
                ->where('tanggal_absensi', $tanggalHariIni)
                ->where('tipe', 'masuk')
                // ->latest('created_at')
                ->first();

            // Cari absen pulang hari ini
            $pulang = Kehadiran::where('pegawai_id', $pegawai->id)
                ->where('tanggal_absensi', $tanggalHariIni)
                ->where('tipe', 'pulang')
                // ->latest('created_at')
                ->first();

            return [
                'pegawai' => $pegawai,
                'absen_masuk' => $masuk,
                'absen_pulang' => $pulang,
            ];
        });

        // dd($tanggalHariIni);

        return view('main.kehadiran.index', ['pegawai' => $pegawaiList]);
    }

    public function indexPegawai()
    {
        $pegawai_id = auth()->user()->pegawai->id;
        $data = Kehadiran::where('pegawai_id', $pegawai_id)->get();

        return view('main.kehadiran.pegawai.index', compact('data'));
    }

    public function histori($pegawai_id)
    {
        $kehadiran = Kehadiran::where('pegawai_id', $pegawai_id)
            ->orderBy('tanggal_absensi', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $view = view('main.kehadiran.partial.histori', compact('kehadiran'))->render();

        return response()->json([
            'data' => $view
        ]);
    }
}
