<div class="table-responsive">
    <table id="tableHistori" class="table table-striped table-bordered text-nowrap align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Absensi</th>
                <th>Tipe</th>
                <th>Jam Absensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kehadiran as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal_absensi }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ $item->checked_in_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#tableHistori').DataTable();
    });
</script>
