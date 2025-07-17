<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .header img {
            width: 70px;
            position: absolute;
            left: 0;
            top: 0;
        }

        .header-content {
            display: inline-block;
            text-align: center;
        }

        .header h2 {
            margin: 0 0 5px 0;
            color: #2c3e50;
            font-size: 18px;
            font-weight: bold;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #7f8c8d;
        }

        .periode {
            margin: 10px 0;
            font-weight: bold;
            text-align: center;
            font-size: 12px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #3498db;
            color: white;
        }

        th {
            padding: 10px 8px;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }

        td {
            padding: 8px;
            border: 1px solid #ecf0f1;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        tbody tr:hover {
            background-color: #f1f8fe;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
            text-align: right;
        }

        .ttd p {
            margin: 5px 0;
        }

        .ttd .nama {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 5px;
        }

        .qr {
            position: absolute;
            bottom: 60px;
            left: 30px;
            width: 80px;
            border: 1px solid #eee;
            padding: 5px;
            background: white;
        }

        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 10px;
            margin: 10px 0;
            font-size: 11px;
        }

        .info-box strong {
            color: #3498db;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/images/logo/logo.png') }}" alt="Logo">
        <div class="header-content">
            <h2>LAPORAN ABSENSI PEGAWAI</h2>
            <p>Pemerintah Desa Penatahan</p>
            <p>Jl. Contoh No. 123, Denpasar, Bali</p>
        </div>
    </div>

    <div class="periode">
        Periode: {{ \Carbon\Carbon::parse(request()->start_date)->format('d F Y') }} -
        {{ \Carbon\Carbon::parse(request()->end_date)->format('d F Y') }}
    </div>

    <div class="info-box">
        <strong>INFO:</strong> Laporan ini menampilkan rekapitulasi kehadiran pegawai dalam periode terpilih.
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Pegawai</th>
                <th width="15%">Tanggal</th>
                <th width="20%">Jam Masuk</th>
                <th width="20%">Jam Pulang</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse ($data as $pegawaiId => $absensiByDate)
                @foreach ($absensiByDate as $tanggal => $absensi)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td style="text-align: left; padding-left: 15px;">{{ $absensi->first()->pegawai->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($tanggal)->format('d-m-Y') }}</td>
                        <td>
                            @if ($absensi->where('tipe', 'masuk')->first())
                                {{ \Carbon\Carbon::parse($absensi->where('tipe', 'masuk')->first()->checked_in_at)->format('H:i') }}
                            @else
                                <span style="color: #e74c3c;">-</span>
                            @endif
                        </td>
                        <td>
                            @if ($absensi->where('tipe', 'pulang')->first())
                                {{ \Carbon\Carbon::parse($absensi->where('tipe', 'pulang')->first()->checked_in_at)->format('H:i') }}
                            @else
                                <span style="color: #e74c3c;">-</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $masuk = $absensi->where('tipe', 'masuk')->first();
                                $pulang = $absensi->where('tipe', 'pulang')->first();

                                if ($masuk && $pulang) {
                                    echo '<span style="color: #27ae60;">Lengkap</span>';
                                } elseif ($masuk) {
                                    echo '<span style="color: #f39c12;">Masuk Saja</span>';
                                } else {
                                    echo '<span style="color: #e74c3c;">Tidak Absen</span>';
                                }
                            @endphp
                        </td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; color: #7f8c8d;">Tidak ada data absensi
                        untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <p>Denpasar, {{ now()->format('d F Y') }}</p>
        <p>Yang bertanda tangan,</p>
        <p class="nama">I Made ....</p>
        <p>NIP. 1234567890</p>
    </div>

    <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('Validasi Dokumen | Laporan Absensi | ' . now())) !!}" class="qr">

    <div class="footer">
        Dokumen ini sah dan diterbitkan secara elektronik oleh Sistem Absensi Desa Penatahan.<br>
        Dicetak pada {{ now()->format('d-m-Y H:i:s') }} oleh {{ Auth::user()->name ?? 'Sistem' }}
    </div>

</body>

</html>
