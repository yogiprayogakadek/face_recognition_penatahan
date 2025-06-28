@extends('template.master')

@section('page-title', 'Kehadiran')

@push('css')
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center  me-3 me-md-0">
                <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Kehadiran</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-content-center">Nama Pegawai</th>
                            <th colspan="2" class="text-center">Absensi Terbaru</th>
                            <th rowspan="2" class="text-center align-content-center">Aksi</th>
                        </tr>
                        <tr>
                            <th>Masuk</th>
                            <th>Pulang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                            @php
                                $foto = $item['pegawai']->foto_profil;
                                $profilePhoto = $foto
                                    ? asset('storage/' . $foto)
                                    : 'https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/profile/user-' .
                                        mt_rand(1, 15) .
                                        '.jpg';
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-6">
                                        <img src="{{ $profilePhoto }}" width="45" class="rounded-circle" />
                                        <h6 class="mb-0"> {{ $item['pegawai']->nama }} </h6>
                                    </div>
                                </td>
                                <td>{{ $item['absen_masuk']?->checked_in_at ?? '-' }}</td>
                                <td>{{ $item['absen_pulang']?->checked_in_at ?? '-' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-outline-primary histori-btn" data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        data-bs-title="Lihat Histori" data-id="{{ $item['pegawai']->id }}"
                                        data-nama="{{ $item['pegawai']->nama }}">
                                        <iconify-icon icon="solar:eye-bold" width="1em" height="1em"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" data-bs-backdrop="static" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title">Histori Absen</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid render"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger  waves-effect text-start"
                        data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script>
        $("#table").DataTable({
            scrollY: false
        });

        $(document).ready(function() {
            setTimeout(() => {
                $('[id^="mini-"]').removeClass('selected');
                $('#kehadiran').addClass('selected');
                $('body').attr('data-sidebartype', 'mini-sidebar');

                // $('.container-fluid').css('max-width', '1500px');
            }, 1000);
            // setTimeout(() => {
            //     $('#table').css('width', '1120px');
            // }, 1500)

            $('.histori-btn').on('click', function() {
                let nama = $(this).data('nama');
                let id = $(this).data('id');
                let url = "{{ url('/kehadiran/histori') }}/" + id;

                $('#modal').modal('show');

                $('.modal-title').text('Histori Absen - ' + nama);

                $.get(url, function(result) {
                    $('.render').html(result.data)
                });
            });
        });
    </script>
@endpush
