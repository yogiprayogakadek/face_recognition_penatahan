@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/new_style.css') }}" />
@endpush

@section('page-title', 'Pegawai')

@section('content')
    <form action="{{ route('pegawai.update', $pegawai->id) }}" enctype="multipart/form-data" method="POST" id="employeeForm">
        @csrf
        @method('PUT')
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Error Global --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Pegawai</h5>

                <div class="row pt-3">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $pegawai->nama) }}" placeholder="Masukkan nama">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jabatan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <select name="jabatan" id="jabatan"
                                class="form-control @error('jabatan') is-invalid @enderror">
                                <option value="">-- Pilih jabatan --</option>
                                @foreach (jabatan() as $jabatan)
                                    <option value="{{ $jabatan }}"
                                        {{ old('jabatan', $pegawai->jabatan) == $jabatan ? 'selected' : '' }}>
                                        {{ ucwords($jabatan) }}
                                    </option>
                                @endforeach

                            </select>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" id="nomor_telp" name="nomor_telp"
                                class="form-control @error('nomor_telp') is-invalid @enderror"
                                value="{{ old('nomor_telp', $pegawai->nomor_telp) }}" placeholder="Masukkan nomor telepon">
                            @error('nomor_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}"
                                placeholder="Masukkan tempat lahir">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir', $pegawai->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                <option value="">-- Pilih jenis kelamin --</option>
                                <option value="laki-laki"
                                    {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="perempuan"
                                    {{ old('jenis_kelamin', $pegawai->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Status Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="form-control @error('status_perkawinan') is-invalid @enderror">
                                <option value="">-- Pilih status perkawinan --</option>
                                <option value="belum kawin"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'belum kawin' ? 'selected' : '' }}>
                                    Belum Kawin</option>
                                <option value="kawin"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'kawin' ? 'selected' : '' }}>
                                    Kawin</option>
                                <option value="cerai hidup"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'cerai hidup' ? 'selected' : '' }}>
                                    Cerai Hidup</option>
                                <option value="cerai mati"
                                    {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'cerai mati' ? 'selected' : '' }}>
                                    Cerai Mati</option>
                            </select>
                            @error('status_perkawinan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Pendidikan Terakhir --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <select name="pendidikan_terakhir" id="pendidikan_terakhir"
                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                <option value="">-- Pilih Pendidikan Terakhir --</option>
                                @php
                                    $pendidikan = [
                                        'tidak sekolah',
                                        'sd',
                                        'smp',
                                        'sma',
                                        'slta',
                                        'd1',
                                        'd2',
                                        'd3',
                                        'd4',
                                        's1',
                                        's2',
                                        's3',
                                    ];
                                @endphp
                                @foreach ($pendidikan as $item)
                                    <option value="{{ $item }}"
                                        {{ old('pendidikan_terakhir', $pegawai->pendidikan_terakhir) == $item ? 'selected' : '' }}>
                                        {{ strtoupper($item) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pendidikan_terakhir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $pegawai->user->email) }}" placeholder="Masukkan email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                placeholder="Masukkan alamat" rows="5">{{ old('alamat', $pegawai->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Foto Profil --}}
                    <div class="col-md-12">
                        <div class="form-group mb-3">
                            <label class="form-label">
                                <i class="fas fa-camera text-primary me-2"></i>Foto Profil
                            </label>
                            <div class="file-upload-container">
                                <div class="file-drop-zone" id="fileDropZone">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <div class="file-drop-text">
                                        <strong>Klik untuk memilih file</strong> atau drag & drop<br>
                                        <small>Format: JPG, PNG, GIF (Max: 2MB)</small>
                                    </div>
                                    <input type="file" id="foto_profil" name="foto_profil"
                                        class="form-control @error('foto_profil') is-invalid @enderror" accept="image/*"
                                        style="display: none;">
                                </div>
                                <div id="imagePreviewContainer" class="image-preview-container" style="display: none;">
                                    <button type="button" class="remove-file-btn" id="removeFileBtn">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <img id="imagePreview" class="image-preview" alt="Preview">
                                    <div class="file-info" id="fileInfo"></div>
                                </div>
                            </div>
                            @if ($pegawai->foto_profil)
                                <small class="d-block mt-1">Foto saat ini: <br>
                                    <img src="{{ asset('storage/' . $pegawai->foto_profil) }}" width="120">
                                </small>
                            @endif
                            @error('foto_profil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <div class="card-body border-top">
                    <button type="submit" class="btn btn-primary me-3" id="submitBtn">
                        <i class="fas fa-save me-2"></i>
                        Update Data
                    </button>
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary ms-3">Kembali</a>
                </div>
            </div>
        </div>
    </form>


@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/extra-libs/moment/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/js/bootstrap-material-datetimepicker.min.js">
    </script>
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/forms/material-datepicker-init.js"></script>

    <script>
        $(document).ready(function() {
            $('[id^="mini-"]').removeClass('selected');
            $('#mini-2').addClass('selected');
            $('#list-pegawai').addClass('active');
            $('#menu-right-mini-2').addClass('sidebar-nav d-block simplebar-scrollable-y');
        });

        // Enhanced Date Picker
        $("#tanggal_lahir").bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            maxDate: new Date(),
            format: "YYYY-MM-DD",
        });

        // Form Animation and Enhancement
        document.addEventListener("DOMContentLoaded", function() {
            // Add loading animation to form submission
            const form = document.getElementById("employeeForm");
            const submitBtn = document.getElementById("submitBtn");

            form.addEventListener("submit", function(e) {
                submitBtn.classList.add("loading");
                submitBtn.innerHTML =
                    '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
                submitBtn.disabled = true;
            });

            // Enhanced file input with drag & drop and preview
            const fileInput = document.getElementById("foto_profil");
            const fileDropZone = document.getElementById("fileDropZone");
            const imagePreviewContainer = document.getElementById(
                "imagePreviewContainer"
            );
            const imagePreview = document.getElementById("imagePreview");
            const fileInfo = document.getElementById("fileInfo");
            const removeFileBtn = document.getElementById("removeFileBtn");

            // Click to select file
            fileDropZone.addEventListener("click", () => {
                fileInput.click();
            });

            // Drag and drop functionality
            fileDropZone.addEventListener("dragover", (e) => {
                e.preventDefault();
                fileDropZone.classList.add("drag-over");
            });

            fileDropZone.addEventListener("dragleave", (e) => {
                e.preventDefault();
                fileDropZone.classList.remove("drag-over");
            });

            fileDropZone.addEventListener("drop", (e) => {
                e.preventDefault();
                fileDropZone.classList.remove("drag-over");

                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    if (file.type.startsWith("image/")) {
                        handleFileSelect(file);
                    } else {
                        alert("Mohon pilih file gambar (JPG, PNG, GIF)");
                    }
                }
            });

            // File input change event
            fileInput.addEventListener("change", function(e) {
                const file = e.target.files[0];
                if (file) {
                    handleFileSelect(file);
                }
            });

            // Remove file button
            removeFileBtn.addEventListener("click", function(e) {
                e.stopPropagation();
                removeFile();
            });

            // Handle file selection and preview
            function handleFileSelect(file) {
                // Validate file size (2MB max)
                const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                if (file.size > maxSize) {
                    alert("Ukuran file terlalu besar. Maksimal 2MB.");
                    return;
                }

                // Validate file type
                const allowedTypes = [
                    "image/jpeg",
                    "image/jpg",
                    "image/png",
                    "image/gif",
                ];
                if (!allowedTypes.includes(file.type)) {
                    alert("Format file tidak didukung. Gunakan JPG, PNG, atau GIF.");
                    return;
                }

                // Create FileReader to read the file
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Show preview
                    imagePreview.src = e.target.result;

                    // Show file info
                    const fileSize = (file.size / 1024 / 1024).toFixed(2);
                    fileInfo.innerHTML = `
                        <i class="fas fa-file-image me-1"></i>
                        ${file.name} (${fileSize} MB)
                    `;

                    // Hide drop zone, show preview
                    fileDropZone.style.display = "none";
                    imagePreviewContainer.style.display = "block";

                    // Add animation
                    imagePreviewContainer.style.opacity = "0";
                    imagePreviewContainer.style.transform = "translateY(20px)";
                    setTimeout(() => {
                        imagePreviewContainer.style.transition = "all 0.3s ease";
                        imagePreviewContainer.style.opacity = "1";
                        imagePreviewContainer.style.transform = "translateY(0)";
                    }, 10);
                };

                reader.readAsDataURL(file);
            }

            // Remove file function
            function removeFile() {
                // Clear the input
                fileInput.value = "";

                // Hide preview, show drop zone
                imagePreviewContainer.style.display = "none";
                fileDropZone.style.display = "block";

                // Clear preview and info
                imagePreview.src = "";
                fileInfo.innerHTML = "";

                // Add animation
                fileDropZone.style.opacity = "0";
                fileDropZone.style.transform = "translateY(-20px)";
                setTimeout(() => {
                    fileDropZone.style.transition = "all 0.3s ease";
                    fileDropZone.style.opacity = "1";
                    fileDropZone.style.transform = "translateY(0)";
                }, 10);
            }

            // Phone number formatting
            const phoneInput = document.getElementById("nomor_telp");
            phoneInput.addEventListener("input", function(e) {
                let value = e.target.value.replace(/\D/g, "");
                if (value.startsWith("0")) {
                    value =
                        "0" +
                        value.substring(1).replace(/(\d{4})(\d{4})(\d{4})/, "$1$2$3");
                }
                e.target.value = value;
            });

            // Form validation enhancement
            const requiredFields = document.querySelectorAll(
                "input[required], select[required]"
            );
            requiredFields.forEach((field) => {
                field.addEventListener("blur", function() {
                    if (this.value.trim() === "") {
                        this.classList.add("is-invalid");
                    } else {
                        this.classList.remove("is-invalid");
                        this.classList.add("is-valid");
                    }
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll(".alert");
            alerts.forEach((alert) => {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => {
                        if (alert.parentNode) {
                            alert.parentNode.removeChild(alert);
                        }
                    }, 500);
                }, 5000);
            });
        });
    </script>
@endpush
