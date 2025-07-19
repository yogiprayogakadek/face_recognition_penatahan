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
            <h5 class="card-title fw-semibold mb-4">Daftar Pegawai</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Status Perkawinan</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Alamat</th>
                            <th>Nomor Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            @php
                                $foto = $data->foto_profil;
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
                                        <h6 class="mb-0"> {{ $data->nama }} </h6>
                                    </div>
                                </td>
                                <td>{{ ucwords($data->jabatan) }}</td>
                                <td>{{ $data->tempat_lahir }}</td>
                                <td>{{ $data->tanggal_lahir }}</td>
                                <td>{{ ucfirst($data->jenis_kelamin) }}</td>
                                <td>{{ ucwords($data->status_perkawinan) }}</td>
                                <td>{{ strtoupper($data->pendidikan_terakhir) }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->nomor_telp }}</td>
                                <td>{{ $data->user->email }}</td>
                                <td>
                                    <button type="button"
                                        class="btn {{ $data->user->is_active ? 'bg-primary-subtle text-primary' : 'bg-warning-subtle text-warning' }} btn-toggle-status"
                                        data-id="{{ $data->user->id }}" data-nama="{{ $data->nama }}"
                                        data-status="{{ $data->user->is_active ? 'disable' : 'activate' }}"
                                        data-url="{{ route('pegawai.toggleStatus', $data->user->id) }}"
                                        data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="{{ $data->user->is_active ? 'Disable User' : 'Aktifkan User' }}">

                                        <iconify-icon
                                            icon="{{ $data->user->is_active ? 'solar:bill-cross-bold-duotone' : 'solar:bill-check-bold-duotone' }}"
                                            width="1em" height="1em">
                                        </iconify-icon>
                                    </button>

                                    <a href="{{ route('pegawai.edit', $data->id) }}">
                                        <button class="btn btn-outline-success" data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                            data-bs-title="Edit">
                                            <iconify-icon icon="solar:clapperboard-edit-linear" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    </a>

                                    <button type="button" class="btn bg-danger-subtle text-danger btn-delete"
                                        data-id="{{ $data->id }}" data-nama="{{ $data->nama }}"
                                        data-url="{{ route('pegawai.destroy', $data->id) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-title="Hapus Pegawai">
                                        <iconify-icon icon="solar:trash-bin-trash-bold-duotone" width="1em"
                                            height="1em"></iconify-icon>
                                    </button>


                                </td>
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
    {{-- {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}} --}}

    <script>
        $("#table").DataTable({
            scrollX: true,
            scrollY: false
        });

        $(document).on('click', '.btn-toggle-status', function(e) {
            e.preventDefault();

            const url = $(this).data('url');
            const nama = $(this).data('nama');
            const status = $(this).data('status'); // 'disable' atau 'activate'
            const text = status === 'disable' ? 'menonaktifkan' : 'mengaktifkan';
            const icon = status === 'disable' ? 'warning' : 'question';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Ingin <strong>${text}</strong> user <strong>${nama}</strong>?`,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: status === 'disable' ? '#d33' : '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire(
                                'Berhasil!',
                                response.message,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan pada server.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

        $(document).on('click', '.btn-delete', function() {
            const nama = $(this).data('nama');
            const url = $(this).data('url');
            const id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Data pegawai <strong>${nama}</strong> akan dihapus.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire('Berhasil!', response.message, 'success').then(() => {
                                location.reload();
                            });
                        },
                        error: function(err) {
                            Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.',
                                'error');
                        }
                    });
                }
            });
        });
    </script>
@endpush
