<!DOCTYPE html>
<html lang="id" class="transition duration-500">

<head>
    <meta charset="UTF-8">
    <title>Absensi Wajah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Face API -->
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <!-- Dark Mode Toggle Support -->
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
    </style>
</head>

<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white flex items-center justify-center">

    <div class="w-full max-w-4xl p-4 flex flex-col h-full items-center justify-between">
        <!-- Header -->
        <div class="text-center space-y-1">
            <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">📸 Absensi Wajah</h1>
            <p id="waktu" class="text-sm text-gray-500 dark:text-gray-300"></p>
            <p id="absen-status" class="inline-block px-3 py-1 rounded-full text-sm font-medium"></p>
            <p id="user-name" class="text-green-600 font-medium text-sm mt-1"></p>
        </div>

        <!-- Video Preview -->
        <div class="relative w-full aspect-[4/3] max-h-[60vh] rounded-xl overflow-hidden bg-black">
            <video id="video" autoplay muted playsinline
                class="w-full h-full object-cover brightness-110 contrast-110 rounded-xl"></video>
            <canvas id="overlay" class="w-full h-full"></canvas>
        </div>

        <!-- Buttons -->
        <div class="w-full flex items-center justify-between mt-4">
            <button onclick="toggleDark()"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded hover:scale-105 transition">
                🌓 Mode
            </button>

            <button id="scan-btn"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition disabled:opacity-50 disabled:cursor-not-allowed"
                onclick="scan()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l3-3h12l3 3v10l-3 3H6l-3-3V8z" />
                    <circle cx="12" cy="13" r="3" />
                </svg>
                Scan Wajah
            </button>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx = overlay.getContext('2d');
        const scanBtn = document.getElementById('scan-btn');
        let maleVoice = null;
        let femaleVoice = null;

        function toggleDark() {
            document.documentElement.classList.toggle('dark');
        }

        function loadVoices() {
            const voices = speechSynthesis.getVoices();
            maleVoice = voices.find(v => v.lang === 'id-ID' && /laki|male/i.test(v.name)) ||
                voices.find(v => v.lang.startsWith('id')) ||
                voices.find(v => /male/i.test(v.name));
            femaleVoice = voices.find(v => v.lang === 'id-ID' && /perempuan|female/i.test(v.name)) ||
                voices.find(v => v.lang.startsWith('id')) ||
                voices.find(v => /female/i.test(v.name));
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
            }, 200);
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
                            status.className = "text-green-600 font-medium text-sm mt-1";
                        } else {
                            speak(data.message ?? "Absensi gagal. Silakan coba lagi.", femaleVoice);
                            status.textContent = `❌ Wajah tidak dikenali`;
                            status.className = "text-red-600 font-medium text-sm mt-1";
                        }

                        // alert(data.message ?? 'Tidak ada respon');
                    })
                    .catch(error => {
                        speak("Terjadi kesalahan saat mengirim data.", femaleVoice);
                        // alert("Gagal mengirim data: " + error.message);
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

        function checkAbsenStatus() {
            const now = new Date();
            const makassarTime = new Date(now.toLocaleString('en-US', {
                timeZone: 'Asia/Makassar'
            }));
            const currentTime = makassarTime.getHours() * 60 + makassarTime.getMinutes();

            const rules = window.attendanceRules || [];
            const statusEl = document.getElementById('absen-status');

            for (const rule of rules) {
                const [startH, startM] = rule.start_time.split(':').map(Number);
                const [endH, endM] = rule.end_time.split(':').map(Number);
                const startMin = startH * 60 + startM;
                const endMin = endH * 60 + endM;

                if (currentTime >= startMin && currentTime <= endMin) {
                    scanBtn.disabled = false;
                    statusEl.textContent = '🟢 Silakan absensi sekarang (' + rule.tipe + ')';
                    statusEl.className = 'bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium';
                    return;
                }
            }

            scanBtn.disabled = true;
            statusEl.textContent = '🔴 Di luar jam absensi';
            statusEl.className = 'bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-medium';
        }

        window.attendanceRules = @json($rules ?? []);

        document.addEventListener('DOMContentLoaded', () => {
            updateClock();
            setInterval(updateClock, 1000);

            checkAbsenStatus();
            setInterval(checkAbsenStatus, 10000);

            loadVoices();
        });
    </script>
</body>

</html>
