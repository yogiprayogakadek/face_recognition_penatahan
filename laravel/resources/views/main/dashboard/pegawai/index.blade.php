@extends('template.master')

@section('page-title', 'Dashboard')

@push('css')
    {{-- CSS Kustom untuk Tampilan Dashboard yang Lebih Menarik --}}
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
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

        /* PRESENSI */
        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 0px #22c55e;
            }

            50% {
                box-shadow: 0 0 12px #22c55e;
            }

            100% {
                box-shadow: 0 0 0px #22c55e;
            }
        }

        .glow-box {
            animation: glow 1.5s ease-in-out infinite;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out;
        }

        .custom-style {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(1.1) contrast(1.1);
            border-radius: 0.75rem;
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

            <div id="presensiSection" hidden>
                <div class="card presensi-card">
                    <div class="card-body p-4">
                        <div class="text-center space-y-1">
                            <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">📸 E-Presensi Face Recognition |
                                Desa
                                Penatahan</h1>
                            {{-- <p id="waktu" class="text-sm text-gray-500 dark:text-gray-300"></p> --}}
                            <p id="presensi-status" class="inline-block px-3 py-1 rounded-full text-sm font-medium"></p>
                            <p id="user-name" class="mt-1"></p>
                        </div>

                        <div
                            class="relative w-full aspect-[4/3] max-h-[60vh] rounded-xl overflow-hidden bg-black glow-box shadow-xl ring-4 ring-blue-400 dark:ring-blue-600">
                            <video id="video" autoplay muted playsinline class="custom-style"></video>
                            <canvas id="overlay" class="w-full h-full"></canvas>
                        </div>

                        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span id="scan-count">Wajah Terdeteksi: 0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card dashboard-card">
                <div class="card-header bg-white border-0 pt-3">
                    <h5 class="card-title fw-semibold mb-0"><i class="ti ti-history me-2"></i>Histori Presensi Anda</h5>
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
                                                    class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal_presensi)->translatedFormat('d F Y') }}</span>
                                                <small
                                                    class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_presensi)->translatedFormat('l') }}</small>
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
                                                <span class="badge bg-secondary rounded-pill">Belum Presensi</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="ti ti-cloud-off fs-1 text-muted"></i>
                                            <p class="mt-2 mb-0">Belum ada histori presensi.</p>
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
                        <span class="text-muted">Presensi Masuk</span>
                        <span
                            class="fw-bold fs-4 text-success">{{ $presensiMasuk?->created_at?->format('H:i') ?? '--:--' }}</span>
                    </div>
                    <div class="summary-item">
                        <span class="text-muted">Presensi Pulang</span>
                        <span
                            class="fw-bold fs-4 text-danger">{{ $presensiPulang?->created_at?->format('H:i') ?? '--:--' }}</span>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-rounded" id="btnPresensi" style="width: 100%">
                        <i class="ti ti-camera fs-5"></i> Presensi
                    </button>
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
        const video = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx = overlay.getContext('2d');
        const scanBtn = document.getElementById('scan-btn');
        const presensiLog = document.getElementById('presensi-log');
        const scanCount = document.getElementById('scan-count');
        let maleVoice = null;
        let femaleVoice = null;
        let autoScanDelay = false;
        // let idleTimer = null;
        let detectedFaces = 0;

        function setTheme(val) {
            const box = document.querySelector('.glow-box');
            const rings = [
                'ring-blue-400',
                'ring-green-400',
                'ring-gray-400',
                'ring-blue-600',
                'ring-green-600',
                'ring-gray-600'
            ];

            box.classList.remove(...rings);

            if (val === 'blue') {
                box.classList.add('ring-blue-400', 'dark:ring-blue-600');
            } else if (val === 'green') {
                box.classList.add('ring-green-400', 'dark:ring-green-600');
            } else {
                box.classList.add('ring-gray-400', 'dark:ring-gray-600');
            }
        }


        function loadVoices() {
            const voices = speechSynthesis.getVoices();
            maleVoice = voices.find(v => v.lang === 'id-ID' && /laki|male/i.test(v.name)) || voices.find(v => v.lang
                .startsWith('id')) || voices.find(v => /male/i.test(v.name));
            femaleVoice = voices.find(v => v.lang === 'id-ID' && /perempuan|female/i.test(v.name)) || voices.find(v => v
                .lang.startsWith('id')) || voices.find(v => /female/i.test(v.name));
        }

        if (typeof speechSynthesis !== 'undefined') {
            speechSynthesis.onvoiceschanged = loadVoices;
        }

        function speak(text, voice = null) {
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'id-ID';
            utter.voice = voice;
            utter.rate = 1;
            speechSynthesis.speak(utter);
        }

        // Promise.all([
        //     faceapi.nets.tinyFaceDetector.loadFromUri('/models')
        // ]).then(startCamera);
        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/models')
        ]);

        let cameraStream = null; // simpan stream global

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    cameraStream = stream;
                    video.srcObject = stream;
                })
                .catch(err => {
                    alert("Tidak dapat mengakses kamera: " + err.message);
                });
        }

        function stopCamera() {
            if (cameraStream) {
                let tracks = cameraStream.getTracks();
                tracks.forEach(track => track.stop());
                video.srcObject = null;
                cameraStream = null;
            }
        }


        video.addEventListener('play', () => {
            const displaySize = {
                width: video.clientWidth,
                height: video.clientHeight
            };
            faceapi.matchDimensions(overlay, displaySize);

            setInterval(async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi
                    .TinyFaceDetectorOptions());
                const resized = faceapi.resizeResults(detections, displaySize);
                ctx.clearRect(0, 0, overlay.width, overlay.height);

                if (resized.length > 0) {
                    detectedFaces++;
                    scanCount.textContent = `Wajah Terdeteksi: ${detectedFaces}`;
                    // resetIdleTimer();
                    if (!autoScanDelay) {
                        autoScanDelay = true;
                        scan();
                        setTimeout(() => autoScanDelay = false, 5000);
                    }
                }

                resized.forEach(det => {
                    const {
                        x,
                        y,
                        width,
                        height
                    } = det.box;
                    ctx.strokeStyle = '#22c55e';
                    ctx.lineWidth = 3;
                    ctx.strokeRect(x, y, width, height);
                });
            }, 300);
        });

        function scan() {
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const c = canvas.getContext('2d');
            c.drawImage(video, 0, 0, canvas.width, canvas.height);

            canvas.toBlob(blob => {
                let formData = new FormData();
                formData.append('image', blob);

                fetch("{{ route('face.verify') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        const status = document.getElementById("user-name");
                        const msg = (data.message || '').toLowerCase();
                        const name = data.nama || "Pengguna";
                        const isSuccess = data.status || msg.includes('berhasil');

                        if (isSuccess) {
                            speak(`Halo ${name}. ${data.message}`, maleVoice);
                            status.textContent = `✅ Dikenali sebagai: ${name}`;
                            status.className =
                                "bg-green-100 text-green-700 px-4 py-2 mt-2 rounded-full font-semibold shadow-sm";
                            presensiLog.innerHTML +=
                                `<li>✅ ${name} - ${new Date().toLocaleTimeString('id-ID')}</li>`;
                        } else {
                            speak(data.message ?? "Belum waktunya presensi.", femaleVoice);
                            status.textContent = `❌ ${data.message ?? "Belum waktunya presensi"}`;
                            status.className =
                                "bg-red-100 text-red-700 px-4 py-2 mt-2 rounded-full font-semibold shadow-sm";
                            presensiLog.innerHTML +=
                                `<li>❌ Gagal - ${new Date().toLocaleTimeString('id-ID')}</li>`;
                            // console.log(presensiLog.innerHTML, "hai")
                        }
                    })
                    .catch(error => {
                        speak("Terjadi kesalahan saat mengirim data.", femaleVoice);
                        // alert("Gagal mengirim data: " + error.message);
                        // console.log(error.message, "error")
                    });
            }, 'image/jpeg');
        }

        function updateClock() {
            const now = new Date();
            const options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Makassar',
                hour12: false
            };
            const formatter = new Intl.DateTimeFormat('id-ID', options);
            document.getElementById('waktu').textContent = 'Waktu (WITA): ' + formatter.format(now);
        }

        function resetIdleTimer() {
            clearTimeout(idleTimer);
            document.body.classList.remove('opacity-30');
            idleTimer = setTimeout(() => {
                document.body.classList.add('opacity-30');
            }, 60000); // 1 menit idle
        }

        function testCameraAndModel() {
            alert("Kamera dan model berhasil dimuat.");
        }

        window.attendanceRules = @json($rules ?? []);

        document.addEventListener('DOMContentLoaded', () => {
            // updateClock();
            // setInterval(updateClock, 1000);
            loadVoices();
            // resetIdleTimer();

            $('#btnPresensi').click(function() {
                let section = $('#presensiSection');
                let btn = $(this);

                if (section.prop('hidden')) {
                    section.prop('hidden', false);
                    startCamera();
                    btn.html('<i class="ti ti-x fs-5"></i> Tutup Presensi');
                } else {
                    section.prop('hidden', true);
                    stopCamera();
                    btn.html('<i class="ti ti-camera fs-5"></i> Presensi');
                }
            });

        });
    </script>
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
