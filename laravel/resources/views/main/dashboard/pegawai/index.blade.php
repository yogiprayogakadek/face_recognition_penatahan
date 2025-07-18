@extends('template.master')

@section('page-title', 'Dashboard')

@push('css')
    {{-- CSS Kustom untuk Tampilan Dashboard yang Lebih Menarik --}}
    <style>
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .greeting-card {
            background: linear-gradient(-45deg, #5668f4, #7b53e5, #4f46e5, #3b82f6);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            border: none;
        }

        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #e9ecef;
            /* Garis tepi yang sangat halus */
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .clock-display {
            font-family: 'Segoe UI', 'Roboto', 'Helvetica Neue', sans-serif;
            font-weight: 700;
            letter-spacing: 2px;
            font-size: 2.5rem;
            /* Lebih besar dan menonjol */
        }

        .date-display {
            font-size: 1rem;
            opacity: 0.9;
        }

        .blinking-colon {
            animation: blink 1s step-end infinite;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        .summary-item {
            padding: 0.75rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
        }

        .summary-item:last-child {
            border-bottom: none;
        }

        .history-table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #dee2e6 !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card greeting-card text-white mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div>
                            <h3 class="fw-bold mb-1" id="greeting">Selamat Sore</h3>
                            <p class="mb-0 fs-4 opacity-75">Selamat datang kembali, mari awali hari dengan produktif!</p>
                            {{-- <p class="fw-semibold fs-5 mt-2">{{ Auth::user()->name ?? 'Nama Pengguna' }}</p> --}}
                        </div>
                        <div class="ms-auto text-center">
                            <div class="clock-display" id="current-time">16:01<span class="blinking-colon">:</span>58</div>
                            <div class="date-display" id="current-date">Jumat, 18 Juli 2025</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title fw-semibold mb-0"><i class="ti ti-history me-2"></i>Histori Absensi Anda</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 380px; overflow-y: auto;">
                        <table class="table table-hover text-nowrap mb-0 history-table">
                            <thead>
                                <tr>
                                    <th class="border-0 px-3">Tanggal</th>
                                    <th class="border-0">Jam Masuk</th>
                                    <th class="border-0">Jam Pulang</th>
                                    <th class="border-0">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($histori as $item)
                                    <tr>
                                        <td class="border-0 px-3 py-3">
                                            <div class="d-flex flex-column">
                                                <span
                                                    class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal_absensi)->translatedFormat('d F Y') }}</span>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_absensi)->translatedFormat('l') }}</small>
                                            </div>
                                        </td>
                                        <td class="border-0 py-3">
                                            <span class="badge fs-3 bg-light-success text-success fw-semibold">
                                                <i class="ti ti-arrow-right-circle me-1"></i>
                                                {{ $item->masuk?->created_at?->format('H:i') ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="border-0 py-3">
                                            <span class="badge fs-3 bg-light-danger text-danger fw-semibold">
                                                <i class="ti ti-arrow-left-circle me-1"></i>
                                                {{ $item->pulang?->created_at?->format('H:i') ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="border-0 py-3">
                                            @if ($item->masuk && $item->pulang)
                                                <span class="badge bg-success rounded-pill">Selesai</span>
                                            @elseif($item->masuk)
                                                <span class="badge bg-info rounded-pill">Sedang Bekerja</span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill">Belum Absen</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="ti ti-cloud-off fs-1 text-muted"></i>
                                            <p class="mt-2 mb-0">Belum ada histori absensi.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span
                            class="text-bg-primary rounded-circle p-3 d-flex align-items-center justify-content-center me-3">
                            <i class="ti ti-clipboard-check fs-5"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-0">Status Hari Ini</h6>
                            <small class="text-muted">{{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}</small>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Absen Masuk</span>
                        <span
                            class="fw-bold fs-4 text-success">{{ $kehadiranMasuk?->created_at?->format('H:i') ?? '--:--' }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Absen Pulang</span>
                        <span
                            class="fw-bold fs-4 text-danger">{{ $kehadiranPulang?->created_at?->format('H:i') ?? '--:--' }}</span>
                    </div>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <span class="text-bg-info rounded-circle p-3 d-flex align-items-center justify-content-center me-3">
                            <i class="ti ti-settings fs-5"></i>
                        </span>
                        <div>
                            <h6 class="fw-semibold mb-0">Aturan Jam Kerja</h6>
                            <small class="text-muted">Sesuai jadwal Anda</small>
                        </div>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Jadwal Masuk</span>
                        <span class="badge bg-light-info text-info fw-semibold">{{ $aturanMasuk->start_time }} -
                            {{ $aturanMasuk->end_time }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Jadwal Pulang</span>
                        <span class="badge bg-light-info text-info fw-semibold">{{ $aturanPulang->start_time }} -
                            {{ $aturanPulang->end_time }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateClock() {
                const now = new Date();
                const optionsDate = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };

                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const currentTimeHTML =
                    `${hours}<span class="blinking-colon">:</span>${minutes}<span class="blinking-colon">:</span>${seconds}`;

                const currentDate = now.toLocaleDateString('id-ID', optionsDate);

                let greetingText = 'Selamat Datang';
                if (hours >= 4 && hours < 11) greetingText = 'Selamat Pagi';
                else if (hours >= 11 && hours < 15) greetingText = 'Selamat Siang';
                else if (hours >= 15 && hours < 19) greetingText = 'Selamat Sore';
                else greetingText = 'Selamat Malam';

                document.getElementById('current-time').innerHTML = currentTimeHTML;
                document.getElementById('current-date').innerText = currentDate;
                document.getElementById('greeting').innerText = greetingText;
            }

            setInterval(updateClock, 1000);
            updateClock();

            setTimeout(() => {
                $('[id^="mini-"]').removeClass('selected');
                $('#dashboard').addClass('selected');
                $('body').attr('data-sidebartype', 'mini-sidebar');
                $('.container-fluid').css('max-width', '1500px');
            }, 1000);
        });
    </script>
@endpush
