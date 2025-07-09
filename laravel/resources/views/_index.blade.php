<!DOCTYPE html>
<html lang="id" class="transition duration-500">

<head>
    <meta charset="UTF-8">
    <title>Absensi Wajah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

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
        <div class="text-center space-y-1">
            <h1 class="text-3xl font-bold text-blue-700 dark:text-blue-400">📸 Absensi Wajah</h1>
            <p id="waktu" class="text-sm text-gray-500 dark:text-gray-300"></p>
            <p id="absen-status" class="inline-block px-3 py-1 rounded-full text-sm font-medium"></p>
            <p id="user-name" class="text-green-600 font-medium text-sm mt-1"></p>
        </div>

        <div class="relative w-full aspect-[4/3] max-h-[60vh] rounded-xl overflow-hidden bg-black">
            <video id="video" autoplay muted playsinline
                class="w-full h-full object-cover brightness-110 contrast-110 rounded-xl"></video>
            <canvas id="overlay" class="w-full h-full"></canvas>
        </div>

        <div class="w-full flex items-center justify-between mt-4">
            <button onclick="toggleDark()"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-sm rounded hover:scale-105 transition">
                🌓 Mode
            </button>

            <button id="scan-btn" class="hidden"></button>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx = overlay.getContext('2d');
        const scanBtn = document.getElementById('scan-btn');
        let maleVoice = null;
        let femaleVoice = null;
        let autoScanDelay = false;

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
                if (resized.length > 0 && !autoScanDelay) {
                    autoScanDelay = true;
                    scan();
                    setTimeout(() => autoScanDelay = false, 5000);
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
                            status.className = "text-green-600 font-medium text-sm mt-1";
                        } else {
                            speak(data.message ?? "Belum waktunya absensi.", femaleVoice);
                            status.textContent = `❌ ${data.message ?? "Belum waktunya absensi"}`;
                            status.className = "text-red-600 font-medium text-sm mt-1";
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

        window.attendanceRules = @json($rules ?? []);

        document.addEventListener('DOMContentLoaded', () => {
            updateClock();
            setInterval(updateClock, 1000);
            loadVoices();
        });
    </script>
</body>

</html>
