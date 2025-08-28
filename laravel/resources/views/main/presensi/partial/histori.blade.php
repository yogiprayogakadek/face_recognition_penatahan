<div class="table-responsive">
    <table id="tableHistori" class="table table-striped table-bordered text-nowrap align-middle">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Presensi</th>
                <th>Tipe</th>
                <th>Jam Presensi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal_presensi }}</td>
                    <td>{{ $item->tipe }}</td>
                    <td>{{ date_format(date_create($item->checked_in_at), 'H:i') }}</td>
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
