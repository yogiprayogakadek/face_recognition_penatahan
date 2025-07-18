@extends('template.master')

@section('page-title', 'My Profile')

@push('css')
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
        }

        .profile-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-avatar {
            position: relative;
            text-align: center;
            padding: 2rem 0;
        }

        .profile-avatar img {
            border: 5px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .profile-avatar img:hover {
            transform: scale(1.05);
        }

        .profile-info {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem;
            margin: 1rem 0;
            border-radius: 10px;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding: 0.75rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .info-item:last-child {
            margin-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 80px;
            display: flex;
            align-items: center;
        }

        .info-label i {
            margin-right: 0.5rem;
            color: #667eea;
        }

        .info-value {
            flex: 1;
            color: #212529;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .form-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .form-section {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 0.5rem;
            color: #667eea;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-control:disabled {
            background-color: #f8f9fa;
            border-color: #e9ecef;
        }

        .btn-update {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-update:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.5);
        }

        .btn-save {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(40, 167, 69, 0.5);
        }

        .btn-cancel {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
        }

        .btn-cancel:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.5);
        }

        .alert-custom {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-actions {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1.5rem 2rem;
            border-top: 1px solid #dee2e6;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border: none;
            margin: 2rem 0;
        }

        .photo-preview-container {
            margin-top: 1rem;
        }

        .photo-preview-wrapper {
            position: relative;
            display: inline-block;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .photo-preview-wrapper:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .photo-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 3px solid #fff;
            transition: all 0.3s ease;
        }

        .photo-preview-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .photo-preview-wrapper:hover .photo-preview-overlay {
            opacity: 1;
        }

        .remove-photo-btn {
            background: #dc3545;
            border: none;
            color: white;
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .remove-photo-btn:hover {
            background: #c82333;
            transform: scale(1.1);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-custom {
            position: relative;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: 2px dashed #667eea;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .file-input-custom:hover {
            border-color: #764ba2;
            background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        }

        .file-input-custom.dragover {
            border-color: #28a745;
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        }

        .file-input-icon {
            font-size: 2rem;
            color: #667eea;
            margin-bottom: 1rem;
        }

        .file-input-text {
            color: #495057;
            font-weight: 500;
        }

        .file-input-subtext {
            color: #6c757d;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        @media (max-width: 768px) {
            .photo-preview {
                width: 120px;
                height: 120px;
            }
        }
    </style>
@endpush

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center">
                <i class="ti ti-check-circle fs-4 me-3"></i>
                <div>
                    <strong>Success!</strong> {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    {{-- Profile Header --}}
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 class="mb-1">My Profile</h2>
                <p class="mb-0 opacity-75">Manage your personal information and account settings</p>
            </div>
            <div class="col-md-4 text-end">
                <i class="ti ti-user-circle" style="font-size: 3rem; opacity: 0.5;"></i>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Profile Card --}}
        <div class="col-lg-4 col-md-5">
            <div class="card profile-card">
                <div class="card-body">
                    <div class="profile-avatar">
                        @php
                            $foto = auth()->user()->pegawai->foto_profil;
                            $profilePhoto = $foto
                                ? asset('storage/' . $foto)
                                : 'https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/profile/user-1.jpg';
                        @endphp

                        <img src="{{ $profilePhoto }}" class="rounded-circle" width="120" height="120"
                            alt="Foto Profil" />
                        <h4 class="mt-3 mb-0">{{ auth()->user()->pegawai->nama }}</h4>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>

                    <hr class="section-divider">

                    <div class="profile-info">
                        <div class="info-item">
                            <div class="info-label">
                                <i class="ti ti-user"></i>
                                Nama
                            </div>
                            <div class="info-value">{{ auth()->user()->pegawai->nama }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="ti ti-mail"></i>
                                Email
                            </div>
                            <div class="info-value">{{ auth()->user()->email }}</div>
                        </div>

                        <div class="info-item">
                            <div class="info-label">
                                <i class="ti ti-shield-check"></i>
                                Status
                            </div>
                            <div class="info-value">
                                <span
                                    class="status-badge {{ auth()->user()->is_active ? 'status-active' : 'status-inactive' }}">
                                    {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" class="btn btn-update text-white update-btn">
                            <i class="ti ti-edit me-2"></i>Update Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Card --}}
        <div class="col-lg-8 col-md-7">
            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                id="form">
                @csrf
                @method('PUT')
                <div class="card form-card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="ti ti-user-edit me-2"></i>Profile Information
                        </h5>
                    </div>

                    <div class="form-section">
                        <div class="row">
                            {{-- Nama --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama" class="form-label">
                                        <i class="ti ti-user"></i>Nama Lengkap
                                    </label>
                                    <input disabled type="text" id="nama" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap" value="{{ old('nama', $user->pegawai->nama) }}">
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Nomor Telp --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-phone"></i>Nomor Telepon
                                    </label>
                                    <input disabled type="text" id="nomor_telp" name="nomor_telp"
                                        class="form-control @error('nomor_telp') is-invalid @enderror"
                                        placeholder="Masukkan nomor telepon"
                                        value="{{ old('nomor_telp', $user->pegawai->nomor_telp) }}">
                                    @error('nomor_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-mail"></i>Email Address
                                    </label>
                                    <input disabled type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan alamat email" value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tempat Lahir --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-map-pin"></i>Tempat Lahir
                                    </label>
                                    <input disabled type="text" id="tempat_lahir" name="tempat_lahir"
                                        class="form-control @error('tempat_lahir') is-invalid @enderror"
                                        placeholder="Masukkan tempat lahir"
                                        value="{{ old('tempat_lahir', $user->pegawai->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-calendar"></i>Tanggal Lahir
                                    </label>
                                    <input disabled type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                        value="{{ old('tanggal_lahir', $user->pegawai->tanggal_lahir) }}">
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-gender-male"></i>Jenis Kelamin
                                    </label>
                                    <select disabled name="jenis_kelamin" id="jenis_kelamin"
                                        class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                        <option value="">-- Pilih jenis kelamin --</option>
                                        <option value="laki-laki"
                                            {{ old('jenis_kelamin', $user->pegawai->jenis_kelamin) == 'laki-laki' ? 'selected' : '' }}>
                                            Laki-laki</option>
                                        <option value="perempuan"
                                            {{ old('jenis_kelamin', $user->pegawai->jenis_kelamin) == 'perempuan' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Status Perkawinan --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-heart"></i>Status Perkawinan
                                    </label>
                                    <select disabled name="status_perkawinan" id="status_perkawinan"
                                        class="form-control @error('status_perkawinan') is-invalid @enderror">
                                        <option value="">-- Pilih status perkawinan --</option>
                                        <option value="belum kawin"
                                            {{ old('status_perkawinan', $user->pegawai->status_perkawinan) == 'belum kawin' ? 'selected' : '' }}>
                                            Belum Kawin
                                        </option>
                                        <option value="kawin"
                                            {{ old('status_perkawinan', $user->pegawai->status_perkawinan) == 'kawin' ? 'selected' : '' }}>
                                            Kawin
                                        </option>
                                        <option value="cerai hidup"
                                            {{ old('status_perkawinan', $user->pegawai->status_perkawinan) == 'cerai hidup' ? 'selected' : '' }}>
                                            Cerai Hidup
                                        </option>
                                        <option value="cerai mati"
                                            {{ old('status_perkawinan', $user->pegawai->status_perkawinan) == 'cerai mati' ? 'selected' : '' }}>
                                            Cerai Mati
                                        </option>
                                    </select>
                                    @error('status_perkawinan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Pendidikan Terakhir --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-school"></i>Pendidikan Terakhir
                                    </label>
                                    <select disabled name="pendidikan_terakhir" id="pendidikan_terakhir"
                                        class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                        <option value="">-- Pilih Pendidikan Terakhir --</option>
                                        <option value="tidak sekolah"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'tidak sekolah' ? 'selected' : '' }}>
                                            Tidak Sekolah
                                        </option>
                                        <option value="sd"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'sd' ? 'selected' : '' }}>
                                            SD / MI
                                        </option>
                                        <option value="smp"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'smp' ? 'selected' : '' }}>
                                            SMP / MTs
                                        </option>
                                        <option value="sma"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'sma' ? 'selected' : '' }}>
                                            SMA / MA / SMK
                                        </option>
                                        <option value="d1"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'd1' ? 'selected' : '' }}>
                                            Diploma 1 (D1)
                                        </option>
                                        <option value="d2"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'd2' ? 'selected' : '' }}>
                                            Diploma 2 (D2)
                                        </option>
                                        <option value="d3"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'd3' ? 'selected' : '' }}>
                                            Diploma 3 (D3)
                                        </option>
                                        <option value="d4"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 'd4' ? 'selected' : '' }}>
                                            Diploma 4 / Sarjana Terapan (D4)
                                        </option>
                                        <option value="s1"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 's1' ? 'selected' : '' }}>
                                            Sarjana (S1)
                                        </option>
                                        <option value="s2"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 's2' ? 'selected' : '' }}>
                                            Magister (S2)
                                        </option>
                                        <option value="s3"
                                            {{ old('pendidikan_terakhir', $user->pegawai->pendidikan_terakhir) == 's3' ? 'selected' : '' }}>
                                            Doktor (S3)
                                        </option>
                                    </select>
                                    @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-map-2"></i>Alamat Lengkap
                                    </label>
                                    <textarea disabled name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror"
                                        rows="4" placeholder="Masukkan alamat lengkap">{{ old('alamat', $user->pegawai->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Foto Profil --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-photo"></i>Foto Profil
                                    </label>
                                    <input disabled type="file" id="foto_profil" name="foto_profil"
                                        class="form-control @error('foto_profil') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted">
                                        <i class="ti ti-info-circle me-1"></i>
                                        Kosongkan bila tidak ingin mengganti foto
                                    </small>
                                    @error('foto_profil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    {{-- Preview Container --}}
                                    <div class="photo-preview-container mt-3" style="display: none;">
                                        <div class="photo-preview-wrapper">
                                            <img id="photo-preview" class="photo-preview" alt="Preview foto">
                                            <div class="photo-preview-overlay">
                                                <button type="button" class="btn btn-sm btn-danger remove-photo-btn">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="text-muted mt-2 d-block">
                                            <i class="ti ti-eye me-1"></i>Preview foto yang akan diupload
                                        </small>
                                    </div>
                                </div>
                            </div>

                            {{-- Ganti Password --}}
                            <div class="col-12 mt-4">
                                <div class="form-group">
                                    <h6 class="text-primary"><i class="ti ti-lock me-2"></i>Ganti Password (kosongkan jika
                                        tidak ingin mengganti password)</h6>
                                </div>
                            </div>

                            {{-- Old Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-lock"></i>Password Lama
                                    </label>
                                    <input disabled type="password" id="old_password" name="old_password"
                                        class="form-control @error('old_password') is-invalid @enderror"
                                        placeholder="Masukkan password lama">
                                    @error('old_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- New Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-lock-check"></i>Password Baru
                                    </label>
                                    <input disabled type="password" id="new_password" name="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        placeholder="Masukkan password baru (min. 8 karakter)">
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Confirm Password --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="ti ti-lock-cog"></i>Konfirmasi Password Baru
                                    </label>
                                    <input disabled type="password" id="confirm_password" name="confirm_password"
                                        class="form-control @error('confirm_password') is-invalid @enderror"
                                        placeholder="Ulangi password baru">
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form-actions" hidden>
                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-cancel text-white cancel-btn">
                                <i class="ti ti-x me-2"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-save text-white save-btn">
                                <i class="ti ti-device-floppy me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            setTimeout(() => {
                $('[id^="mini-"]').removeClass('selected');
                $('body').attr('data-sidebartype', 'mini-sidebar');

                // $('.container-fluid').css('max-width', '1500px');
            }, 1000);


            // Update button click handler
            $('body').on('click', '.update-btn', function() {
                $(this).hide();
                $('.form-actions').prop('hidden', false);
                $('#form').find('input, select, textarea').prop('disabled', false);

                // Add animation
                $('.form-actions').slideDown(300);

                // Show toast notification
                if (typeof toastr !== 'undefined') {
                    toastr.info('Form editing enabled. Make your changes and click save.');
                }
            });

            // Cancel button click handler
            $('body').on('click', '.cancel-btn', function() {
                $('.form-actions').slideUp(300, function() {
                    $(this).prop('hidden', true);
                });
                $('.update-btn').show();
                $('#form').find('input, select, textarea').prop('disabled', true);

                // Reset form to original values
                $('#form')[0].reset();

                // Hide photo preview
                $('.photo-preview-container').hide();

                // Show toast notification
                if (typeof toastr !== 'undefined') {
                    toastr.warning('Changes cancelled. Form has been reset.');
                }
            });

            // Form submission handler
            $('#form').on('submit', function(e) {
                const submitBtn = $('.save-btn');
                const originalText = submitBtn.html();

                // Show loading state
                submitBtn.prop('disabled', true);
                submitBtn.html('<i class="ti ti-loader-2 me-2"></i>Saving...');

                // You can add form validation here if needed

                // Reset button after some time (remove this in production)
                setTimeout(() => {
                    submitBtn.prop('disabled', false);
                    submitBtn.html(originalText);
                }, 2000);
            });

            // Add hover effects for form controls
            $('.form-control').on('focus', function() {
                $(this).parent().addClass('focused');
            }).on('blur', function() {
                $(this).parent().removeClass('focused');
            });

            // Photo preview functionality
            $('#foto_profil').on('change', function(e) {
                const file = e.target.files[0];

                if (file) {
                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                    if (!validTypes.includes(file.type)) {
                        if (typeof toastr !== 'undefined') {
                            toastr.error('Please select a valid image file (JPEG, JPG, PNG, or GIF).');
                        } else {
                            alert('Please select a valid image file (JPEG, JPG, PNG, or GIF).');
                        }
                        $(this).val('');
                        return;
                    }

                    // Validate file size (max 2MB)
                    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
                    if (file.size > maxSize) {
                        if (typeof toastr !== 'undefined') {
                            toastr.error('File size should be less than 2MB.');
                        } else {
                            alert('File size should be less than 2MB.');
                        }
                        $(this).val('');
                        return;
                    }

                    // Create FileReader
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Set preview image
                        $('#photo-preview').attr('src', e.target.result);

                        // Show preview container with animation
                        $('.photo-preview-container').fadeIn(300);

                        // Show success message
                        if (typeof toastr !== 'undefined') {
                            toastr.success('Photo preview loaded successfully!');
                        }
                    };

                    reader.onerror = function() {
                        if (typeof toastr !== 'undefined') {
                            toastr.error('Error reading file. Please try again.');
                        } else {
                            alert('Error reading file. Please try again.');
                        }
                    };

                    // Read file as data URL
                    reader.readAsDataURL(file);
                } else {
                    // Hide preview if no file selected
                    $('.photo-preview-container').fadeOut(300);
                }
            });

            // Remove photo preview
            $(document).on('click', '.remove-photo-btn', function(e) {
                e.preventDefault();

                // Clear file input
                $('#foto_profil').val('');

                // Hide preview container
                $('.photo-preview-container').fadeOut(300);

                // Show info message
                if (typeof toastr !== 'undefined') {
                    toastr.info('Photo preview removed.');
                }
            });

            // Drag and drop functionality for file input
            const fileInput = $('#foto_profil');
            const fileInputParent = fileInput.parent();

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileInputParent[0].addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            // Highlight drop area when item is dragged over it
            ['dragenter', 'dragover'].forEach(eventName => {
                fileInputParent[0].addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileInputParent[0].addEventListener(eventName, unhighlight, false);
            });

            // Handle dropped files
            fileInputParent[0].addEventListener('drop', handleDrop, false);

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            function highlight(e) {
                fileInputParent.addClass('dragover');
            }

            function unhighlight(e) {
                fileInputParent.removeClass('dragover');
            }

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    fileInput[0].files = files;
                    fileInput.trigger('change');
                }
            }
        });
    </script>
@endpush
