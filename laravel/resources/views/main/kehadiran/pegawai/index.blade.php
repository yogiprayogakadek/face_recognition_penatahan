@extends('template.master')

@section('page-title', 'Kehadiran')

@push('css')
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Kehadiran</h5>

            <div class="table-responsive">
                <table id="table" class="table table-responsive-lg table-striped table-bordered text-nowrap align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th rowspan="2" class="align-content-center text-center">No.</th>
                            <th colspan="3" class="text-center">Absensi</th>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <th>Masuk</th>
                            <th>Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @php
                                $masuk = $item->where('tipe', 'masuk')->first();
                                $pulang = $item->where('tipe', 'pulang')->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ optional($item->first())->tanggal_absensi
                                        ? \Carbon\Carbon::parse($item->first()->tanggal_absensi)->format('d M Y')
                                        : '-' }}
                                </td>
                                <td>{{ $masuk ? $masuk->checked_in_at : '-' }}</td>
                                <td>{{ $pulang ? $pulang->checked_in_at : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js">
    </script>

    <script>
        $("#table").DataTable({
            scrollX: true,
            scrollY: false
        });

        setTimeout(() => {
            $('[id^="mini-"]').removeClass('selected');
            $('#kehadiran').addClass('selected');
            $('body').attr('data-sidebartype', 'mini-sidebar');

            // $('.container-fluid').css('max-width', '1500px');
        }, 1000);
    </script>
@endpush
