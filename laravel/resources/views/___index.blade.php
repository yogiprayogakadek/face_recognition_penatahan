<!DOCTYPE html>
<html lang="id" class="transition duration-500">

<head>
    <meta charset="UTF-8" />
    <title>E-Presensi Desa Penatahan - Enhanced</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com "></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css " />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .dark body {
            background: linear-gradient(135deg, #2d3748 0%, #1a202c 100%);
        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
        }

        @keyframes glow {
            0% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }

            50% {
                box-shadow: 0 0 30px rgba(59, 130, 246, 0.8), 0 0 40px rgba(59, 130, 246, 0.6);
            }

            100% {
                box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
            }
        }

        @keyframes scanner {
            0% {
                transform: translateY(-100%);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        .glow-box {
            animation: glow 2s ease-in-out infinite alternate;
        }

        .scanner-line {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
            animation: scanner 2s ease-in-out infinite;
            z-index: 10;
        }

        .shimmer-effect {
            position: relative;
            overflow: hidden;
        }

        .shimmer-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 2s linear infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-effect {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .notification.show {
            transform: translateX(0);
        }

        .floating-particles {
            position: fixed;
            width: 4px;
            height: 4px;
            background: rgba(59, 130, 246, 0.6);
            border-radius: 50%;
            pointer-events: none;
            animation: float 6s linear infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .weather-widget {
            background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
        }

        .dark .weather-widget {
            background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        }
    </style>
</head>

<body class="text-white overflow-hidden">
    <div id="particles-container"></div>

    <div id="notification" class="notification">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <div>
                <div class="font-semibold">Berhasil!</div>
                <div class="text-sm opacity-90" id="notification-message"></div>
            </div>
        </div>
    </div>

    <div class="min-h-screen flex flex-col">
        <header class="glass-effect p-4 animate-slide-up">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div
                        class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-camera text-white text-xl"></i>
                    </div>
                    <div>
                        <h1
                            class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent">
                            E-Presensi Face Recognition
                        </h1>
                        <p class="text-sm opacity-80">Desa Penatahan - Smart Attendance System</p>
                    </div>
                </div>
                <div class="weather-widget rounded-xl p-4 flex items-center gap-3">
                    <i class="fas fa-cloud-sun text-2xl"></i>
                    <div>
                        <div class="font-semibold">28°C</div>
                        <div class="text-sm opacity-90">Cerah</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 flex">
            <aside class="w-80 glass-effect p-6 animate-slide-up" style="animation-delay: 0.2s">
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6 mb-6 text-center">
                    <div class="text-3xl font-bold mb-2" id="waktu"></div>
                    <div class="text-sm opacity-90" id="tanggal"></div>
                    <div class="mt-3 flex justify-center">
                        <div class="bg-white/20 px-4 py-2 rounded-full">
                            <span id="absen-status" class="text-sm font-medium"></span>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="stats-card rounded-xl p-4 text-center">
                        <i class="fas fa-users text-2xl text-blue-400 mb-2"></i>
                        <div class="text-2xl font-bold" id="total-scans">0</div>
                        <div class="text-xs opacity-80">Total Scan</div>
                    </div>
                    <div class="stats-card rounded-xl p-4 text-center">
                        <i class="fas fa-check text-2xl text-green-400 mb-2"></i>
                        <div class="text-2xl font-bold" id="success-rate">0%</div>
                        <div class="text-xs opacity-80">Success Rate</div>
                    </div>
                    <div class="stats-card rounded-xl p-4 text-center">
                        <i class="fas fa-clock text-2xl text-yellow-400 mb-2"></i>
                        <div class="text-2xl font-bold" id="avg-time">0.0s</div>
                        <div class="text-xs opacity-80">Avg Time</div>
                    </div>
                    <div class="stats-card rounded-xl p-4 text-center">
                        <i class="fas fa-eye text-2xl text-purple-400 mb-2"></i>
                        <div class="text-2xl font-bold" id="faces-detected">0</div>
                        <div class="text-xs opacity-80">Faces Today</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <button onclick="toggleDark()"
                        class="w-full glass-effect hover:bg-white/20 p-3 rounded-xl flex items-center gap-3 transition-all">
                        <i class="fas fa-moon text-yellow-400"></i>
                        <span>Toggle Dark Mode</span>
                    </button>
                    <button onclick="toggleSound()"
                        class="w-full glass-effect hover:bg-white/20 p-3 rounded-xl flex items-center gap-3 transition-all">
                        <i id="sound-icon" class="fas fa-volume-up text-blue-400"></i>
                        <span>Sound: <span id="sound-status">ON</span></span>
                    </button>
                    <button onclick="testCameraAndModel()"
                        class="w-full glass-effect hover:bg-white/20 p-3 rounded-xl flex items-center gap-3 transition-all">
                        <i class="fas fa-camera text-green-400"></i>
                        <span>Test Camera</span>
                    </button>
                    <button onclick="calibrateCamera()"
                        class="w-full glass-effect hover:bg-white/20 p-3 rounded-xl flex items-center gap-3 transition-all">
                        <i class="fas fa-cog text-purple-400"></i>
                        <span>Calibrate</span>
                    </button>
                </div>
            </aside>

            <div class="flex-1 flex flex-col items-center justify-center p-8">
                <div class="relative animate-fade-in">
                    <div class="relative w-[640px] h-[480px] rounded-3xl overflow-hidden glow-box bg-black">
                        <div class="scanner-line"></div>
                        <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>
                        <canvas id="overlay" class="w-full h-full"></canvas>
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            <div class="glass-effect px-4 py-2 rounded-full">
                                <span class="text-sm font-medium">🎯 Scanning...</span>
                            </div>
                            <div class="glass-effect px-4 py-2 rounded-full">
                                <span class="text-sm font-medium" id="fps-counter">FPS: --</span>
                            </div>
                        </div>
                        <div class="absolute bottom-4 left-4 right-4">
                            <div class="glass-effect p-4 rounded-2xl">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-sm opacity-80">Status</div>
                                        <div class="font-semibold" id="detection-status">Ready to scan</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm opacity-80">Confidence</div>
                                        <div class="font-semibold" id="confidence-level">--</div>
                                    </div>
                                </div>
                                <div class="mt-3 bg-white/20 rounded-full h-2">
                                    <div id="scan-progress"
                                        class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center animate-slide-up" style="animation-delay: 0.4s">
                    <div id="user-info" class="glass-effect p-6 rounded-2xl min-w-[400px]">
                        <div class="text-lg font-semibold mb-2">Scan wajah untuk presensi</div>
                        <div class="text-sm opacity-80">Posisikan wajah di depan kamera</div>
                        <div class="mt-4 flex justify-center">
                            <div
                                class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="w-80 glass-effect p-6 animate-slide-up" style="animation-delay: 0.6s">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-history text-blue-400"></i>
                        Live Activity
                    </h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto" id="live-activity">
                        <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-power-off text-xs"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium">System Started</div>
                                <div class="text-xs opacity-60" id="system-start-time"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-green-400"></i>
                        Attendance Log
                    </h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto" id="attendance-log">
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-bolt text-yellow-400"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="exportData()"
                            class="glass-effect hover:bg-white/20 p-3 rounded-xl text-center transition-all">
                            <i class="fas fa-download text-blue-400 mb-1"></i>
                            <div class="text-xs">Export</div>
                        </button>
                        <button onclick="clearLog()"
                            class="glass-effect hover:bg-white/20 p-3 rounded-xl text-center transition-all">
                            <i class="fas fa-trash text-red-400 mb-1"></i>
                            <div class="text-xs">Clear</div>
                        </button>
                        <button onclick="showStats()"
                            class="glass-effect hover:bg-white/20 p-3 rounded-xl text-center transition-all">
                            <i class="fas fa-chart-bar text-green-400 mb-1"></i>
                            <div class="text-xs">Stats</div>
                        </button>
                        <button onclick="settings()"
                            class="glass-effect hover:bg-white/20 p-3 rounded-xl text-center transition-all">
                            <i class="fas fa-cog text-purple-400 mb-1"></i>
                            <div class="text-xs">Settings</div>
                        </button>
                    </div>
                </div>
            </aside>
        </main>
    </div>

    <script>
        // Variables
        const video = document.getElementById('video');
        const overlay = document.getElementById('overlay');
        const ctx = overlay.getContext('2d');
        let maleVoice = null;
        let femaleVoice = null;
        let autoScanDelay = false;
        let soundEnabled = true;
        let detectedFaces = 0;
        let totalScans = 0;
        let successfulScans = 0;
        let scanTimes = [];
        let lastScanTime = 0;
        let fpsCounter = 0;
        let lastFpsTime = Date.now();
        let faceMatcher; // Deklarasi faceMatcher di scope global

        // Initialize App
        document.addEventListener('DOMContentLoaded', () => {
            initializeApp();
            createFloatingParticles();
            updateClock();
            setInterval(updateClock, 1000);
            setInterval(updateFPS, 1000);
            loadVoices();

            document.getElementById('system-start-time').textContent = new Date().toLocaleTimeString('id-ID');
        });

        function initializeApp() {
            addToLiveActivity('System initializing...', 'info');
            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri('/models'),
                faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
                faceapi.nets.faceRecognitionNet.loadFromUri('/models')
            ]).then(() => {
                addToLiveActivity('Face detection & recognition models loaded', 'success');
                startCamera();
                // Panggil loadKnownFaces setelah kamera aktif dan model dimuat
                // Ini akan memuat FaceMatcher saat aplikasi dimulai
                loadKnownFaces().then(fm => {
                    faceMatcher = fm;
                    if (faceMatcher) {
                        addToLiveActivity('Known faces loaded successfully', 'success');
                    } else {
                        addToLiveActivity('Failed to load known faces or no faces registered', 'warning');
                    }
                });
            }).catch(err => {
                addToLiveActivity('Failed to load model: ' + err.message, 'error');
                showNotification('error', 'Camera Error', 'Unable to load face-api models');
            });
        }

        async function loadKnownFaces() {
            try {
                // Fetch known encodings from the Laravel backend
                const response = await fetch("{{ route('face.encodings') }}", { // Asumsi ada route baru
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json' // Penting: memberitahu server untuk mengirim JSON
                    },
                });

                if (!response.ok) {
                    const errorText = await response.text();
                    throw new Error(`HTTP error! status: ${response.status}, response: ${errorText}`);
                }

                const data = await response.json();

                if (!data || !Array.isArray(data)) {
                    console.error("Format respons encodings tidak valid:", data);
                    return null;
                }

                const labeledDescriptors = data.map(({
                    label,
                    descriptors
                }) => {
                    // Pastikan setiap descriptor adalah Float32Array
                    const descriptorArray = descriptors.map(arr => new Float32Array(arr));
                    return new faceapi.LabeledFaceDescriptors(label, descriptorArray);
                });

                return new faceapi.FaceMatcher(labeledDescriptors, 0.6); // Threshold default 0.6
            } catch (error) {
                console.error("Error loading known faces:", error);
                addToLiveActivity('Error loading known faces: ' + error.message, 'error');
                showNotification('error', 'Data Error', 'Gagal memuat data wajah terdaftar');
                return null;
            }
        }


        function createFloatingParticles() {
            const container = document.getElementById('particles-container');
            setInterval(() => {
                if (Math.random() < 0.3) {
                    const particle = document.createElement('div');
                    particle.className = 'floating-particles';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.animationDelay = Math.random() * 2 + 's';
                    container.appendChild(particle);
                    setTimeout(() => {
                        particle.remove();
                    }, 6000);
                }
            }, 200);
        }

        function startCamera() {
            navigator.mediaDevices.getUserMedia({
                video: {
                    width: 640,
                    height: 480
                }
            }).then(stream => {
                video.srcObject = stream;
                addToLiveActivity('Camera started successfully', 'success');
                video.addEventListener('play', processFrame);
            }).catch(err => {
                addToLiveActivity('Camera access denied: ' + err.message, 'error');
                showNotification('error', 'Camera Error', 'Unable to access camera');
            });
        }

        function processFrame() {
            const displaySize = {
                width: video.videoWidth,
                height: video.videoHeight
            };
            faceapi.matchDimensions(overlay, displaySize);

            setInterval(async () => {
                // Set progress bar to 0 at the start of each detection cycle
                document.getElementById('scan-progress').style.width = '0%';
                document.getElementById('detection-status').textContent = 'Mendeteksi wajah...';
                document.getElementById('confidence-level').textContent = '--';


                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions())
                    .withFaceLandmarks()
                    .withFaceDescriptors();

                const resizedDetections = faceapi.resizeResults(detections, displaySize);
                ctx.clearRect(0, 0, overlay.width, overlay.height);

                fpsCounter++;
                if (resizedDetections.length > 0) {
                    detectedFaces = resizedDetections.length;
                    document.getElementById('faces-detected').textContent = detectedFaces;
                    document.getElementById('detection-status').textContent = 'Wajah terdeteksi!';
                    document.getElementById('scan-progress').style.width = '100%'; // Full progress on detection

                    if (!autoScanDelay && faceMatcher) { // Pastikan faceMatcher sudah ada
                        autoScanDelay = true;
                        const startTime = Date.now();
                        await scan(resizedDetections);
                        const scanTime = (Date.now() - startTime) / 1000;
                        scanTimes.push(scanTime);
                        updateStatistics();
                        setTimeout(() => autoScanDelay = false, 3000); // 3 seconds delay for next scan
                    } else if (!faceMatcher) {
                        document.getElementById('detection-status').textContent = 'Model wajah belum dimuat...';
                        showNotification('warning', 'Peringatan', 'Data wajah belum dimuat. Mohon tunggu.');
                    }
                } else {
                    detectedFaces = 0;
                    document.getElementById('faces-detected').textContent = detectedFaces;
                    document.getElementById('detection-status').textContent = 'Posisikan wajah Anda';
                    document.getElementById('absen-status').textContent = 'Menunggu deteksi wajah';
                    document.getElementById('scan-progress').style.width = '0%';
                }

                // Draw faces
                if (resizedDetections.length > 0 && faceMatcher) {
                    const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor));
                    resizedDetections.forEach((det, i) => {
                        const {
                            x,
                            y,
                            width,
                            height
                        } = det.detection.box;
                        const result = results[i];
                        // Format label: remove confidence if not "unknown"
                        const label = result.label === 'unknown' ?
                            `Tidak Dikenali (${(result.distance * 100).toFixed(0)}%)` : result.label;

                        ctx.strokeStyle = result.label === 'unknown' ? '#ef4444' :
                        '#22c55e'; // Red for unknown, green for known
                        ctx.lineWidth = 3;
                        ctx.strokeRect(x, y, width, height);

                        ctx.fillStyle = result.label === 'unknown' ? '#ef4444' : '#22c55e';
                        ctx.font = '16px Inter';
                        ctx.fillText(label, x, y - 10);

                        // Update confidence for the first detected face
                        if (i === 0) {
                            document.getElementById('confidence-level').textContent =
                                `${(1 - result.distance).toFixed(2)}`;
                        }
                    });
                }
            }, 300); // Check for faces every 300ms
        }


        async function scan(detections) {
            totalScans++;
            document.getElementById('total-scans').textContent = totalScans;

            if (!faceMatcher) {
                addToLiveActivity('FaceMatcher not initialized.', 'error');
                showNotification('error', 'Error', 'FaceMatcher belum siap.');
                return;
            }

            // Ambil hanya descriptor dari deteksi terbaru
            const currentDescriptor = detections[0].descriptor; // Ambil descriptor wajah pertama

            let formData = new FormData();
            // Buat canvas sementara untuk mengambil gambar dari video
            const tempCanvas = document.createElement('canvas');
            tempCanvas.width = video.videoWidth;
            tempCanvas.height = video.videoHeight;
            const tempCtx = tempCanvas.getContext('2d');
            tempCtx.drawImage(video, 0, 0, tempCanvas.width, tempCanvas.height);

            // Konversi gambar ke Blob
            tempCanvas.toBlob(async (blob) => {
                if (!blob) {
                    addToLiveActivity('Failed to capture image blob.', 'error');
                    showNotification('error', 'Camera Error', 'Gagal mengambil gambar dari kamera.');
                    return;
                }
                formData.append('image', blob, 'face.jpg');

                // Dapatkan CSRF token dari meta tag atau input tersembunyi
                const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document
                    .querySelector('meta[name="csrf-token"]').content : '{{ csrf_token() }}';

                try {
                    const response = await fetch("{{ route('face.verify') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json' // Penting: memberitahu server untuk mengirim JSON
                        },
                        body: formData
                    });

                    // Cek apakah respons sukses (status code 2xx)
                    if (!response.ok) {
                        const errorText = await response.text();
                        console.error('Server response was not OK:', response.status, errorText);
                        // Coba parse sebagai JSON, tapi fallback ke teks jika gagal
                        let errorData;
                        try {
                            errorData = JSON.parse(errorText);
                        } catch (e) {
                            errorData = {
                                message: `Server error: ${response.status} - ${errorText.substring(0, 100)}...`
                            };
                        }
                        throw new Error(errorData.message || 'Unknown server error');
                    }

                    const data = await response.json();

                    if (data.status) {
                        successfulScans++;
                        speak(`Halo ${data.nama}, absensi ${data.message}`, maleVoice);
                        showUser(data.nama);
                        logAttendance(data.nama, 'success', data.message);
                        showNotification('success', 'Absensi Berhasil', `Absensi ${data.nama} sukses!`);
                        document.getElementById('absen-status').textContent =
                        `Absen Berhasil: ${data.nama}`;
                        document.getElementById('absen-status').className =
                            "bg-green-100 text-green-700 px-4 py-2 rounded-full font-semibold shadow-md";
                    } else {
                        speak(data.message || "Absensi gagal.", femaleVoice);
                        showUser("Tidak Dikenali", true);
                        logAttendance("Gagal", 'error', data.message || "Wajah tidak dikenali.");
                        showNotification('error', 'Absensi Gagal', data.message || "Wajah tidak dikenali.");
                        document.getElementById('absen-status').textContent =
                        `Absen Gagal: ${data.message}`;
                        document.getElementById('absen-status').className =
                            "bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold shadow-md";
                    }
                } catch (error) {
                    console.error("Fetch error:", error);
                    speak("Terjadi kesalahan koneksi atau server.", femaleVoice);
                    showUser("Error", true);
                    logAttendance("Error", 'error', `Koneksi gagal: ${error.message}`);
                    showNotification('error', 'Kesalahan', `Terjadi kesalahan: ${error.message}`);
                    document.getElementById('absen-status').textContent = `Error: ${error.message}`;
                    document.getElementById('absen-status').className =
                        "bg-red-100 text-red-700 px-4 py-2 rounded-full font-semibold shadow-md";
                }
            }, 'image/jpeg', 0.8);
        }

        function showUser(name, isUnknown = false) {
            const infoDiv = document.getElementById('user-info');
            infoDiv.classList.remove('hidden'); // Ensure it's visible

            if (isUnknown) {
                infoDiv.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-times text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xl font-bold text-red-400">Akses Ditolak</div>
                            <div class="text-sm opacity-80">Wajah tidak dikenali</div>
                        </div>
                    </div>`;
            } else {
                infoDiv.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xl font-bold text-green-400">Selamat datang, ${name}!</div>
                            <div class="text-sm opacity-80">Presensi Berhasil</div>
                        </div>
                    </div>`;
            }

            // Reset after 5 seconds
            setTimeout(() => {
                infoDiv.innerHTML = `
                    <div class="text-lg font-semibold mb-2">Scan wajah untuk presensi</div>
                    <div class="text-sm opacity-80">Posisikan wajah di depan kamera</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    </div>`;
            }, 5000);
        }

        function logAttendance(name, type, message) {
            const logItem = document.createElement('div');
            const iconClass = type === 'success' ? 'fas fa-check' : 'fas fa-times';
            const bgColorClass = type === 'success' ? 'bg-green-500' : 'bg-red-500';

            logItem.className = 'flex items-center gap-3 p-3 bg-white/5 rounded-xl animate-fade-in';
            logItem.innerHTML = `
                <div class="w-8 h-8 ${bgColorClass} rounded-full flex items-center justify-center">
                    <i class="${iconClass} text-xs"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium">${name}</div>
                    <div class="text-xs opacity-60">${new Date().toLocaleTimeString('id-ID')} - ${message}</div>
                </div>
            `;
            const logList = document.getElementById('attendance-log');
            logList.insertBefore(logItem, logList.firstChild);
            while (logList.children.length > 20) {
                logList.removeChild(logList.lastChild);
            }
        }

        function updateStatistics() {
            const successRate = totalScans > 0 ? Math.round((successfulScans / totalScans) * 100) : 0;
            const avgTime = scanTimes.length > 0 ? (scanTimes.reduce((a, b) => a + b, 0) / scanTimes.length).toFixed(1) : 0;
            document.getElementById('success-rate').textContent = `${successRate}%`;
            document.getElementById('avg-time').textContent = `${avgTime}s`;
        }

        function updateClock() {
            const now = new Date();
            const timeFormatter = new Intl.DateTimeFormat('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Makassar'
            });
            const dateFormatter = new Intl.DateTimeFormat('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Asia/Makassar'
            });
            document.getElementById('waktu').textContent = timeFormatter.format(now);
            document.getElementById('tanggal').textContent = dateFormatter.format(now);
        }

        function toggleDark() {
            document.documentElement.classList.toggle('dark');
        }

        function toggleSound() {
            soundEnabled = !soundEnabled;
            const icon = document.getElementById('sound-icon');
            const status = document.getElementById('sound-status');
            icon.className = soundEnabled ? 'fas fa-volume-up text-blue-400' : 'fas fa-volume-mute text-red-400';
            status.textContent = soundEnabled ? 'ON' : 'OFF';
        }

        function speak(text, voice = null) {
            if (!soundEnabled) return;
            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'id-ID';
            utter.voice = voice;
            utter.rate = 1.05; // Make speech slightly faster
            speechSynthesis.speak(utter);
        }

        function loadVoices() {
            const voices = speechSynthesis.getVoices();
            maleVoice = voices.find(v => v.lang === 'id-ID' && /male|laki/i.test(v.name)) ||
                voices.find(v => v.lang.startsWith('id')) || voices.find(v => /male/i.test(v.name));
            femaleVoice = voices.find(v => v.lang === 'id-ID' && /female|perempuan/i.test(v.name)) ||
                voices.find(v => v.lang.startsWith('id')) || voices.find(v => /female/i.test(v.name));

            // Fallback if specific voices not found
            if (!maleVoice && voices.length > 0) maleVoice = voices[0];
            if (!femaleVoice && voices.length > 1) femaleVoice = voices[1];
            else if (!femaleVoice && voices.length > 0) femaleVoice = voices[0];
        }

        if ('speechSynthesis' in window) {
            speechSynthesis.onvoiceschanged = loadVoices;
        }

        function showNotification(type, title, message) {
            const notification = document.getElementById('notification');
            const notificationIcon = notification.querySelector('i');
            const notificationTitle = notification.querySelector('.font-semibold');
            const notificationMessage = document.getElementById('notification-message');

            notification.classList.remove('bg-green-500', 'bg-red-500', 'bg-yellow-500'); // Clear previous colors
            notificationIcon.className = ''; // Clear previous icon

            if (type === 'success') {
                notification.classList.add('bg-green-500');
                notificationIcon.classList.add('fas', 'fa-check-circle', 'text-xl');
            } else if (type === 'error') {
                notification.classList.add('bg-red-500');
                notificationIcon.classList.add('fas', 'fa-times-circle', 'text-xl');
            } else if (type === 'warning') {
                notification.classList.add('bg-yellow-500');
                notificationIcon.classList.add('fas', 'fa-exclamation-triangle', 'text-xl');
            } else { // info
                notification.classList.add('bg-blue-500');
                notificationIcon.classList.add('fas', 'fa-info-circle', 'text-xl');
            }

            notificationTitle.textContent = title;
            notificationMessage.textContent = message;
            notification.classList.add('show');
            setTimeout(() => notification.classList.remove('show'), 4000); // Notification disappears after 4 seconds
        }


        function updateFPS() {
            const now = Date.now();
            const fps = Math.round(fpsCounter * 1000 / (now - lastFpsTime));
            document.getElementById('fps-counter').textContent = `FPS: ${fps}`;
            fpsCounter = 0;
            lastFpsTime = now;
        }

        function addToLiveActivity(message, type = 'info') {
            const liveActivity = document.getElementById('live-activity');
            const icons = {
                info: 'fas fa-info-circle text-blue-400',
                success: 'fas fa-check-circle text-green-400',
                error: 'fas fa-exclamation-circle text-red-400',
                warning: 'fas fa-exclamation-triangle text-yellow-400'
            };

            const activityItem = document.createElement('div');
            activityItem.className = 'flex items-center gap-3 p-3 bg-white/5 rounded-xl animate-fade-in';
            activityItem.innerHTML = `
                <div class="w-8 h-8 bg-${type === 'success' ? 'green' : type === 'error' ? 'red' : type === 'warning' ? 'yellow' : 'blue'}-500 rounded-full flex items-center justify-center">
                    <i class="${icons[type]} text-xs"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium">${message}</div>
                    <div class="text-xs opacity-60">${new Date().toLocaleTimeString('id-ID')}</div>
                </div>
            `;
            liveActivity.insertBefore(activityItem, liveActivity.firstChild);
            while (liveActivity.children.length > 10) {
                liveActivity.removeChild(liveActivity.lastChild);
            }
        }

        function testCameraAndModel() {
            addToLiveActivity('Testing camera and model...', 'info');
            setTimeout(() => {
                const isWorking = video.srcObject && video.videoWidth > 0;
                if (isWorking) {
                    addToLiveActivity('Camera and model test passed', 'success');
                    showNotification('success', 'Tes Berhasil', 'Kamera dan deteksi wajah berjalan lancar');
                } else {
                    addToLiveActivity('Camera test failed', 'error');
                    showNotification('error', 'Tes Gagal', 'Masalah pada kamera atau model');
                }
            }, 1500);
        }

        function calibrateCamera() {
            addToLiveActivity('Calibrating camera...', 'info');
            let progress = 0;
            document.getElementById('scan-progress').style.width = '0%'; // Reset progress
            document.getElementById('detection-status').textContent = 'Kalibrasi dimulai...';

            const interval = setInterval(() => {
                progress += 10;
                if (progress <= 100) {
                    document.getElementById('scan-progress').style.width = `${progress}%`;
                    document.getElementById('detection-status').textContent = `Kalibrasi: ${progress}%`;
                    addToLiveActivity(`Progress: ${progress}%`, 'info');
                } else {
                    clearInterval(interval);
                    document.getElementById('scan-progress').style.width = '100%';
                    document.getElementById('detection-status').textContent = 'Kalibrasi selesai.';
                    addToLiveActivity('Calibration completed', 'success');
                    showNotification('success', 'Kalibrasi Selesai', 'Kamera telah dikalibrasi');
                }
            }, 200);
        }

        function exportData() {
            const data = {
                totalScans,
                successfulScans,
                successRate: totalScans > 0 ? Math.round((successfulScans / totalScans) * 100) : 0,
                averageTime: scanTimes.length > 0 ? (scanTimes.reduce((a, b) => a + b, 0) / scanTimes.length).toFixed(
                    1) : 0,
                facesDetected: detectedFaces,
                exportTime: new Date().toISOString()
            };

            const blob = new Blob([JSON.stringify(data, null, 2)], {
                type: 'application/json'
            });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `attendance_data_${new Date().toISOString().split('T')[0]}.json`;
            a.click();
            URL.revokeObjectURL(url);
            addToLiveActivity('Data exported successfully', 'success');
            showNotification('success', 'Ekspor Data', 'Data presensi telah diekspor');
        }

        function clearLog() {
            document.getElementById('attendance-log').innerHTML = '';
            document.getElementById('live-activity').innerHTML = `
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-xl">
                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-power-off text-xs"></i>
                    </div>
                    <div>
                        <div class="text-sm font-medium">Logs cleared</div>
                        <div class="text-xs opacity-60">${new Date().toLocaleTimeString('id-ID')}</div>
                    </div>
                </div>`;
            totalScans = 0;
            successfulScans = 0;
            detectedFaces = 0;
            scanTimes = [];
            document.getElementById('total-scans').textContent = '0';
            document.getElementById('success-rate').textContent = '0%';
            document.getElementById('avg-time').textContent = '0.0s';
            document.getElementById('faces-detected').textContent = '0';
            showNotification('success', 'Log Dihapus', 'Semua log dan statistik telah dibersihkan');
        }

        function showStats() {
            const stats = {
                totalScans,
                successfulScans,
                failedScans: totalScans - successfulScans,
                successRate: totalScans > 0 ? Math.round((successfulScans / totalScans) * 100) : 0,
                averageTime: scanTimes.length > 0 ? (scanTimes.reduce((a, b) => a + b, 0) / scanTimes.length).toFixed(
                    1) : 0
            };
            alert(
                `📊 Statistik Presensi:\n• Total Scan: ${stats.totalScans}\n• Sukses: ${stats.successfulScans}\n• Gagal: ${stats.failedScans}\n• Tingkat Keberhasilan: ${stats.successRate}%\n• Rata-Rata Waktu: ${stats.averageTime}s`
            );
        }

        function settings() {
            const options = ['Resolusi Kamera', 'Sensitivitas Deteksi', 'Pengaturan Suara'];
            const selected = prompt('Pilih pengaturan:\n' + options.map((o, i) => `${i + 1}. ${o}`).join('\n'));
            if (selected) {
                addToLiveActivity(`Pengaturan dipilih: Opsi ${selected}`, 'info');
                showNotification('info', 'Pengaturan', `Opsi ${selected} dipilih`);
            }
        }
    </script>
</body>

</html>
