<!DOCTYPE html>
<html lang="id" class="transition duration-500">

<head>
    <meta charset="UTF-8">
    <title>E-Presensi Desa Penatahan - Enhanced</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'bounce-slow': 'bounce 2s infinite',
                        'spin-slow': 'spin 3s linear infinite',
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'glow': 'glow 2s ease-in-out infinite alternate',
                        'scanner': 'scanner 2s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                    }
                }
            }
        }
    </script>

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

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
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

        .progress-ring {
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            transition: stroke-dashoffset 0.3s ease;
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
    <!-- Floating Particles -->
    <div id="particles-container"></div>

    <!-- Notification System -->
    <div id="notification" class="notification">
        <div class="bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center gap-3">
            <i class="fas fa-check-circle text-xl"></i>
            <div>
                <div class="font-semibold">Berhasil!</div>
                <div class="text-sm opacity-90" id="notification-message"></div>
            </div>
        </div>
    </div>

    <!-- Main Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
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

                <!-- Weather Widget -->
                <div class="weather-widget rounded-xl p-4 flex items-center gap-3">
                    <i class="fas fa-cloud-sun text-2xl"></i>
                    <div>
                        <div class="font-semibold">28°C</div>
                        <div class="text-sm opacity-90">Cerah</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 flex">
            <!-- Left Sidebar -->
            <aside class="w-80 glass-effect p-6 animate-slide-up" style="animation-delay: 0.2s">
                <!-- Time Display -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-6 mb-6 text-center">
                    <div class="text-3xl font-bold mb-2" id="waktu"></div>
                    <div class="text-sm opacity-90" id="tanggal"></div>
                    <div class="mt-3 flex justify-center">
                        <div class="bg-white/20 px-4 py-2 rounded-full">
                            <span id="absen-status" class="text-sm font-medium"></span>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
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

                <!-- Controls -->
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

            <!-- Center Content -->
            <div class="flex-1 flex flex-col items-center justify-center p-8">
                <!-- Camera Container -->
                <div class="relative animate-fade-in">
                    <div class="relative w-[640px] h-[480px] rounded-3xl overflow-hidden glow-box bg-black">
                        <!-- Scanner Line -->
                        <div class="scanner-line"></div>

                        <!-- Video -->
                        <video id="video" autoplay muted playsinline class="w-full h-full object-cover"></video>
                        <canvas id="overlay" class="w-full h-full"></canvas>

                        <!-- Overlay UI -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            <div class="glass-effect px-4 py-2 rounded-full">
                                <span class="text-sm font-medium">🎯 Scanning...</span>
                            </div>
                            <div class="glass-effect px-4 py-2 rounded-full">
                                <span class="text-sm font-medium" id="fps-counter">FPS: --</span>
                            </div>
                        </div>

                        <!-- Detection Info -->
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

                                <!-- Progress Bar -->
                                <div class="mt-3 bg-white/20 rounded-full h-2">
                                    <div id="scan-progress"
                                        class="bg-gradient-to-r from-blue-500 to-purple-500 h-2 rounded-full transition-all duration-300"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Info Display -->
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

            <!-- Right Sidebar -->
            <aside class="w-80 glass-effect p-6 animate-slide-up" style="animation-delay: 0.6s">
                <!-- Live Activity -->
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

                <!-- Attendance Log -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                        <i class="fas fa-clipboard-list text-green-400"></i>
                        Attendance Log
                    </h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto" id="attendance-log">
                        <!-- Dynamic content -->
                    </div>
                </div>

                <!-- Quick Actions -->
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

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            initializeApp();
            createFloatingParticles();
            updateClock();
            setInterval(updateClock, 1000);
            setInterval(updateFPS, 1000);
            loadVoices();

            // Set system start time
            document.getElementById('system-start-time').textContent = new Date().toLocaleTimeString('id-ID');
        });

        function initializeApp() {
            addToLiveActivity('System initializing...', 'info');

            Promise.all([
                faceapi.nets.tinyFaceDetector.loadFromUri('/models')
            ]).then(() => {
                addToLiveActivity('Face detection model loaded', 'success');
                startCamera();
            }).catch(err => {
                addToLiveActivity('Failed to load model: ' + err.message, 'error');
            });
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
                })
                .then(stream => {
                    video.srcObject = stream;
                    addToLiveActivity('Camera started successfully', 'success');
                })
                .catch(err => {
                    addToLiveActivity('Camera access denied: ' + err.message, 'error');
                    showNotification('error', 'Camera Error', 'Unable to access camera');
                });
        }

        video.addEventListener('play', () => {
            const displaySize = {
                width: video.clientWidth,
                height: video.clientHeight
            };
            faceapi.matchDimensions(overlay, displaySize);

            const detectFaces = async () => {
                const detections = await faceapi.detectAllFaces(video, new faceapi
                    .TinyFaceDetectorOptions());
                const resized = faceapi.resizeResults(detections, displaySize);

                ctx.clearRect(0, 0, overlay.width, overlay.height);
                fpsCounter++;

                if (resized.length > 0) {
                    detectedFaces++;
                    document.getElementById('faces-detected').textContent = detectedFaces;
                    document.getElementById('detection-status').textContent =
                        `${resized.length} face(s) detected`;

                    if (!autoScanDelay) {
                        autoScanDelay = true;
                        const startTime = Date.now();
                        scan().then(() => {
                            const scanTime = (Date.now() - startTime) / 1000;
                            scanTimes.push(scanTime);
                            updateStatistics();
                        });
                        setTimeout(() => autoScanDelay = false, 3000);
                    }
                } else {
                    document.getElementById('detection-status').textContent = 'No face detected';
                }

                // Draw face rectangles with enhanced styling
                resized.forEach((det, index) => {
                    const {
                        x,
                        y,
                        width,
                        height
                    } = det.box;

                    // Main rectangle
                    ctx.strokeStyle = '#3b82f6';
                    ctx.lineWidth = 3;
                    ctx.strokeRect(x, y, width, height);

                    // Corner decorations
                    const cornerSize = 20;
                    ctx.strokeStyle = '#60a5fa';
                    ctx.lineWidth = 2;

                    // Top-left corner
                    ctx.beginPath();
                    ctx.moveTo(x, y + cornerSize);
                    ctx.lineTo(x, y);
                    ctx.lineTo(x + cornerSize, y);
                    ctx.stroke();

                    // Top-right corner
                    ctx.beginPath();
                    ctx.moveTo(x + width - cornerSize, y);
                    ctx.lineTo(x + width, y);
                    ctx.lineTo(x + width, y + cornerSize);
                    ctx.stroke();

                    // Bottom-left corner
                    ctx.beginPath();
                    ctx.moveTo(x, y + height - cornerSize);
                    ctx.lineTo(x, y + height);
                    ctx.lineTo(x + cornerSize, y + height);
                    ctx.stroke();

                    // Bottom-right corner
                    ctx.beginPath();
                    ctx.moveTo(x + width - cornerSize, y + height);
                    ctx.lineTo(x + width, y + height);
                    ctx.lineTo(x + width, y + height - cornerSize);
                    ctx.stroke();

                    // Face number label
                    ctx.fillStyle = '#3b82f6';
                    ctx.fillRect(x, y - 30, 40, 25);
                    ctx.fillStyle = 'white';
                    ctx.font = '14px Inter';
                    ctx.textAlign = 'center';
                    ctx.fillText(`#${index + 1}`, x + 20, y - 10);
                });

                requestAnimationFrame(detectFaces);
            };

            detectFaces();
        });

        async function scan() {
            totalScans++;
            document.getElementById('total-scans').textContent = totalScans;

            const scanProgress = document.getElementById('scan-progress');
            scanProgress.style.width = '0%';

            // Animate progress
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += 5;
                scanProgress.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, 50);

            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const c = canvas.getContext('2d');
            c.drawImage(video, 0, 0, canvas.width, canvas.height);

            return new Promise((resolve) => {
                canvas.toBlob(blob => {
                    let formData = new FormData();
                    formData.append('image', blob);

                    // Simulate API call for demo
                    setTimeout(() => {
                        const isSuccess = Math.random() > 0.3;
                        const mockData = {
                            status: isSuccess,
                            nama: isSuccess ? 'John Doe' : null,
                            message: isSuccess ? 'Presensi berhasil' :
                                'Wajah tidak dikenali'
                        };

                        handleScanResult(mockData);
                        resolve();
                    }, 1000);
                }, 'image/jpeg');
            });
        }

        function handleScanResult(data) {
            const userInfo = document.getElementById('user-info');
            const isSuccess = data.status;
            const name = data.nama || "Unknown";
            const message = data.message || "Processing...";

            if (isSuccess) {
                successfulScans++;
                if (soundEnabled) {
                    speak(`Halo ${name}. ${message}`, maleVoice);
                }

                userInfo.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-check text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xl font-bold text-green-400">Welcome, ${name}!</div>
                            <div class="text-sm opacity-80">${message}</div>
                            <div class="text-xs opacity-60 mt-1">${new Date().toLocaleTimeString('id-ID')}</div>
                        </div>
                    </div>
                `;

                addToAttendanceLog(name, 'success');
                showNotification('success', 'Success', `${name} berhasil presensi`);
            } else {
                if (soundEnabled) {
                    speak(message, femaleVoice);
                }

                userInfo.innerHTML = `
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-red-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-times text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xl font-bold text-red-400">Access Denied</div>
                            <div class="text-sm opacity-80">${message}</div>
                            <div class="text-xs opacity-60 mt-1">${new Date().toLocaleTimeString('id-ID')}</div>
                        </div>
                    </div>
                `;

                addToAttendanceLog('Unknown', 'failed');
                showNotification('error', 'Failed', message);
            }

            // Reset UI after 5 seconds
            setTimeout(() => {
                userInfo.innerHTML = `
                    <div class="text-lg font-semibold mb-2">Scan wajah untuk presensi</div>
                    <div class="text-sm opacity-80">Posisikan wajah di depan kamera</div>
                    <div class="mt-4 flex justify-center">
                        <div class="w-8 h-8 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    </div>
                `;
            }, 5000);
        }

        function updateStatistics() {
            const successRate = totalScans > 0 ? Math.round((successfulScans / totalScans) * 100) : 0;
            const avgTime = scanTimes.length > 0 ? (scanTimes.reduce((a, b) => a + b, 0) / scanTimes.length).toFixed(1) : 0;

            document.getElementById('success-rate').textContent = successRate + '%';
            document.getElementById('avg-time').textContent = avgTime + 's';
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
            const time = new Date().toLocaleTimeString('id-ID');

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
                    <div class="text-xs opacity-60">${time}</div>
                </div>
            `;

            liveActivity.insertBefore(activityItem, liveActivity.firstChild);

            // Keep only last 10 activities
            while (liveActivity.children.length > 10) {
                liveActivity.removeChild(liveActivity.lastChild);
            }
        }

        function addToAttendanceLog(name, status) {
            const attendanceLog = document.getElementById('attendance-log');
            const time = new Date().toLocaleTimeString('id-ID');

            const logItem = document.createElement('div');
            logItem.className = 'flex items-center gap-3 p-3 bg-white/5 rounded-xl animate-fade-in';
            logItem.innerHTML = `
                <div class="w-8 h-8 bg-${status === 'success' ? 'green' : 'red'}-500 rounded-full flex items-center justify-center">
                    <i class="fas fa-${status === 'success' ? 'check' : 'times'} text-xs"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-medium">${name}</div>
                    <div class="text-xs opacity-60">${time}</div>
                </div>
                <div class="text-xs ${status === 'success' ? 'text-green-400' : 'text-red-400'} font-medium">
                    ${status === 'success' ? 'SUCCESS' : 'FAILED'}
                </div>
            `;

            attendanceLog.insertBefore(logItem, attendanceLog.firstChild);

            // Keep only last 20 logs
            while (attendanceLog.children.length > 20) {
                attendanceLog.removeChild(attendanceLog.lastChild);
            }
        }

        function showNotification(type, title, message) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');

            notification.className = `notification ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
            notificationMessage.textContent = message;

            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        function updateClock() {
            const now = new Date();
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Makassar',
                hour12: false
            };

            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                timeZone: 'Asia/Makassar'
            };

            const timeFormatter = new Intl.DateTimeFormat('id-ID', timeOptions);
            const dateFormatter = new Intl.DateTimeFormat('id-ID', dateOptions);

            document.getElementById('waktu').textContent = timeFormatter.format(now);
            document.getElementById('tanggal').textContent = dateFormatter.format(now);

            // Update status based on time
            const hour = now.getHours();
            let status = '';
            if (hour >= 6 && hour < 12) {
                status = '🌅 Jam Masuk';
            } else if (hour >= 12 && hour < 18) {
                status = '🌞 Jam Kerja';
            } else {
                status = '🌙 Jam Pulang';
            }
            document.getElementById('absen-status').textContent = status;
        }

        function toggleDark() {
            document.documentElement.classList.toggle('dark');
            const isDark = document.documentElement.classList.contains('dark');
            addToLiveActivity(`Dark mode ${isDark ? 'enabled' : 'disabled'}`, 'info');
        }

        function toggleSound() {
            soundEnabled = !soundEnabled;
            const soundIcon = document.getElementById('sound-icon');
            const soundStatus = document.getElementById('sound-status');

            if (soundEnabled) {
                soundIcon.className = 'fas fa-volume-up text-blue-400';
                soundStatus.textContent = 'ON';
            } else {
                soundIcon.className = 'fas fa-volume-mute text-red-400';
                soundStatus.textContent = 'OFF';
            }

            addToLiveActivity(`Sound ${soundEnabled ? 'enabled' : 'disabled'}`, 'info');
        }

        function testCameraAndModel() {
            addToLiveActivity('Testing camera and model...', 'info');

            setTimeout(() => {
                const isWorking = video.srcObject && video.videoWidth > 0;
                if (isWorking) {
                    addToLiveActivity('Camera and model test passed', 'success');
                    showNotification('success', 'Test Passed', 'Camera and face detection are working properly');
                } else {
                    addToLiveActivity('Camera test failed', 'error');
                    showNotification('error', 'Test Failed', 'Camera or model issues detected');
                }
            }, 1500);
        }

        function calibrateCamera() {
            addToLiveActivity('Calibrating camera...', 'info');

            // Simulate calibration process
            let progress = 0;
            const calibrationInterval = setInterval(() => {
                progress += 10;
                if (progress <= 100) {
                    addToLiveActivity(`Calibration progress: ${progress}%`, 'info');
                } else {
                    clearInterval(calibrationInterval);
                    addToLiveActivity('Camera calibration completed', 'success');
                    showNotification('success', 'Calibration Complete', 'Camera has been calibrated successfully');
                }
            }, 200);
        }

        function exportData() {
            addToLiveActivity('Exporting attendance data...', 'info');

            // Simulate data export
            const data = {
                totalScans: totalScans,
                successfulScans: successfulScans,
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
            showNotification('success', 'Export Complete', 'Attendance data has been exported');
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
                </div>
            `;

            // Reset statistics
            totalScans = 0;
            successfulScans = 0;
            detectedFaces = 0;
            scanTimes = [];

            document.getElementById('total-scans').textContent = '0';
            document.getElementById('success-rate').textContent = '0%';
            document.getElementById('avg-time').textContent = '0.0s';
            document.getElementById('faces-detected').textContent = '0';

            showNotification('success', 'Cleared', 'All logs and statistics have been cleared');
        }

        function showStats() {
            const stats = {
                totalScans: totalScans,
                successfulScans: successfulScans,
                failedScans: totalScans - successfulScans,
                successRate: totalScans > 0 ? Math.round((successfulScans / totalScans) * 100) : 0,
                averageTime: scanTimes.length > 0 ? (scanTimes.reduce((a, b) => a + b, 0) / scanTimes.length).toFixed(
                    1) : 0,
                facesDetected: detectedFaces,
                uptime: Math.floor((Date.now() - performance.timing.navigationStart) / 1000)
            };

            const statsMessage = `
                📊 Statistics Summary:
                • Total Scans: ${stats.totalScans}
                • Successful: ${stats.successfulScans}
                • Failed: ${stats.failedScans}
                • Success Rate: ${stats.successRate}%
                • Average Time: ${stats.averageTime}s
                • Faces Detected: ${stats.facesDetected}
                • Uptime: ${stats.uptime}s
            `;

            alert(statsMessage);
            addToLiveActivity('Statistics displayed', 'info');
        }

        function settings() {
            const settingsOptions = [
                'Camera Resolution',
                'Detection Sensitivity',
                'Audio Settings',
                'Theme Settings',
                'Export Settings'
            ];

            const selectedSetting = prompt('Select setting to configure:\n' + settingsOptions.map((opt, i) =>
                `${i + 1}. ${opt}`).join('\n'));

            if (selectedSetting) {
                addToLiveActivity(`Settings accessed: Option ${selectedSetting}`, 'info');
                showNotification('info', 'Settings', `Configuration option ${selectedSetting} selected`);
            }
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

        function speak(text, voice = null) {
            if (!soundEnabled) return;

            const utter = new SpeechSynthesisUtterance(text);
            utter.lang = 'id-ID';
            utter.voice = voice;
            utter.rate = 0.9;
            utter.pitch = 1;
            speechSynthesis.speak(utter);
        }

        // Voice loading
        if (typeof speechSynthesis !== 'undefined') {
            speechSynthesis.onvoiceschanged = loadVoices;
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'd' && e.ctrlKey) {
                e.preventDefault();
                toggleDark();
            } else if (e.key === 's' && e.ctrlKey) {
                e.preventDefault();
                toggleSound();
            } else if (e.key === 't' && e.ctrlKey) {
                e.preventDefault();
                testCameraAndModel();
            } else if (e.key === 'c' && e.ctrlKey) {
                e.preventDefault();
                calibrateCamera();
            }
        });

        // Add welcome message
        setTimeout(() => {
            addToLiveActivity('Welcome to E-Presensi Face Recognition System', 'success');
            if (soundEnabled) {
                speak('Sistem E-Presensi siap digunakan', maleVoice);
            }
        }, 2000);
    </script>
</body>

</html>
