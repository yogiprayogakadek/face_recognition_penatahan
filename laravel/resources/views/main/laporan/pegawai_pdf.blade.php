<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pegawai</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            border-bottom: 2px solid #3498db;
            padding-bottom: 15px;
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
            text-transform: uppercase;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #7f8c8d;
        }

        .report-info {
            text-align: right;
            margin-bottom: 15px;
            font-size: 11px;
            color: #7f8c8d;
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

        .status-active {
            background-color: #27ae60;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
        }

        .status-inactive {
            background-color: #e74c3c;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 10px;
        }

        .summary {
            margin-top: 15px;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            font-size: 11px;
        }

        .summary strong {
            color: #3498db;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/images/logo/logo.png') }}" alt="Logo">
        <div class="header-content">
            <h2>Laporan Data Pegawai</h2>
            <p>Pemerintah Desa Penatahan</p>
            <p>Jl. Contoh No. 123, Denpasar, Bali</p>
        </div>
    </div>

    <div class="report-info">
        Dicetak pada: {{ now()->format('d F Y H:i:s') }}<br>
        Status Laporan:
        {{ request()->status_pegawai == 'semua' ? 'Semua Pegawai' : (request()->status_pegawai == '1' ? 'Pegawai Aktif' : 'Pegawai Tidak Aktif') }}
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Pegawai</th>
                <th width="20%">No. Telepon</th>
                <th width="15%">Jenis Kelamin</th>
                <th width="15%">Status</th>
                <th width="20%">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left; padding-left: 15px;">{{ $item->nama }}</td>
                    <td>{{ $item->nomor_telp ?? '-' }}</td>
                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>
                        <span class="{{ $item->user && $item->user->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $item->user && $item->user->is_active ? 'AKTIF' : 'TIDAK AKTIF' }}
                        </span>
                    </td>
                    <td>{{ $item->jabatan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 20px; color: #7f8c8d;">Tidak ada data
                        pegawai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <strong>SUMMARY:</strong> Total pegawai: {{ count($data) }} orang
        (Aktif: {{ $data->filter(function ($item) {return $item->user && $item->user->is_active;})->count() }} |
        Tidak Aktif: {{ $data->filter(function ($item) {return !$item->user || !$item->user->is_active;})->count() }})
    </div>

    <div class="footer">
        Dokumen ini sah dan diterbitkan secara elektronik oleh Sistem Administrasi Desa Penatahan.<br>
        Laporan ini bersifat rahasia dan hanya untuk keperluan internal.
    </div>

</body>

</html>
