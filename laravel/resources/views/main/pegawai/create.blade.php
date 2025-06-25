@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@section('page-title', 'Pegawai')

@section('content')
    <form action="{{ route('pegawai.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
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

        {{-- Error Global --}}
        @if ($errors->any())
            <div class="alert customize-alert alert-dismissible border-danger text-danger fade show remove-close-icon"
                role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                <h5 class="card-title fw-semibold mb-4">Tambah Pegawai</h5>

                <div class="row pt-3">
                    {{-- Nama --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama"
                                class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama"
                                value="{{ old('nama') }}">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Nomor Telp --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" id="nomor_telp" name="nomor_telp"
                                class="form-control @error('nomor_telp') is-invalid @enderror"
                                placeholder="Masukkan nomor telepon" value="{{ old('nomor_telp') }}">
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
                                placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
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
                                value="{{ old('tanggal_lahir') }}">
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
                                <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>
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
                                    {{ old('status_perkawinan') == 'belum kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                <option value="kawin" {{ old('status_perkawinan') == 'kawin' ? 'selected' : '' }}>Kawin
                                </option>
                                <option value="cerai hidup"
                                    {{ old('status_perkawinan') == 'cerai hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                <option value="cerai mati"
                                    {{ old('status_perkawinan') == 'cerai mati' ? 'selected' : '' }}>Cerai Mati</option>
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
                                <option value="tidak sekolah"
                                    {{ old('pendidikan_terakhir') == 'tidak sekolah' ? 'selected' : '' }}>Tidak Sekolah
                                </option>
                                <option value="sd" {{ old('pendidikan_terakhir') == 'sd' ? 'selected' : '' }}>SD / MI
                                </option>
                                <option value="smp" {{ old('pendidikan_terakhir') == 'smp' ? 'selected' : '' }}>SMP /
                                    MTs</option>
                                <option value="sma" {{ old('pendidikan_terakhir') == 'sma' ? 'selected' : '' }}>SMA / MA
                                    / SMK</option>
                                <option value="d1" {{ old('pendidikan_terakhir') == 'd1' ? 'selected' : '' }}>Diploma 1
                                    (D1)</option>
                                <option value="d2" {{ old('pendidikan_terakhir') == 'd2' ? 'selected' : '' }}>Diploma
                                    2
                                    (D2)</option>
                                <option value="d3" {{ old('pendidikan_terakhir') == 'd3' ? 'selected' : '' }}>Diploma
                                    3
                                    (D3)</option>
                                <option value="d4" {{ old('pendidikan_terakhir') == 'd4' ? 'selected' : '' }}>Diploma
                                    4
                                    / Sarjana Terapan (D4)</option>
                                <option value="s1" {{ old('pendidikan_terakhir') == 's1' ? 'selected' : '' }}>Sarjana
                                    (S1)</option>
                                <option value="s2" {{ old('pendidikan_terakhir') == 's2' ? 'selected' : '' }}>Magister
                                    (S2)</option>
                                <option value="s3" {{ old('pendidikan_terakhir') == 's3' ? 'selected' : '' }}>Doktor
                                    (S3)</option>
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
                                placeholder="Masukkan alamat email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="5"
                                placeholder="Masukkan alamat">{{ old('alamat') }}</textarea>
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
                        Simpan
                    </button>
                    <button type="reset" class="btn btn-danger ms-3">
                        Reset
                    </button>
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
    </script>
@endpush
