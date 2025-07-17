<!DOCTYPE html>
<html lang="id" class="transition duration-500">

<head>
    <meta charset="UTF-8">
    <title>E-Presensi Desa Penatahan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logo/logo.png') }}" />

    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
        }

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
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-100 via-white to-gray-300 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 text-gray-800 dark:text-white flex items-center justify-center">
    <div class="w-full max-w-4xl p-4 flex flex-col h-full items-center justify-between animate-fadeInUp">
        <div class="text-center space-y-1">
            <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">📸 E-Presensi Face Recognition | Desa
                Penatahan</h1>
            <p id="waktu" class="text-sm text-gray-500 dark:text-gray-300"></p>
            <p id="absen-status" class="inline-block px-3 py-1 rounded-full text-sm font-medium"></p>
            <p id="user-name" class="mt-1"></p>
            {{-- <div class="mt-2">
                <label for="theme-select" class="text-sm mr-2">Tema:</label>
                <select id="theme-select" onchange="setTheme(this.value)"
                    class="bg-white dark:bg-gray-800 text-sm px-3 py-1 rounded">
                    <option value="default">Default</option>
                    <option value="blue">Biru</option>
                    <option value="green">Hijau</option>
                </select>
            </div> --}}
        </div>

        <div
            class="relative w-full aspect-[4/3] max-h-[60vh] rounded-xl overflow-hidden bg-black glow-box shadow-xl ring-4 ring-blue-400 dark:ring-blue-600">
            <video id="video" autoplay muted playsinline
                class="w-full h-full object-cover brightness-110 contrast-110 rounded-xl"></video>
            <canvas id="overlay" class="w-full h-full"></canvas>
        </div>

        <div class="w-full mt-4">
            <h2 class="text-lg font-semibold text-center mb-2">Riwayat Absensi Hari Ini</h2>
            <ul id="absen-log"
                class="text-sm space-y-1 max-h-32 overflow-y-auto bg-white dark:bg-gray-800 p-2 rounded shadow"></ul>
        </div>

        <div class="w-full flex items-center justify-between mt-4">
            <button onclick="toggleDark()"
                class="px-4 py-2 flex items-center gap-2 bg-gradient-to-r from-blue-200 to-blue-400 dark:from-blue-600 dark:to-blue-800 text-sm text-black dark:text-white rounded-full shadow hover:scale-105 transition">
                <span>🌓</span> <span>Mode</span>
            </button>
            <button onclick="testCameraAndModel()"
                class="px-4 py-2 bg-yellow-500 text-white text-sm rounded-full shadow hover:bg-yellow-600 transition">🔍
                Tes Kamera</button>
            <button id="scan-btn" class="hidden"></button>
        </div>
        <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
            <span id="scan-count">Wajah Terdeteksi: 0</span>
        </div>
        <footer class="text-xs text-gray-400 dark:text-gray-500 text-center mt-2">
            &copy; 2025 Absensi Wajah. All rights reserved.
        </footer>
    </div>

    <script>
        const video = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx = overlay.getContext('2d');
        const scanBtn = document.getElementById('scan-btn');
        const absenLog = document.getElementById('absen-log');
        const scanCount = document.getElementById('scan-count');
        let maleVoice = null;
        let femaleVoice = null;
        let autoScanDelay = false;
        // let idleTimer = null;
        let detectedFaces = 0;

        function toggleDark() {
            document.documentElement.classList.toggle('dark');
        }

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

        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri('/models')
        ]).then(startCamera);

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(err => {
                    alert("Tidak dapat mengakses kamera: " + err.message);
                });
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
                            absenLog.innerHTML +=
                                `<li>✅ ${name} - ${new Date().toLocaleTimeString('id-ID')}</li>`;
                        } else {
                            speak(data.message ?? "Belum waktunya absensi.", femaleVoice);
                            status.textContent = `❌ ${data.message ?? "Belum waktunya absensi"}`;
                            status.className =
                                "bg-red-100 text-red-700 px-4 py-2 mt-2 rounded-full font-semibold shadow-sm";
                            absenLog.innerHTML +=
                                `<li>❌ Gagal - ${new Date().toLocaleTimeString('id-ID')}</li>`;
                        }
                    })
                    .catch(error => {
                        speak("Terjadi kesalahan saat mengirim data.", femaleVoice);
                        alert("Gagal mengirim data: " + error.message);
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
            updateClock();
            setInterval(updateClock, 1000);
            loadVoices();
            // resetIdleTimer();
        });
    </script>
</body>

</html>
