@extends('template.master')

@section('page-title', 'Rule')

@section('content')

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alert Error Global --}}
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

    {{-- Notifikasi Validasi Time --}}
    <div id="time_notification" class="alert alert-danger" hidden>
        <p class="message mb-0"></p>
    </div>

    {{-- Form Edit --}}
    <form action="{{ route('rule.update', $rule->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Rule</h5>

                <div class="row">

                    {{-- Tipe --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tipe</label>
                        <select name="tipe" id="tipe" class="form-control @error('tipe') is-invalid @enderror">
                            <option value="">-- Pilih Tipe --</option>
                            <option value="masuk" {{ old('tipe', $rule->tipe) == 'masuk' ? 'selected' : '' }}>Masuk
                            </option>
                            <option value="pulang" {{ old('tipe', $rule->tipe) == 'pulang' ? 'selected' : '' }}>Pulang
                            </option>
                        </select>
                        @error('tipe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Start Time --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Start Time</label>
                        <input type="time" id="start_time" name="start_time"
                            class="form-control @error('start_time') is-invalid @enderror"
                            value="{{ old('start_time', $rule->start_time) }}">
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- End Time --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">End Time</label>
                        <input type="time" id="end_time" name="end_time"
                            class="form-control @error('end_time') is-invalid @enderror"
                            value="{{ old('end_time', $rule->end_time) }}">
                        @error('end_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Late After --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Late After</label>
                        <input type="time" id="late_after" name="late_after"
                            class="form-control @error('late_after') is-invalid @enderror"
                            value="{{ old('late_after', $rule->late_after) }}">
                        @error('late_after')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('rule.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>

    </form>
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            $('[id^="mini-"]').removeClass('selected');
            $('#mini-2').addClass('selected');
            $('#list-rule').addClass('active');
            $('#menu-right-mini-2').addClass('sidebar-nav d-block simplebar-scrollable-y');

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
