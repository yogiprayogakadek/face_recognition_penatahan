<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header img {
            width: 60px;
            margin-bottom: 5px;
        }

        .header h2 {
            margin: 0;
            color: #2F4F4F;
        }

        .header p {
            margin: 0;
            font-size: 10px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        thead {
            background-color: #2F4F4F;
            color: white;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 6px 8px;
            text-align: center;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .ttd {
            margin-top: 30px;
            width: 100%;
            text-align: right;
        }

        .ttd .nama {
            margin-top: 80px;
            font-weight: bold;
            text-decoration: underline;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #555;
        }

        .qr {
            position: absolute;
            bottom: 40px;
            left: 30px;
            width: 80px;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/images/logo/logo.png') }}" alt="Logo">
        <h2>Laporan Absensi</h2>
        <p>Periode: {{ \Carbon\Carbon::parse(request()->start_date)->format('d M Y') }} -
            {{ \Carbon\Carbon::parse(request()->end_date)->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pegawai->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_absensi)->format('d-m-Y') }}</td>
                    <td>{{ optional($item->where('tipe', 'masuk')->first())->checked_in_at ?? '-' }}</td>
                    <td>{{ optional($item->where('tipe', 'pulang')->first())->checked_in_at ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="ttd">
        <p>Denpasar, {{ now()->format('d M Y') }}</p>
        <p>Kepala Desa</p>
        <p class="nama">I Made ....</p>
        <p>NIP. 1234567890</p>
    </div>

    {{-- QR Code --}}
    <img src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('Validasi Dokumen | Laporan Absensi | ' . now())) !!}" class="qr">

    <div class="footer">
        Laporan ini dihasilkan otomatis oleh sistem pada {{ now()->format('d-m-Y H:i:s') }}
    </div>

</body>

</html>
