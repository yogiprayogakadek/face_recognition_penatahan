@extends('template.master')

@section('page-title', 'Pegawai')

@push('css')
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/pegawai/style.css') }}">
@endpush

@section('content')
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="page-header">
        @if (session('success'))
            <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
                role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <div class="d-flex align-items-center me-3 me-md-0">
                    <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Pegawai</h5>
            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 25%;"><i class="ti ti-user me-1"></i>Nama</th>
                            <th class="text-center" style="width: 20%;"><i class="ti ti-briefcase me-1"></i>Jabatan</th>
                            <th class="text-center" style="width: 25%;"><i class="ti ti-mail me-1"></i>Email</th>
                            <th class="text-center" style="width: 15%;"><i class="ti ti-phone me-1"></i>Telepon</th>
                            <th class="text-center" style="width: 15%;"><i class="ti ti-settings me-1"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @php
                                $foto = $item->foto_profil;
                                $profilePhoto = $foto
                                    ? asset('storage/' . $foto)
                                    : 'https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/profile/user-' .
                                        mt_rand(1, 15) .
                                        '.jpg';
                            @endphp

                            <tr class="employee-row" data-id="{{ $item->id }}"
                                data-tempat-lahir="{{ $item->tempat_lahir }}"
                                data-tanggal-lahir="{{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}"
                                data-jenis-kelamin="{{ ucfirst($item->jenis_kelamin) }}"
                                data-status-perkawinan="{{ ucwords($item->status_perkawinan) }}"
                                data-pendidikan-terakhir="{{ strtoupper($item->pendidikan_terakhir) }}"
                                data-alamat="{{ $item->alamat }}"
                                data-status-akun="{{ $item->user->is_active ? 'Aktif' : 'Tidak Aktif' }}"
                                data-status-akun-class="{{ $item->user->is_active ? 'bg-success' : 'bg-warning' }}">
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ $profilePhoto }}" width="45" height="45"
                                            class="rounded-circle profile-photo" />
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $item->nama }}</h6>
                                            <small class="text-muted">{{ ucwords($item->jabatan) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="data-badge">{{ ucwords($item->jabatan) }}</span></td>
                                <td>{{ $item->user->email }}</td>
                                <td>{{ $item->nomor_telp }}</td>
                                <td>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <button type="button" class="btn btn-info btn-sm btn-detail"
                                            data-id="{{ $item->id }}" data-bs-toggle="tooltip"
                                            data-bs-title="Lihat Detail">
                                            <iconify-icon icon="solar:eye-bold-duotone" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>

                                        <button type="button"
                                            class="btn {{ $item->user->is_active ? 'btn-status-active' : 'btn-status-inactive' }} btn-sm btn-toggle-status"
                                            data-id="{{ $item->user->id }}" data-nama="{{ $item->nama }}"
                                            data-status="{{ $item->user->is_active ? 'disable' : 'activate' }}"
                                            data-url="{{ route('pegawai.toggleStatus', $item->user->id) }}"
                                            data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
                                            data-bs-placement="top"
                                            data-bs-title="{{ $item->user->is_active ? 'Disable User' : 'Aktifkan User' }}">
                                            <iconify-icon
                                                icon="{{ $item->user->is_active ? 'solar:bill-cross-bold-duotone' : 'solar:bill-check-bold-duotone' }}"
                                                width="1em" height="1em">
                                            </iconify-icon>
                                        </button>

                                        <a href="{{ route('pegawai.edit', $item->id) }}">
                                            <button class="btn btn-edit btn-sm" data-bs-toggle="tooltip"
                                                data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                                data-bs-title="Edit">
                                                <iconify-icon icon="solar:clapperboard-edit-linear" width="1em"
                                                    height="1em"></iconify-icon>
                                            </button>
                                        </a>

                                        <button type="button" class="btn btn-delete btn-sm" data-id="{{ $item->id }}"
                                            data-nama="{{ $item->nama }}"
                                            data-url="{{ route('pegawai.destroy', $item->id) }}" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-title="Hapus Pegawai">
                                            <iconify-icon icon="solar:trash-bin-trash-bold-duotone" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    </div>
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

    <script>
        // Fungsi ini membuat HTML untuk baris detail
        function format(d) {
            return `
                <div class="detail-content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-card">
                                <h6 class="detail-title"><i class="ti ti-info-circle me-2"></i>Informasi Personal</h6>
                                <div class="detail-item">
                                    <label>Tempat Lahir:</label>
                                    <span>${d.tempat_lahir}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Tanggal Lahir:</label>
                                    <span>${d.tanggal_lahir}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Jenis Kelamin:</label>
                                    <span class="badge bg-light text-dark">${d.jenis_kelamin}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Status Perkawinan:</label>
                                    <span class="badge bg-light text-dark">${d.status_perkawinan}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-card">
                                <h6 class="detail-title"><i class="ti ti-school me-2"></i>Informasi Lainnya</h6>
                                <div class="detail-item">
                                    <label>Pendidikan Terakhir:</label>
                                    <span class="badge bg-primary text-white">${d.pendidikan_terakhir}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Alamat Lengkap:</label>
                                    <span>${d.alamat}</span>
                                </div>
                                <div class="detail-item">
                                    <label>Status Akun:</label>
                                    <span class="badge ${d.status_akun_class}">${d.status_akun}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        // Enhanced loading function
        function showLoading() {
            $('#loadingOverlay').addClass('show');
        }

        function hideLoading() {
            setTimeout(() => {
                $('#loadingOverlay').removeClass('show');
            }, 300);
        }

        $(document).ready(function() {
            // Hide loading overlay
            setTimeout(() => {
                $('#loadingOverlay').removeClass('show');
            }, 800);

            var table = $("#table").DataTable({
                scrollX: true,
                scrollY: false,
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "Semua"]
                ],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    }
                },
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            });

            // Inisialisasi tooltip
            // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            // tooltipList.map(function(tooltipTriggerEl) {
            //     return new bootstrap.Tooltip(tooltipTriggerEl);
            // });

            // Event handler untuk tombol detail
            $('#table tbody').on('click', '.btn-detail', function(e) {
                e.preventDefault();
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var button = $(this);

                table.rows().every(function() {
                    if (this.child.isShown() && this.node() !== tr[0]) {
                        this.child.hide();
                        $(this.node()).removeClass('details');
                        $(this.node()).find('.btn-detail iconify-icon').attr('icon',
                            'solar:eye-bold-duotone');
                    }
                });

                if (row.child.isShown()) {
                    row.child.hide();
                    tr.removeClass('details');
                    button.find('iconify-icon').attr('icon', 'solar:eye-bold-duotone');
                } else {
                    var rowData = {
                        tempat_lahir: tr.data('tempat-lahir'),
                        tanggal_lahir: tr.data('tanggal-lahir'),
                        jenis_kelamin: tr.data('jenis-kelamin'),
                        status_perkawinan: tr.data('status-perkawinan'),
                        pendidikan_terakhir: tr.data('pendidikan-terakhir'),
                        alamat: tr.data('alamat'),
                        status_akun: tr.data('status-akun'),
                        status_akun_class: tr.data('status-akun-class')
                    };

                    row.child(format(rowData), 'detail-row-container').show();
                    tr.addClass('details');
                    button.find('iconify-icon').attr('icon', 'solar:eye-closed-bold-duotone');
                }
            });

            // Toggle Status Handler
            $(document).on('click', '.btn-toggle-status', function(e) {
                e.preventDefault();
                showLoading();
                const url = $(this).data('url');
                const nama = $(this).data('nama');
                const status = $(this).data('status');
                const text = status === 'disable' ? 'menonaktifkan' : 'mengaktifkan';
                const icon = status === 'disable' ? 'warning' : 'question';
                hideLoading();

                Swal.fire({
                    title: 'Konfirmasi Aksi',
                    html: `Apakah Anda yakin ingin <strong>${text}</strong> user <strong>${nama}</strong>?`,
                    icon: icon,
                    showCancelButton: true,
                    confirmButtonColor: status === 'disable' ? '#fa709a' : '#4facfe',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: `Ya, ${text.charAt(0).toUpperCase() + text.slice(1)}!`,
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-primary me-2',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading();
                        $.ajax({
                            url: url,
                            type: 'PUT',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                hideLoading();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                hideLoading();
                                Swal.fire('Gagal!', 'Terjadi kesalahan pada server.',
                                    'error');
                            }
                        });
                    }
                });
            });

            // Delete Handler
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault();
                const nama = $(this).data('nama');
                const url = $(this).data('url');

                Swal.fire({
                    title: 'Peringatan!',
                    html: `Data pegawai <strong>${nama}</strong> akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#fa709a',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    buttonsStyling: false,
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        showLoading();
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                hideLoading();
                                Swal.fire({
                                    title: 'Terhapus!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                hideLoading();
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error');
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
