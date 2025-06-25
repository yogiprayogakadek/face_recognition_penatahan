@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@section('page-title', 'Pegawai')

@section('content')
    <form action="{{ route('pegawai.update', $pegawai->id) }}" enctype="multipart/form-data" method="POST">
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" id="foto_profil" name="foto_profil"
                                class="form-control @error('foto_profil') is-invalid @enderror">
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
                    <button type="submit" class="btn btn-primary">
                        Update
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
        $("#tanggal_lahir").bootstrapMaterialDatePicker({
            weekStart: 0,
            time: false,
            maxDate: new Date(),
        });

        $('[id^="mini-"]').removeClass('selected');
        $('#mini-1').addClass('selected');
        $('#list-pegawai').addClass('active');
        $('#menu-right-mini-1').addClass('sidebar-nav d-block simplebar-scrollable-y');
    </script>
@endpush
