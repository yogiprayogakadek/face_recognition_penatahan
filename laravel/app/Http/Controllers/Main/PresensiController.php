<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\Pegawai;
use App\Models\Rule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::today()->format('Y-m-d');

        $pegawaiList = Pegawai::with([])->get()->map(function ($pegawai) use ($tanggalHariIni) {
            // Cari presensi masuk hari ini
            $masuk = Presensi::where('pegawai_id', $pegawai->id)
                ->where('tanggal_presensi', $tanggalHariIni)
                ->where('tipe', 'masuk')
                // ->latest('created_at')
                ->first();

            // Cari presensi pulang hari ini
            $pulang = Presensi::where('pegawai_id', $pegawai->id)
                ->where('tanggal_presensi', $tanggalHariIni)
                ->where('tipe', 'pulang')
                // ->latest('created_at')
                ->first();

            return [
                'pegawai' => $pegawai,
                'presensi_masuk' => $masuk,
                'presensi_pulang' => $pulang,
            ];
        });

        // dd($pegawaiList);

        return view('main.presensi.index', ['pegawai' => $pegawaiList]);
    }

    public function indexPegawai()
    {
        $pegawai_id = auth()->user()->pegawai->id;

        // Ambil semua data presensi lalu groupBy tanggal_presensi
        $data = Presensi::where('pegawai_id', $pegawai_id)
            ->orderBy('tanggal_presensi')
            ->get()
            ->groupBy('tanggal_presensi');

        return view('main.presensi.pegawai.index', compact('data'));
    }

    public function histori($pegawai_id)
    {
        $presensi = Presensi::where('pegawai_id', $pegawai_id)
            ->orderBy('tanggal_presensi', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $view = view('main.presensi.partial.histori', compact('presensi'))->render();

        return response()->json([
            'data' => $view
        ]);
    }
}
