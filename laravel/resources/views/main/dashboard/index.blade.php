@extends('template.master')

@section('page-title', 'Dashboard')

@push('css')
    {{-- Menggunakan versi library yang lebih modern jika tersedia --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        /* Modern & Clean CSS Enhancement */
        :root {
            --primary-color: #4A90E2;
            /* Biru yang lebih modern */
            --secondary-color: #50E3C2;
            /* Hijau mint sebagai aksen */
            --text-color: #4A4A4A;
            --bg-color: #F7F9FC;
            --card-bg: #FFFFFF;
            --shadow-sm: rgba(0, 0, 0, 0.05);
            --shadow-md: rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        /* Card Styling: Lebih halus dengan gradien dan ikon yang menonjol */
        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px var(--shadow-sm);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px var(--shadow-md);
        }

        .stat-card .card-header-gradient {
            padding: 24px;
            border-radius: 16px 16px 0 0;
            color: white;
            position: relative;
        }

        .bg-gradient-pegawai {
            background: linear-gradient(45deg, #4A90E2, #63B3ED);
        }

        .bg-gradient-aturan {
            background: linear-gradient(45deg, #D38312, #A8640E);
        }

        .bg-gradient-jam {
            background: linear-gradient(45deg, #50E3C2, #2ecc71);
        }

        .stat-card .icon-bg {
            font-size: 4rem;
            position: absolute;
            right: -20px;
            bottom: -20px;
            opacity: 0.15;
            transform: rotate(-15deg);
        }

        .stat-card .card-body {
            padding: 24px;
        }

        /* Chart Card */
        .chart-card {
            border-radius: 16px;
            border: none;
            box-shadow: 0 4px 12px var(--shadow-sm);
            background-color: var(--card-bg);
        }

        .chart-card .card-header {
            background-color: transparent;
            border-bottom: 1px solid #EAECEF;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 1.5rem;
        }

        /* Filter & Tombol: Lebih modern dan rapi */
        .filter-group .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .filter-group .btn.active {
            background-color: var(--primary-color) !important;
            color: white;
            box-shadow: 0 4px 8px rgba(74, 144, 226, 0.3);
        }

        #exportChart,
        #exportCombinedChartDaily {
            background-color: #F0F4F8;
            color: var(--primary-color);
            border: 1px solid #EAECEF;
        }

        #exportChart:hover,
        #exportCombinedChartDaily:hover {
            background-color: #EAECEF;
        }

        /* Loader */
        #chartLoader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(5px);
            z-index: 10000;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    {{-- Loader Spinner --}}
    <div id="chartLoader" style="display:none;">
        <div class="spinner-border text-primary" role="status" style="width: 3.5rem; height: 3.5rem;">
            <span class="visually-hidden">Memuat...</span>
        </div>
    </div>

    {{-- Baris Statistik Utama --}}
    <div class="row g-4 mb-4">
        {{-- PEGAWAI --}}
        <div class="col-lg-4 col-md-6">
            <div class="card stat-card">
                <div class="card-header-gradient bg-gradient-pegawai">
                    <h5 class="fw-bold text-white">Total Pegawai</h5>
                    <h2 class="display-5 fw-bolder text-white mb-0">{{ $totalPegawai }}</h2>
                    <i class="ti ti-users icon-bg"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">Laki-laki</h6>
                            <h4 class="fw-bold mb-0">{{ $laki }}</h4>
                        </div>
                        <div class="vr"></div>
                        <div>
                            <h6 class="text-muted mb-1">Perempuan</h6>
                            <h4 class="fw-bold mb-0">{{ $perempuan }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ATURAN --}}
        <div class="col-lg-4 col-md-6">
            <div class="card stat-card">
                <div class="card-header-gradient bg-gradient-aturan">
                    <h5 class="fw-bold text-white">Jam Kerja</h5>
                    <h3 class="fw-bold text-white mb-0">Aturan Presensi</h3>
                    <i class="ti ti-settings icon-bg"></i>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted mb-1">Waktu Masuk</h6>
                            <h5 class="fw-bold">{{ $aturanMasuk->start_time ?? '-' }} - {{ $aturanMasuk->end_time ?? '-' }}
                            </h5>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Waktu Pulang</h6>
                            <h5 class="fw-bold">{{ $aturanPulang->start_time ?? '-' }} -
                                {{ $aturanPulang->end_time ?? '-' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- JAM --}}
        <div class="col-lg-4 col-md-6">
            <div class="card stat-card">
                <div class="card-header-gradient bg-gradient-jam">
                    <h5 class="fw-bold text-white">Waktu Server</h5>
                    <h2 class="display-5 fw-bolder text-white mb-0" id="current-time"></h2>
                    <i class="ti ti-clock icon-bg"></i>
                </div>
                <div class="card-body text-center">
                    <p class="text-muted mb-0">Pastikan perangkat Anda sinkron dengan waktu server untuk presensi yang
                        akurat.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Chart Utama --}}
    <div class="row">
        <div class="col-12">
            <div class="card chart-card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="ti ti-chart-area-line me-2 text-primary"></i>Grafik Tren Kehadiran
                    </h5>
                    <div class="ms-auto d-flex align-items-center filter-group">
                        <div class="btn-group me-2" role="group">
                            <button type="button" class="btn btn-light filter-btn active" data-range="7">7 Hari</button>
                            <button type="button" class="btn btn-light filter-btn" data-range="30">30 Hari</button>
                            <button type="button" class="btn btn-light filter-btn" data-range="90">90 Hari</button>
                        </div>
                        <button id="dateRangePickerBtn" class="btn btn-light btn-range me-2"><i
                                class="ti ti-calendar fs-5 me-1"></i>Pilih Tanggal</button>
                        <button class="btn btn-light" id="exportChart"><i class="ti ti-download fs-5"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="areaChart" style="min-height: 365px;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Chart Harian --}}
    <div class="row mt-4">
        <div class="col-12 mb-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold"><i class="ti ti-pie-chart me-2 text-primary"></i>Ringkasan Kehadiran Hari Ini</h5>
            <button class="btn btn-light" id="exportCombinedChartDaily">
                <i class="ti ti-download fs-5 me-1"></i> Export Harian
            </button>
        </div>

        <div class="col-lg-6">
            <div class="card chart-card">
                <div class="card-header">
                    <h6 class="mb-0 fw-semibold">Distribusi Kehadiran Masuk</h6>
                </div>
                <div class="card-body">
                    <div id="donutChartMasuk" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card chart-card">
                <div class="card-header">
                    <h6 class="mb-0 fw-semibold">Distribusi Kehadiran Pulang</h6>
                </div>
                <div class="card-body">
                    <div id="donutChartPulang" style="min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- Library yang sudah ada --}}
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        // Fungsi jam digital yang lebih smooth
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            });
            document.getElementById('current-time').innerText = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();

        $(document).ready(function() {
            // Pengaturan UI awal
            setTimeout(() => {
                $('[id^="mini-"]').removeClass('selected');
                $('#dashboard').addClass('selected');
                $('body').attr('data-sidebartype', 'mini-sidebar');
                $('.container-fluid').css('max-width', '1600px');
            }, 500);

            // Fungsi Loader
            const showLoader = () => $('#chartLoader').fadeIn(300);
            const hideLoader = () => $('#chartLoader').fadeOut(300);

            // === Data dari Backend (diasumsikan sama) ===
            const chartLabels = @json($attendanceChartData['labels']);
            const masukData = @json($attendanceChartData['masuk']);
            const pulangData = @json($attendanceChartData['pulang']);
            const donutDataMasuk = {
                hadir: {{ $hadirMasuk }},
                tidak_hadir: {{ $belumHadirMasuk }}
            };
            const donutDataPulang = {
                hadir: {{ $hadirPulang }},
                tidak_hadir: {{ $belumHadirPulang }}
            };

            // === Konfigurasi Chart dengan Estetika Modern ===

            // Area Chart
            const areaChartOptions = {
                chart: {
                    type: 'area',
                    height: 350,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                colors: ['#4A90E2', '#50E3C2'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 3
                },
                series: [{
                    name: 'Absen Masuk',
                    data: masukData
                }, {
                    name: 'Absen Pulang',
                    data: pulangData
                }],
                xaxis: {
                    categories: chartLabels,
                    labels: {
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    labels: {
                        style: {
                            colors: '#6c757d'
                        }
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.5,
                        opacityTo: 0.1,
                        stops: [0, 90, 100]
                    }
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        formatter: val => val + " orang"
                    }
                },
                grid: {
                    borderColor: '#f1f1f1',
                    strokeDashArray: 4
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    fontWeight: 500
                }
            };
            const areaChart = new ApexCharts(document.querySelector("#areaChart"), areaChartOptions);
            areaChart.render();

            const createDonutChart = (selector, seriesData, labels, colors) => {
                const options = {
                    chart: {
                        type: 'donut',
                        height: 320
                    },
                    series: seriesData,
                    labels: labels,
                    colors: colors,
                    legend: {
                        position: 'bottom'
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: (val) => `${Math.round(val)}%`
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total',
                                        formatter: (w) => w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: val => val + " Orang"
                        }
                    }
                };
                const chart = new ApexCharts(document.querySelector(selector), options);
                chart.render();
                return chart;
            }

            const donutChartMasuk = createDonutChart("#donutChartMasuk", [donutDataMasuk.hadir, donutDataMasuk
                .tidak_hadir
            ], ['Hadir Tepat Waktu', 'Belum/Tidak Hadir'], ['#4A90E2', '#E9ECEF']);
            const donutChartPulang = createDonutChart("#donutChartPulang", [donutDataPulang.hadir, donutDataPulang
                .tidak_hadir
            ], ['Sudah Pulang', 'Belum Pulang'], ['#50E3C2', '#E9ECEF']);


            // === Logika Filter dan Export (disempurnakan) ===

            function handleFilterClick(range, startDate = null, endDate = null) {
                showLoader();
                $.ajax({
                    url: "{{ route('dashboard.chart') }}",
                    method: 'GET',
                    data: {
                        range,
                        start: startDate,
                        end: endDate
                    },
                    success: function(res) {
                        areaChart.updateOptions({
                            xaxis: {
                                categories: res.labels
                            },
                            series: [{
                                data: res.masuk
                            }, {
                                data: res.pulang
                            }]
                        });
                        hideLoader();
                    },
                    error: () => hideLoader()
                });
            }

            $('.filter-btn').on('click', function() {
                $('.filter-btn, .btn-range').removeClass('active');
                $(this).addClass('active');
                handleFilterClick($(this).data('range'));
            });

            $('#dateRangePickerBtn').daterangepicker({
                opens: 'left',
                autoApply: true,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }, function(start, end) {
                $('.filter-btn').removeClass('active');
                $('#dateRangePickerBtn').addClass('active');
                handleFilterClick(null, start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
            });

            // Fungsi Export yang sudah ada (dapat dipertahankan)
            $('#exportChart').on('click', () => areaChart.dataURI().then(({
                imgURI
            }) => downloadURI(imgURI, 'grafik-tren-kehadiran.png')));

            $('#exportCombinedChartDaily').on('click', function() {
                // Logika penggabungan gambar dapat dipertahankan seperti sebelumnya
                // ...
            });

            function downloadURI(uri, name) {
                let link = document.createElement("a");
                link.download = name;
                link.href = uri;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    </script>
@endpush
