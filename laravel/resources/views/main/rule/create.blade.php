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

    <div class="card">
        <div class="card-body wizard-content">
            <h4 class="card-title">Tambah Aturan Kehadiran</h4>
            {{-- <p class="card-subtitle mb-3"> You can us the validation like what we did </p> --}}
            <form action="{{ route('rule.store') }}" method="POST" class="validation-wizard wizard-circle mt-5">
                @csrf
                <!-- Step 1 -->
                <h6>Absen Masuk</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="tipe_masuk"> Tipe : <span class="danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control required @error('tipe_masuk') is-invalid @enderror"
                                    name="rules[masuk][tipe]" id="tipe_masuk" value="masuk" readonly />
                                @error('tipe_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="start_time_masuk"> Start Time : <span class="danger">*</span>
                                </label>
                                <input type="time" id="start_time_masuk" name="rules[masuk][start_time]"
                                    class="form-control required @error('start_time_masuk') is-invalid @enderror"
                                    value="{{ old('start_time_masuk') }}">
                                @error('start_time_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="end_time_masuk"> End Time : <span class="danger">*</span>
                                </label>
                                <input type="time" id="end_time_masuk" name="rules[masuk][end_time]"
                                    class="form-control required @error('end_time_masuk') is-invalid @enderror"
                                    value="{{ old('end_time_masuk') }}">
                                @error('end_time_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="late_after_masuk"> Batas keterlambatan : <span
                                        class="danger">*</span>
                                </label>
                                <input type="time" id="late_after_masuk" name="rules[masuk][late_after]"
                                    class="form-control required @error('late_after_masuk') is-invalid @enderror"
                                    value="{{ old('late_after_masuk') }}">
                                @error('late_after_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Step 2 -->
                <h6>Absen Pulang</h6>
                <section>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="tipe_pulang"> Tipe : <span class="danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control required @error('tipe_pulang') is-invalid @enderror"
                                    name="rules[pulang][tipe]" id="tipe_pulang" value="pulang" readonly />
                                @error('tipe_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="start_time_pulang"> Start Time : <span
                                        class="danger">*</span>
                                </label>
                                <input type="time" id="start_time_pulang" name="rules[pulang][start_time]"
                                    class="form-control required @error('start_time_pulang') is-invalid @enderror"
                                    value="{{ old('start_time_pulang') }}">
                                @error('start_time_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="end_time_pulang"> End Time : <span class="danger">*</span>
                                </label>
                                <input type="time" id="end_time_pulang" name="rules[pulang][end_time]"
                                    class="form-control @error('end_time_pulang') is-invalid @enderror"
                                    value="{{ old('end_time_pulang') }}">
                                <label class="text-info small" style="">Boleh dikosongkan.</label>
                                @error('end_time_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="late_after_pulang"> Batas keterlambatan : <span
                                        class="danger">*</span>
                                </label>
                                <input type="time" id="late_after_pulang" name="rules[pulang][late_after]"
                                    class="form-control @error('late_after_pulang') is-invalid @enderror"
                                    value="{{ old('late_after_pulang') }}">
                                <label class="text-info small" style="">Boleh dikosongkan.</label>
                                @error('late_after_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/jquery-steps/build/jquery.steps.min.js">
    </script>
    <script
        src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/jquery-validation/dist/jquery.validate.min.js">
    </script>
    {{-- <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/js/forms/form-wizard.js"></script> --}}

    <script>
        var form = $(".validation-wizard").show();

        $(".validation-wizard").steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "fade",
                titleTemplate: '<span class="step">#index#</span> #title#',
                labels: {
                    finish: "Simpan",
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    return (
                        currentIndex > newIndex ||
                        (!(3 === newIndex && Number($("#age-2").val()) < 18) &&
                            (currentIndex < newIndex &&
                                (form.find(".body:eq(" + newIndex + ") label.error").remove(),
                                    form.find(".body:eq(" + newIndex + ") .error").removeClass("error")),
                                (form.validate().settings.ignore = ":disabled,:hidden"),
                                form.valid()))
                    );
                },
                onFinishing: function(event, currentIndex) {
                    return (form.validate().settings.ignore = ":disabled"), form.valid();
                },
                onFinished: function(event, currentIndex) {
                    form.submit();
                },
            }),
            $(".validation-wizard").validate({
                ignore: "input[type=hidden]",
                errorClass: "text-danger",
                successClass: "text-success",
                highlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass(errorClass);
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                rules: {
                    email: {
                        email: !0,
                    },
                },
            });
    </script>

    <script>
        $(document).ready(function() {
            function timeToMinutes(timeStr) {
                if (!timeStr) return null;
                const [hour, minute] = timeStr.split(':').map(Number);
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

            // === VALIDASI PULANG ===
            $('#start_time_pulang').on('change', function() {
                const startMasuk = timeToMinutes($('#start_time_masuk').val());
                const endMasuk = timeToMinutes($('#end_time_masuk').val());
                const startPulang = timeToMinutes($(this).val());

                if (startMasuk == null || endMasuk == null) {
                    showNotification('Isi dulu waktu absen masuk.');
                    $(this).val('');
                    return;
                }

                if (startPulang < startMasuk || startPulang < endMasuk) {
                    showNotification('Start Time Pulang tidak boleh lebih awal dari waktu masuk.');
                    $(this).val('');
                    return;
                }

                $('#end_time_pulang').prop('readonly', false);
                hideNotification();
            });

            $('#end_time_pulang').on('change', function() {
                const startMasuk = timeToMinutes($('#start_time_masuk').val());
                const endMasuk = timeToMinutes($('#end_time_masuk').val());
                const startPulang = timeToMinutes($('#start_time_pulang').val());
                const endPulang = timeToMinutes($(this).val());

                if (startPulang == null) {
                    showNotification('Isi Start Time Pulang terlebih dahulu.');
                    $(this).val('');
                    return;
                }

                if (endPulang < startMasuk || endPulang < endMasuk || endPulang < startPulang) {
                    showNotification(
                        'End Time Pulang tidak boleh lebih awal dari waktu masuk dan start pulang.');
                    $(this).val('');
                    return;
                }

                $('#late_after_pulang').prop('readonly', false);
                hideNotification();
            });

            $('#late_after_pulang').on('change', function() {
                const startMasuk = timeToMinutes($('#start_time_masuk').val());
                const endMasuk = timeToMinutes($('#end_time_masuk').val());
                const startPulang = timeToMinutes($('#start_time_pulang').val());
                const endPulang = timeToMinutes($('#end_time_pulang').val());
                const lateAfterPulang = timeToMinutes($(this).val());

                if (!startMasuk || !endMasuk || !startPulang || !endPulang) {
                    showNotification('Isi semua waktu terlebih dahulu.');
                    $(this).val('');
                    return;
                }

                if (lateAfterPulang <= startMasuk || lateAfterPulang <= endMasuk ||
                    lateAfterPulang <= startPulang || lateAfterPulang >= endPulang) {
                    showNotification('Late After Pulang harus di antara waktu masuk dan waktu pulang.');
                    $(this).val('');
                    return;
                }

                hideNotification();
            });

            // Initial disable
            if (!$('#start_time_pulang').val()) {
                $('#end_time_pulang').prop('readonly', true);
                $('#late_after_pulang').prop('readonly', true);
            } else if (!$('#end_time_pulang').val()) {
                $('#late_after_pulang').prop('readonly', true);
            }
        });
    </script>
@endpush
