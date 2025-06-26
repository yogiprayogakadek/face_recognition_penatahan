@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush

@section('page-title', 'Aturan Kehadiran')

@section('content')
    {{-- Success Alert --}}
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

    {{-- Notifikasi Validasi Time --}}
    <div id="time_notification"
        class="alert customize-alert alert-dismissible text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon"
        role="alert" hidden>
        <button type="button" class="btn-close" onclick="$('#time_notification').attr('hidden', true)"
            aria-label="Close"></button>
        <div class="d-flex align-items-center me-3 me-md-0">
            <p class="message mb-0"></p>
        </div>
    </div>

    <form action="{{ route('rule.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Rule</h5>

                <div class="row pt-3">
                    {{-- Tipe --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Tipe</label>
                            <select name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="masuk" {{ old('tipe') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                <option value="pulang" {{ old('tipe') == 'pulang' ? 'selected' : '' }}>Pulang</option>
                            </select>
                            @error('tipe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Start Time --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Start Time</label>
                            <input type="time" id="start_time" name="start_time"
                                class="form-control @error('start_time') is-invalid @enderror"
                                value="{{ old('start_time') }}">
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- End Time --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">End Time</label>
                            <input type="time" id="end_time" name="end_time"
                                class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}"
                                disabled>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Late After --}}
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="late_after" class="form-label">Late After</label>
                            <input type="time" id="late_after" name="late_after"
                                class="form-control @error('late_after') is-invalid @enderror"
                                value="{{ old('late_after') }}" disabled>
                            @error('late_after')
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
    <script>
        $(document).ready(function() {
            function timeToMinutes(time) {
                const [hour, minute] = time.split(':').map(Number);
                return hour * 60 + minute;
            }

            function showNotification(message) {
                $('#time_notification').removeAttr('hidden');
                $('#time_notification .message').text(message);
            }

            function hideNotification() {
                $('#time_notification').attr('hidden', true);
                $('#time_notification .message').text('');
            }

            // Start Time Event
            $('#start_time').on('change', function() {
                const start = $(this).val();

                if (start) {
                    $('#end_time').prop('disabled', false);
                } else {
                    $('#end_time').prop('disabled', true).val('');
                    $('#late_after').prop('disabled', true).val('');
                    hideNotification();
                }
            });

            // End Time Validation
            $('#end_time').on('change', function() {
                const start = $('#start_time').val();
                const end = $(this).val();

                if (!start) {
                    showNotification('Harap isi Start Time terlebih dahulu.');
                    $(this).val('');
                    return;
                }

                if (timeToMinutes(end) <= timeToMinutes(start)) {
                    showNotification('End Time harus lebih besar dari Start Time.');
                    $(this).val('');
                    return;
                }

                $('#late_after').prop('disabled', false);
                hideNotification();
            });

            // Late After Validation
            $('#late_after').on('change', function() {
                const start = $('#start_time').val();
                const end = $('#end_time').val();
                const late = $(this).val();

                if (!start || !end) {
                    showNotification('Isi Start Time dan End Time terlebih dahulu.');
                    $(this).val('');
                    return;
                }

                const lateMinutes = timeToMinutes(late);
                const startMinutes = timeToMinutes(start);
                const endMinutes = timeToMinutes(end);

                if (lateMinutes <= startMinutes || lateMinutes >= endMinutes) {
                    showNotification('Late After harus di antara Start Time dan End Time.');
                    $(this).val('');
                    return;
                }

                hideNotification();
            });

            // Initial Check on Load
            const start = $('#start_time').val();
            const end = $('#end_time').val();

            if (!start) {
                $('#end_time').prop('disabled', true);
                $('#late_after').prop('disabled', true);
            } else if (!end) {
                $('#late_after').prop('disabled', true);
            }
        });
    </script>
@endpush
