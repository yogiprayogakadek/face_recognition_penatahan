@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/new_style.css') }}" />
    <style>
        /* Modern Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        /* Wizard Steps Styling */
        .wizard>.steps {
            margin-bottom: 2rem;
        }

        .wizard>.steps>ul {
            display: flex;
            justify-content: center;
            list-style: none;
            padding: 0;
        }

        .wizard>.steps>ul>li {
            position: relative;
            margin: 0 15px;
            flex: 1;
            max-width: 200px;
        }

        .wizard>.steps>ul>li>a {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #6c757d;
            position: relative;
        }

        .wizard>.steps>ul>li>a>.number {
            width: 40px;
            height: 40px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 8px;
            border: 2px solid #dee2e6;
            transition: all 0.3s ease;
        }

        .wizard>.steps>ul>li.current>a>.number {
            background-color: #2575fc;
            color: white;
            border-color: #2575fc;
            transform: scale(1.1);
        }

        .wizard>.steps>ul>li.done>a>.number {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
        }

        .wizard>.steps>ul>li.disabled>a {
            color: #adb5bd;
            cursor: not-allowed;
        }

        .wizard>.steps>ul>li.disabled>a>.number {
            background-color: #e9ecef;
            border-color: #dee2e6;
            color: #adb5bd;
        }

        .wizard>.steps>ul>li>a>.title {
            font-weight: 500;
            text-align: center;
        }

        /* Form Elements */
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
            box-shadow: none;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, 0.25);
            transform: translateY(-1px);
        }

        .form-control[readonly] {
            background-color: #f8f9fa;
            opacity: 1;
        }

        /* Buttons */
        .wizard>.actions>ul {
            display: flex;
            justify-content: space-between;
            list-style: none;
            padding: 0;
        }

        .wizard>.actions>ul>li>a {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.3);
        }

        .wizard>.actions>ul>li>a:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 117, 252, 0.4);
        }

        .wizard>.actions>ul>li>a[href="#previous"] {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .wizard>.actions>ul>li>a[href="#previous"]:hover {
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        /* Time Input Styling */
        input[type="time"] {
            position: relative;
        }

        input[type="time"]::-webkit-calendar-picker-indicator {
            background: none;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #2575fc;
        }

        /* Alert Styling */
        .alert {
            border-radius: 8px;
            border-left: 4px solid;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-light-success {
            border-left-color: #28a745;
        }

        .alert-light-danger {
            border-left-color: #dc3545;
        }

        /* Section Animation */
        section {
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .wizard>.steps>ul {
                flex-direction: column;
                align-items: center;
            }

            .wizard>.steps>ul>li {
                margin-bottom: 15px;
                max-width: 100%;
            }

            .wizard>.actions>ul {
                flex-direction: column;
            }

            .wizard>.actions>ul>li {
                margin-bottom: 10px;
                width: 100%;
            }

            .wizard>.actions>ul>li>a {
                width: 100%;
                text-align: center;
            }
        }

        /* Floating Labels Effect */
        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-floating>label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            padding: 1rem 0.75rem;
            pointer-events: none;
            border: 1px solid transparent;
            transform-origin: 0 0;
            transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
            color: #6c757d;
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            transform: scale(0.85) translateY(-0.9rem) translateX(0.15rem);
            opacity: 0.65;
            padding: 0;
            background-color: white;
            padding: 0 5px;
            left: 10px;
            top: 5px;
            color: #2575fc;
        }

        /* Info Tooltip */
        .info-tooltip {
            position: relative;
            display: inline-block;
            margin-left: 5px;
            color: #6c757d;
            cursor: pointer;
        }

        .info-tooltip:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #343a40;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 100;
        }

        /* Step Validation Message */
        .step-validation-message {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
            animation: fadeIn 0.3s ease;
        }
    </style>
@endpush

@section('page-title', 'Aturan Kehadiran')

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon animate__animated animate__fadeInDown"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center me-3 me-md-0">
                <i class="ti ti-check-circle fs-5 me-2 text-success"></i>
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- Error Global --}}
    @if ($errors->any())
        <div class="alert customize-alert alert-dismissible border-danger text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon animate__animated animate__shakeX"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center me-3 me-md-0">
                <i class="ti ti-alert-circle fs-5 me-2 text-danger"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    {{-- Notifikasi Validasi Time --}}
    <div id="time_notification"
        class="alert customize-alert alert-dismissible text-danger alert-light-danger bg-danger-subtle fade show remove-close-icon animate__animated"
        role="alert" hidden>
        <button type="button" class="btn-close" onclick="$('#time_notification').attr('hidden', true)"
            aria-label="Close"></button>
        <div class="d-flex align-items-center me-3 me-md-0">
            <i class="ti ti-clock fs-5 me-2 text-danger"></i>
            <p class="message mb-0"></p>
        </div>
    </div>

    <div class="card animate__animated animate__fadeIn">
        <div class="card-header">
            <h4 class="mb-0 text-white"><i class="fas fa-calendar-alt me-2"></i> Tambah Aturan Kehadiran</h4>
        </div>
        <div class="card-body wizard-content">
            <form action="{{ route('rule.store') }}" method="POST" class="validation-wizard wizard-circle"
                id="attendanceRuleForm">
                @csrf
                <!-- Step 1 -->
                <h6 class="d-none">Absen Masuk</h6>
                <section class="py-4">
                    <div class="text-center mb-4">
                        <h4><i class="fas fa-sign-in-alt me-2 text-primary"></i> Aturan Absen Masuk</h4>
                        <p class="text-muted">Silahkan tentukan waktu untuk absen masuk</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('tipe_masuk') is-invalid @enderror"
                                    name="rules[masuk][tipe]" id="tipe_masuk" value="masuk" placeholder="Tipe" readonly />
                                <label for="tipe_masuk">Tipe</label>
                                @error('tipe_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="start_time_masuk" name="rules[masuk][start_time]"
                                    class="form-control required @error('start_time_masuk') is-invalid @enderror"
                                    value="{{ old('start_time_masuk') }}" placeholder="Start Time" required>
                                <label for="start_time_masuk">Start Time <span class="text-danger">*</span></label>
                                @error('start_time_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="end_time_masuk" name="rules[masuk][end_time]"
                                    class="form-control required @error('end_time_masuk') is-invalid @enderror"
                                    value="{{ old('end_time_masuk') }}" placeholder="End Time" required>
                                <label for="end_time_masuk">End Time <span class="text-danger">*</span></label>
                                @error('end_time_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="late_after_masuk" name="rules[masuk][late_after]"
                                    class="form-control required @error('late_after_masuk') is-invalid @enderror"
                                    value="{{ old('late_after_masuk') }}" placeholder="Batas Keterlambatan" required>
                                <label for="late_after_masuk">Batas Keterlambatan <span class="text-danger">*</span></label>
                                <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i> Waktu
                                    setelah ini dianggap terlambat</small>
                                @error('late_after_masuk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div id="step1-validation-message" class="step-validation-message text-center">
                        <i class="fas fa-exclamation-circle me-2"></i> Harap lengkapi semua field pada langkah ini sebelum
                        melanjutkan
                    </div>
                </section>
                <!-- Step 2 -->
                <h6 class="d-none">Absen Pulang</h6>
                <section class="py-4">
                    <div class="text-center mb-4">
                        <h4><i class="fas fa-sign-out-alt me-2 text-primary"></i> Aturan Absen Pulang</h4>
                        <p class="text-muted">Silahkan tentukan waktu untuk absen pulang</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('tipe_pulang') is-invalid @enderror"
                                    name="rules[pulang][tipe]" id="tipe_pulang" value="pulang" placeholder="Tipe"
                                    readonly />
                                <label for="tipe_pulang">Tipe</label>
                                @error('tipe_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="start_time_pulang" name="rules[pulang][start_time]"
                                    class="form-control @error('start_time_pulang') is-invalid @enderror"
                                    value="{{ old('start_time_pulang') }}" placeholder="Start Time">
                                <label for="start_time_pulang">Start Time <span class="text-danger">*</span></label>
                                @error('start_time_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="end_time_pulang" name="rules[pulang][end_time]"
                                    class="form-control @error('end_time_pulang') is-invalid @enderror"
                                    value="{{ old('end_time_pulang') }}" placeholder="End Time">
                                <label for="end_time_pulang">End Time</label>
                                <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i> Boleh
                                    dikosongkan</small>
                                @error('end_time_pulang')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="time" id="late_after_pulang" name="rules[pulang][late_after]"
                                    class="form-control @error('late_after_pulang') is-invalid @enderror"
                                    value="{{ old('late_after_pulang') }}" placeholder="Batas Keterlambatan">
                                <label for="late_after_pulang">Batas Keterlambatan</label>
                                <small class="text-muted mt-1 d-block"><i class="fas fa-info-circle me-1"></i> Boleh
                                    dikosongkan</small>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            function timeToMinutes(timeStr) {
                if (!timeStr) return null;
                const [hour, minute] = timeStr.split(':').map(Number);
                return hour * 60 + minute;
            }

            function showNotification(message) {
                $('#time_notification').removeAttr('hidden').addClass('animate__shakeX');
                $('#time_notification .message').text(message);

                setTimeout(function() {
                    $('#time_notification').attr('hidden', true).removeClass('animate__shakeX');
                }, 5000);
            }

            function hideNotification() {
                $('#time_notification').attr('hidden', true).removeClass('animate__shakeX');
                $('#time_notification .message').text('');
            }

            // Initialize wizard with validation
            var form = $("#attendanceRuleForm");
            var wizard = form.steps({
                headerTag: "h6",
                bodyTag: "section",
                transitionEffect: "slideLeft",
                titleTemplate: '<span class="step"><span class="number">#index#</span></span> #title#',
                labels: {
                    finish: '<i class="fas fa-save me-1"></i> Simpan',
                    next: '<i class="fas fa-arrow-right me-1"></i> Lanjut',
                    previous: '<i class="fas fa-arrow-left me-1"></i> Kembali'
                },
                onStepChanging: function(event, currentIndex, newIndex) {
                    // Always allow going backward
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Validate step 1 before allowing to proceed to step 2
                    if (currentIndex === 0 && newIndex === 1) {
                        var isValid = true;
                        var requiredFields = [
                            '#start_time_masuk',
                            '#end_time_masuk',
                            '#late_after_masuk'
                        ];

                        // Check each required field
                        requiredFields.forEach(function(field) {
                            if (!$(field).val()) {
                                $(field).addClass('is-invalid');
                                isValid = false;
                            } else {
                                $(field).removeClass('is-invalid');
                            }
                        });

                        if (!isValid) {
                            $('#step1-validation-message').show();
                            return false;
                        } else {
                            $('#step1-validation-message').hide();
                        }

                        // Additional time validation
                        const startMasuk = timeToMinutes($('#start_time_masuk').val());
                        const endMasuk = timeToMinutes($('#end_time_masuk').val());
                        const lateAfterMasuk = timeToMinutes($('#late_after_masuk').val());

                        if (endMasuk <= startMasuk) {
                            showNotification('End Time Masuk harus setelah Start Time Masuk');
                            $('#end_time_masuk').addClass('is-invalid');
                            return false;
                        }

                        if (lateAfterMasuk <= startMasuk || lateAfterMasuk >= endMasuk) {
                            showNotification(
                                'Batas Keterlambatan harus di antara Start Time dan End Time Masuk');
                            $('#late_after_masuk').addClass('is-invalid');
                            return false;
                        }
                    }

                    return true;
                },
                onFinishing: function(event, currentIndex) {
                    return form.valid();
                },
                onFinished: function(event, currentIndex) {
                    Swal.fire({
                        title: 'Menyimpan Data',
                        html: 'Sedang memproses aturan kehadiran...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });

                    form.submit();
                }
            });

            // Disable step 2 initially
            wizard.steps('getStep', 1).disabled = true;

            // Enable step 2 when step 1 is completed
            form.on('change', '#start_time_masuk, #end_time_masuk, #late_after_masuk', function() {
                var allFilled = $('#start_time_masuk').val() &&
                    $('#end_time_masuk').val() &&
                    $('#late_after_masuk').val();

                if (allFilled) {
                    wizard.steps('getStep', 1).disabled = false;
                    wizard.steps('setStep', 0); // Refresh steps
                }
            });

            // Time validation for pulang section
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

            // Add animation to form elements on focus
            $('input, select').on('focus', function() {
                $(this).parent().addClass('animate__animated animate__pulse');
            }).on('blur', function() {
                $(this).parent().removeClass('animate__animated animate__pulse');
            });
        });
    </script>
@endpush
