<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
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
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/images/logo/logo.png') }}" alt="Logo">
        <h2>Laporan Data Pegawai</h2>
        <p>{{ now()->format('d M Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No. Telp</th>
                <th>Jenis Kelamin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nomor_telp ?? '-' }}</td>
                    <td>{{ ucfirst($item->jenis_kelamin) }}</td>
                    <td>{{ $item->user && $item->user->is_active ? 'Aktif' : 'Tidak Aktif' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Tidak ada data pegawai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
