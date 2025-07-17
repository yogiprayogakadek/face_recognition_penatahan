<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class LaporanController extends Controller
{
    public function render($kategori)
    {
        if ($kategori == 'absensi') {
            $pegawai = Pegawai::pluck('nama', 'id')->prepend('Pilih semua pegawai', '');
            $view = view('template.partials.print.absensi', compact('pegawai'))->render();
        } else {
            $view = view('template.partials.print.pegawai')->render();
        }

        return response()->json([
            'success' => true,
            'data' => $view
        ]);
    }

    public function cetak(Request $request)
    {
        $kategori = $request->kategori;
        // dd($kategori);

        if ($kategori == 'absensi') {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            // Query data kehadiran dan group by tanggal dan pegawai
            $data = Kehadiran::with('pegawai')
                ->whereBetween('tanggal_absensi', [$request->start_date, $request->end_date])
                ->when($request->pegawai, function ($query) use ($request) {
                    $query->where('pegawai_id', $request->pegawai);
                })
                ->get()
                ->groupBy(['pegawai_id', 'tanggal_absensi']);

            $pdf = Pdf::loadView('main.laporan.absensi_pdf', compact('data'))
                ->setPaper('A4', 'portrait');
        } else {
            // Untuk kategori pegawai
            $request->validate([
                'status_pegawai' => 'required|in:semua,0,1'
            ]);

            if ($request->status_pegawai == 'semua') {
                $data = Pegawai::all();
            } elseif ($request->status_pegawai == '1') {
                // Pegawai aktif
                $data = Pegawai::whereHas('user', function ($q) {
                    $q->where('is_active', true);
                })->get();
            } elseif ($request->status_pegawai == '0') {
                // Pegawai tidak aktif
                $data = Pegawai::whereHas('user', function ($q) {
                    $q->where('is_active', false);
                })->get();
            }

            // Generate PDF pegawai
            $pdf = Pdf::loadView('main.laporan.pegawai_pdf', compact('data'))
                ->setPaper('A4', 'portrait');
        }

        return $pdf->download('laporan-' . time() . '.pdf');
    }
}
