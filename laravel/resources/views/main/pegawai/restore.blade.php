@extends('template.master')

@section('page-title', 'Pegawai')

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
            <h5 class="card-title fw-semibold mb-4">Restore Daftar Pegawai</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nama</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Perkawinan</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr>
                                <td>
                                    <button type="button" class="btn bg-info-subtle text-info btn-restore"
                                        data-id="{{ $data->id }}" data-nama="{{ $data->nama }}"
                                        data-url="{{ route('pegawai.restore', $data->id) }}" data-bs-toggle="tooltip"
                                        data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                        data-bs-title="Restore">
                                        <iconify-icon icon="solar:refresh-bold-duotone" width="1em"
                                            height="1em"></iconify-icon>
                                    </button>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-6">
                                        <img src="{{ asset('storage/' . $data->foto_profil) }}" width="45"
                                            class="rounded-circle" />
                                        <h6 class="mb-0"> {{ $data->nama }} </h6>
                                    </div>
                                </td>
                                <td>{{ $data->tempat_lahir }}</td>
                                <td>{{ $data->tanggal_lahir }}</td>
                                <td>{{ ucfirst($data->jenis_kelamin) }}</td>
                                <td>{{ ucwords($data->status_perkawinan) }}</td>
                                <td>{{ strtoupper($data->pendidikan_terakhir) }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->nomor_telp }}</td>
                                <td>{{ $data->user->email }}</td>
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
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script>
        $("#table").DataTable({
            scrollX: true,
            scrollY: false
        });

        $(document).on('click', '.btn-restore', function() {
            const nama = $(this).data('nama');
            const url = $(this).data('url');

            Swal.fire({
                title: 'Pulihkan Data?',
                html: `Data pegawai <strong>${nama}</strong> akan dipulihkan.`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Pulihkan!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat memulihkan data.',
                                'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
