@extends('template.master')

@section('page-title', 'Aturan Kehadiran')

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
            <h5 class="card-title fw-semibold mb-4">Daftar Rule</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th colspan="3" class="text-center">Absen Masuk</th>
                            <th colspan="3" class="text-center">Absen Pulang</th>
                            <th class="text-center align-content-center" rowspan="2">Status</th>
                            <th class="text-center align-content-center" rowspan="2">Aksi</th>
                        </tr>
                        <tr>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Late After</th>

                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Late After</th>

                            {{-- <th>Group ID</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $item)
                            <tr>
                                {{-- MASUK --}}
                                <td>{{ $item['masuk']?->start_time ?? '-' }}</td>
                                <td>{{ $item['masuk']?->end_time ?? '-' }}</td>
                                <td>{{ $item['masuk']?->late_after ?? '-' }}</td>

                                {{-- PULANG --}}
                                <td>{{ $item['pulang']?->start_time ?? '-' }}</td>
                                <td>{{ $item['pulang']?->end_time ?? '-' }}</td>
                                <td>{{ $item['pulang']?->late_after ?? '-' }}</td>

                                {{-- STATUS --}}
                                <td>{{ $item['status'] == true ? 'Aktif' : 'Non-aktif' }}</td>

                                <td class="text-center">
                                    <button type="button"
                                        class="btn {{ $item['masuk']?->is_active ? 'bg-primary-subtle text-primary' : 'bg-warning-subtle text-warning' }} btn-toggle-status"
                                        data-id="{{ $item['group_id'] }}" data-tipe="{{ $item['masuk']?->tipe }}"
                                        data-status="{{ $item['masuk']?->is_active ? 'disable' : 'activate' }}"
                                        data-url="{{ route('rule.toggleStatus', $item['group_id']) }}"
                                        data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                        data-bs-placement="top"
                                        data-bs-title="{{ $item['masuk']?->is_active ? 'Disable Rule' : 'Aktifkan Rule' }}">

                                        <iconify-icon
                                            icon="{{ $item['masuk']?->is_active ? 'solar:bill-cross-bold-duotone' : 'solar:bill-check-bold-duotone' }}"
                                            width="1em" height="1em">
                                        </iconify-icon>
                                    </button>

                                    <a href="{{ route('rule.edit', $item['group_id']) }}">
                                        <button class="btn btn-outline-success" data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                            data-bs-title="Edit">
                                            <iconify-icon icon="solar:clapperboard-edit-linear" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    </a>

                                    <button type="button" class="btn bg-danger-subtle text-danger btn-delete"
                                        data-id="{{ $item['group_id'] }}" data-tipe="{{ $item['masuk']?->tipe }}"
                                        data-url="{{ route('rule.destroy', $item['group_id']) }}" data-bs-toggle="tooltip"
                                        data-bs-placement="top" data-bs-title="Hapus Rule">
                                        <iconify-icon icon="solar:trash-bin-trash-bold-duotone" width="1em"
                                            height="1em"></iconify-icon>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data.</td>
                            </tr>
                        @endforelse
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

        $(document).on('click', '.btn-toggle-status', function(e) {
            e.preventDefault();

            const url = $(this).data('url');
            const tipe = 'ini';
            const status = $(this).data('status'); // 'disable' atau 'activate'
            const text = status === 'disable' ? 'menonaktifkan' : 'mengaktifkan';
            const icon = status === 'disable' ? 'warning' : 'question';

            Swal.fire({
                title: 'Apakah Anda yakin?',
                html: `Ingin <strong>${text}</strong> rule <strong>${tipe}</strong>?`,
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
                                response.title,
                                response.message,
                                response.status
                            ).then((result) => {
                                if (response.status === 'success') {
                                    location.reload();
                                }
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
            const tipe = 'ini';
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
                            Swal.fire(response.title, response.message, response.status).then(
                                () => {
                                    if (response.status != 'error') {
                                        location.reload();
                                    }
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
