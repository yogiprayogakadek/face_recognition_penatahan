@extends('template.master')

@section('page-title', 'Face Encoding')

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
            <h5 class="card-title fw-semibold mb-4">Daftar Face Encoding</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th>Data Face Encoding</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                @if ($data->faceEncoding)
                                    {{-- <button type="button" class="btn bg-info-subtle text-info btn-detail"
                                        data-id="{{ $data->id }}"
                                        data-encoding="{{ json_encode($data->faceEncoding->encodings) }}"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Lihat Face Encoding">
                                        <iconify-icon icon="solar:eye-bold" width="1em" height="1em"></iconify-icon>
                                    </button> --}}
                                    <pre>{{ json_encode($data->faceEncoding->encodings, JSON_PRETTY_PRINT) }}</pre>
                                @else
                                    Belum ada data face encoding, tambahkan melalui menu.
                                @endif
                            </td>
                            {{-- <td class="align-text-top text-center">
                                @if (!$data->faceEncoding)
                                    <a href="{{ route('face.create', $data->id) }}">
                                        <button class="btn btn-outline-info" data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                            data-bs-title="Create Face Encoding">
                                            <iconify-icon icon="solar:face-scan-square-broken" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('face.edit', $data->id) }}">
                                        <button class="btn btn-outline-success" data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                            data-bs-title="Edit">
                                            <iconify-icon icon="solar:clapperboard-edit-linear" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    </a>
                                @endif
                            </td> --}}
                        </tr>
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
        $("#table").DataTable();

        $(document).on('click', '.btn-delete', function() {
            const tipe = $(this).data('tipe');
            const url = $(this).data('url');
            const id = $(this).data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Data rule <strong>${tipe}</strong> akan dihapus.`,
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
