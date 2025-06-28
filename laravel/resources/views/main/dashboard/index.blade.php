@extends('template.master')

@section('page-title', 'Dashboard')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .daterangepicker {
            z-index: 9999 !important;
            position: fixed !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border-radius: 10px;
        }

        .daterangepicker::before,
        .daterangepicker::after {
            display: none !important;
        }

        #chartLoader {
            display: none;
            backdrop-filter: blur(4px);
        }
    </style>
@endpush

@section('content')
    <div id="chartLoader" class="align-content-center text-center"
        style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; justify-content:center; align-items:center;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <div class="row">
        {{-- PEGAWAI --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="text-bg-primary p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-users"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="fs-6">Total Pegawai</h4>
                            <h5 class="fs-4 fw-medium text-primary mb-0 text-center">{{ $totalPegawai }}</h5>
                        </div>
                        <div class="ms-auto">
                            <h4 class="fs-6">Laki-laki</h4>
                            <h5 class="fs-4 fw-medium text-primary mb-0 text-center">{{ $laki }}</h5>
                        </div>
                        <div class="ms-auto">
                            <h4 class="fs-6">Perempuan</h4>
                            <h5 class="fs-4 fw-medium text-primary mb-0 text-center">{{ $perempuan }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ATURAN --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="text-bg-info p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-settings"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4 class="fs-6 text-center">Masuk</h4>
                            <h5 class="fs-4 fw-medium text-info mb-0">
                                {{ $aturanMasuk->start_time }} - {{ $aturanMasuk->end_time }}
                            </h5>
                        </div>
                        <div class="ms-auto">
                            <h4 class="fs-6 text-center">Pulang</h4>
                            <h5 class="fs-4 fw-medium text-info mb-0">
                                {{ $aturanPulang->start_time }} - {{ $aturanPulang->end_time ?? '-' }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- JAM --}}
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="text-bg-success p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-clock"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="mx-auto text-center">
                            <h4 class="fs-6">Jam Sekarang</h4>
                            <h5 class="fs-4 fw-medium text-success mb-0" id="current-time"></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- CHART --}}
        <div class="col-lg-12">
            <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
                {{-- <h4 class="mb-0 fs-5">Card with background</h4> --}}
                <div class="ms-auto flex-shrink-0">
                    <div class="btn-group me-2" role="group" aria-label="First group">
                        <button type="button" class="btn btn-primary filter-btn" data-range="7">
                            <i class="ti ti-filter fs-4"></i> 7 hari
                        </button>
                        <button type="button" class="btn btn-primary filter-btn" data-range="30">
                            <i class="ti ti-filter fs-4"></i> 30 hari
                        </button>
                        <button type="button" class="btn btn-primary filter-btn" data-range="90">
                            <i class="ti ti-filter fs-4"></i> 90 hari
                        </button>
                    </div>
                    <button id="dateRangePickerBtn" class="btn btn-primary btn-range">
                        <i class="ti ti-calendar fs-4"></i> Filter by Tanggal
                    </button>

                    <button class="btn bg-primary-subtle text-primary" id="exportChart">
                        <i class="ti ti-download fs-4"></i> Export
                    </button>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="ti ti-chart-area me-2"></i>Grafik Kehadiran
                </div>
                <div class="card-body">
                    <div id="areaChart"></div>
                </div>
            </div>
        </div>

        {{-- CHART DAILY --}}
        <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
            {{-- <h4 class="mb-0 fs-5">Card with background</h4> --}}
            <div class="ms-auto flex-shrink-0">
                <button class="btn bg-primary-subtle text-primary" id="exportCombinedChartDaily">
                    <i class="ti ti-download fs-4"></i> Export
                </button>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="ti ti-chart-donut me-2"></i>Distribusi Kehadiran Masuk Hari Ini
                </div>
                <div class="card-body">
                    <div id="donutChartMasuk"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <i class="ti ti-chart-donut me-2"></i>Distribusi Kehadiran Pulang Hari Ini
                </div>
                <div class="card-body">
                    <div id="donutChartPulang"></div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            document.getElementById('current-time').innerText = currentTime;
        }

        setInterval(updateClock, 1000);
        updateClock();
    </script>

    <script>
        $(document).ready(function() {
            // $('#breadcrumb').hide()
            setTimeout(() => {
                $('[id^="mini-"]').removeClass('selected');
                $('#dashboard').addClass('selected');
                $('body').attr('data-sidebartype', 'mini-sidebar');

                $('.container-fluid').css('max-width', '1500px');
            }, 1000);

            $('#exportChart').on('click', function() {
                areaChart.dataURI().then(({
                    imgURI,
                    svgURI
                }) => {
                    const link = document.createElement('a');
                    link.download = 'chart-kehadiran.png';
                    link.href = imgURI;
                    link.click();
                });
            });

            $('#exportCombinedChartDaily').on('click', function() {
                Promise.all([
                    donutChartMasuk.dataURI(),
                    donutChartPulang.dataURI()
                ]).then(([masuk, pulang]) => {
                    const imgMasuk = new Image();
                    const imgPulang = new Image();

                    imgMasuk.src = masuk.imgURI;
                    imgPulang.src = pulang.imgURI;

                    imgMasuk.onload = function() {
                        imgPulang.onload = function() {
                            const width = imgMasuk.width + imgPulang.width +
                                40; // Tambahkan padding antar gambar
                            const height = Math.max(imgMasuk.height, imgPulang.height);

                            const canvas = document.createElement('canvas');
                            canvas.width = width;
                            canvas.height = height;
                            const ctx = canvas.getContext('2d');

                            // Putih background (optional)
                            ctx.fillStyle = "#fff";
                            ctx.fillRect(0, 0, canvas.width, canvas.height);

                            // Gambar pertama (Masuk)
                            ctx.drawImage(imgMasuk, 0, 0);

                            // Gambar kedua (Pulang) dengan jarak 20px
                            ctx.drawImage(imgPulang, imgMasuk.width + 40, 0);

                            // Buat link untuk download
                            const link = document.createElement('a');
                            link.download = 'chart-daily-combined.png';
                            link.href = canvas.toDataURL('image/png');
                            link.click();
                        }
                    }
                });
            });

        });
    </script>

    <script>
        function showLoader() {
            $('#chartLoader').fadeIn(200);
        }

        function hideLoader() {
            $('#chartLoader').fadeOut(200);
        }

        // === Data dari backend ===
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

        // === Area Chart ===
        const areaChartOptions = {
            chart: {
                type: 'area',
                height: 350,
                toolbar: {
                    show: false
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800
                }
            },
            colors: ['#6366f1', '#34d399'], // Masuk (ungu), Pulang (hijau)
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
                },
                {
                    name: 'Absen Pulang',
                    data: pulangData
                }
            ],
            xaxis: {
                categories: chartLabels,
                labels: {
                    style: {
                        colors: '#9ca3af'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: '#9ca3af'
                    }
                },
                min: 0
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.4,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: val => val + " hadir"
                }
            },
            grid: {
                borderColor: '#e5e7eb',
                strokeDashArray: 4
            },
            legend: {
                position: 'top',
                horizontalAlign: 'left'
            }
        };

        const areaChart = new ApexCharts(document.querySelector("#areaChart"), areaChartOptions);
        areaChart.render();

        // === Donut Chart Masuk ===
        const donutChartMasuk = new ApexCharts(document.querySelector("#donutChartMasuk"), {
            chart: {
                type: 'donut',
                height: 300
            },
            labels: ['Hadir Masuk', 'Tidak Hadir Masuk'],
            series: [donutDataMasuk.hadir, donutDataMasuk.tidak_hadir],
            colors: ['#6366f1', '#f87171'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true
            },
            tooltip: {
                y: {
                    formatter: val => val + ' Orang'
                }
            }
        });
        donutChartMasuk.render();

        // === Donut Chart Pulang ===
        const donutChartPulang = new ApexCharts(document.querySelector("#donutChartPulang"), {
            chart: {
                type: 'donut',
                height: 300
            },
            labels: ['Hadir Pulang', 'Tidak Hadir Pulang'],
            series: [donutDataPulang.hadir, donutDataPulang.tidak_hadir],
            colors: ['#34d399', '#f87171'],
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true
            },
            tooltip: {
                y: {
                    formatter: val => val + ' Orang'
                }
            }
        });
        donutChartPulang.render();

        // === FILTER RANGE BUTTON ===
        $('.filter-btn').on('click', function() {
            $('.filter-btn').removeClass('btn-primary').addClass('btn-light');
            $('.btn-range').removeClass('btn-primary text-light').addClass('btn-light');
            $(this).removeClass('btn-light').addClass('btn-primary');

            const range = $(this).data('range');

            showLoader();
            $.ajax({
                url: "{{ route('dashboard.chart') }}",
                method: 'GET',
                data: {
                    range: range
                },
                success: function(res) {
                    updateAreaChart(res);
                    hideLoader();
                }
            });
        });

        // === FILTER MANUAL BY DATE ===
        $('#dateRangePickerBtn').daterangepicker({
            opens: 'center',
            drops: 'auto',
            autoApply: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Batal',
                applyLabel: 'Terapkan'
            }
        }, function(start, end) {
            filterChartByDate(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
        });

        function filterChartByDate(startDate, endDate) {
            showLoader();
            $.ajax({
                url: "{{ route('dashboard.chart') }}",
                method: 'GET',
                data: {
                    start: startDate,
                    end: endDate
                },
                success: function(res) {
                    updateAreaChart(res);

                    $('.filter-btn').removeClass('btn-primary').addClass('btn-light');
                    $('.btn-range').removeClass('btn-light').addClass('btn-primary text-light');

                    hideLoader();
                }
            });
        }

        // === UPDATE AREA CHART FUNCTION ===
        function updateAreaChart(res) {
            areaChart.updateOptions({
                xaxis: {
                    categories: res.labels
                },
                series: [{
                        name: 'Absen Masuk',
                        data: res.masuk
                    },
                    {
                        name: 'Absen Pulang',
                        data: res.pulang
                    }
                ]
            });
        }
    </script>
@endpush
