@extends('template.master')

@push('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-datetimepicker/2.7.1/css/bootstrap-material-datetimepicker.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/sweetalert2/dist/sweetalert2.min.css">

    <!-- Face API -->
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <style>
        .video-card {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.75rem;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            border-radius: 0.75rem;
        }

        .video-wrapper video,
        .video-wrapper canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0.75rem;
        }

        .thumbnail-wrapper {
            position: relative;
            display: inline-block;
            margin: 10px;
        }

        .thumbnail-wrapper canvas {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            width: 240px;
        }

        .thumbnail-label {
            position: absolute;
            top: 6px;
            left: 6px;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            padding: 2px 8px;
            font-size: 14px;
            border-radius: 4px;
        }

        .delete-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(220, 53, 69, 0.85);
            color: white;
            border: none;
            border-radius: 50%;
            width: 26px;
            height: 26px;
            font-size: 16px;
            line-height: 0;
            text-align: center;
            cursor: pointer;
        }

        .delete-btn:hover {
            background: rgba(200, 30, 50, 1);
        }
    </style>
@endpush

@section('page-title', 'Face Encoding')

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center me-3 me-md-0">
                <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                {{ $pegawai->faceEncoding ? 'Update' : 'Pendaftaran' }} Data Wajah - {{ $pegawai->nama }}
            </h5>

            <div class="row">
                <div class="col-8 mx-auto">
                    <div class="video-card p-2 shadow-sm border rounded-3">
                        <div class="video-wrapper">
                            <video id="video" autoplay muted playsinline></video>
                            <canvas id="overlay"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body border-top text-center">
                <div class="btn-group" role="group">
                    <button type="button" class="btn bg-primary-subtle text-primary" onclick="capture()"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Ambil Foto">
                        <iconify-icon icon="solar:camera-add-bold" width="1.5em" height="1.5em"></iconify-icon>
                    </button>

                    <button type="button" class="btn bg-success-subtle text-success" onclick="submit()"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kirim ke Server">
                        <iconify-icon icon="solar:plain-2-bold-duotone" width="1.5em" height="1.5em"></iconify-icon>
                    </button>

                    <button type="button" class="btn bg-danger-subtle text-danger" onclick="resetPhotos()"
                        data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reset Semua Foto">
                        <iconify-icon icon="solar:trash-bin-2-bold" width="1.5em" height="1.5em"></iconify-icon>
                    </button>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-3 pb-4" id="preview"></div>
        </div>
    </div>

@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/sweetalert2/dist/sweetalert2.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('[id^="mini-"]').removeClass('selected');
            $('#mini-3').addClass('selected');
            $('#list-face').addClass('active');
            $('#menu-right-mini-3').addClass('sidebar-nav d-block simplebar-scrollable-y');
        });
    </script>

    <script>
        const video = document.getElementById("video");
        const canvasOverlay = document.getElementById("overlay");
        const previewContainer = document.getElementById("preview");

        let images = [];
        let anchorDescriptor = null;
        let pegawaiID = '{{ $pegawai->id }}';
        const maxImages = 5;

        // Load model FaceAPI
        Swal.fire({
            title: 'Memuat model...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => Swal.showLoading()
        });

        Promise.all([
            faceapi.nets.tinyFaceDetector.loadFromUri("/models"),
            faceapi.nets.faceRecognitionNet.loadFromUri("/models"),
            faceapi.nets.faceLandmark68Net.loadFromUri("/models")
        ]).then(() => {
            Swal.close();
            startVideo();
        });

        // Start Video
        function startVideo() {
            navigator.mediaDevices
                .getUserMedia({
                    video: true
                })
                .then((stream) => {
                    video.srcObject = stream;
                    video.onloadedmetadata = () => {
                        video.play();
                        startDetection();
                    };
                })
                .catch((err) => {
                    Swal.fire("Error", "Tidak dapat mengakses kamera: " + err, "error");
                });
        }

        // Detection Box
        function startDetection() {
            setInterval(async () => {
                if (video.videoWidth === 0 || video.videoHeight === 0) return;

                const displaySize = {
                    width: video.videoWidth,
                    height: video.videoHeight,
                };
                faceapi.matchDimensions(canvasOverlay, displaySize);

                const detections = await faceapi.detectAllFaces(video, new faceapi.TinyFaceDetectorOptions());
                const resized = faceapi.resizeResults(detections, displaySize);
                const ctx = canvasOverlay.getContext("2d");
                ctx.clearRect(0, 0, canvasOverlay.width, canvasOverlay.height);
                faceapi.draw.drawDetections(canvasOverlay, resized);
                video.currentDetections = detections;
            }, 300);
        }

        // Capture
        async function capture() {
            if (images.length >= maxImages) {
                Swal.fire("Batas Tercapai", `Maksimal ${maxImages} foto.`, "warning");
                return;
            }

            const detection = await faceapi.detectSingleFace(video, new faceapi.TinyFaceDetectorOptions())
                .withFaceLandmarks()
                .withFaceDescriptor();

            if (!detection) {
                Swal.fire("Tidak Valid", "Tidak ada wajah terdeteksi. Coba lagi.", "warning");
                return;
            }

            if (images.length === 0) {
                anchorDescriptor = detection.descriptor;
            } else {
                const distance = faceapi.euclideanDistance(anchorDescriptor, detection.descriptor);
                console.log("Distance: ", distance);

                if (distance > 0.5) {
                    Swal.fire("Wajah Berbeda",
                        "Foto ini tidak cocok dengan wajah sebelumnya. Harap gunakan wajah yang sama.", "error");
                    return;
                }
            }

            const faceCanvas = document.createElement("canvas");
            faceCanvas.width = video.videoWidth;
            faceCanvas.height = video.videoHeight;
            const ctx = faceCanvas.getContext("2d");
            ctx.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

            faceCanvas.toBlob((blob) => {
                images.push(blob);
                renderPreview();
                Swal.fire("Berhasil", `Foto ke-${images.length} berhasil disimpan.`, "success");
            }, "image/jpeg");
        }

        // Render Thumbnail Preview
        function renderPreview() {
            previewContainer.innerHTML = "";

            images.forEach((blob, index) => {
                const url = URL.createObjectURL(blob);
                const wrapper = document.createElement("div");
                wrapper.className = "thumbnail-wrapper";

                const label = document.createElement("div");
                label.className = "thumbnail-label";
                label.textContent = `#${index + 1}`;

                const delBtn = document.createElement("button");
                delBtn.className = "delete-btn";
                delBtn.innerHTML = "&times;";
                delBtn.onclick = () => confirmDelete(index);

                const imgCanvas = document.createElement("canvas");
                const img = new Image();
                img.onload = () => {
                    imgCanvas.width = img.width;
                    imgCanvas.height = img.height;
                    imgCanvas.getContext("2d").drawImage(img, 0, 0);
                };
                img.src = url;

                wrapper.appendChild(label);
                wrapper.appendChild(delBtn);
                wrapper.appendChild(imgCanvas);
                previewContainer.appendChild(wrapper);
            });
        }

        // Hapus Foto Per Index
        function confirmDelete(index) {
            Swal.fire({
                title: "Hapus Foto?",
                text: `Yakin ingin menghapus foto ke-${index + 1}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    images.splice(index, 1);
                    if (images.length === 0) {
                        anchorDescriptor = null;
                    }
                    renderPreview();
                    Swal.fire("Dihapus", "Foto telah dihapus.", "success");
                }
            });
        }

        // Reset Semua Foto
        function resetPhotos() {
            if (images.length === 0) return;
            Swal.fire({
                title: "Reset Semua Foto?",
                text: "Semua foto akan dihapus. Lanjutkan?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus semua",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    images = [];
                    anchorDescriptor = null;
                    renderPreview();
                    Swal.fire("Dihapus", "Semua foto telah dihapus.", "success");
                }
            });
        }

        // Submit ke Server
        function submit() {
            if (images.length === 0) {
                Swal.fire("Gagal", "Ambil setidaknya satu foto terlebih dahulu.", "error");
                return;
            }

            const formData = new FormData();
            formData.append("pegawai_id", pegawaiID);
            images.forEach((blob, i) => {
                formData.append("images[]", blob, `image${i}.jpg`);
            });

            Swal.fire({
                title: "Mengirim...",
                html: "Harap tunggu sambil mengunggah data.",
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading(),
            });

            fetch("{{ route('face.register') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    },
                    body: formData,
                })
                .then(async (res) => {
                    const data = await res.json();

                    if (!res.ok) {
                        if (res.status === 409) {
                            Swal.fire({
                                icon: "error",
                                title: "Wajah Sudah Terdaftar!",
                                html: `${data.message}<br>Nama Pegawai: <b>${data.matched_pegawai_nama}</b>`,
                                confirmButtonText: "Tutup"
                            });
                            return;
                        }

                        Swal.fire("Error", data.message ?? "Terjadi kesalahan.", "error");
                        return;
                    }

                    Swal.fire("Berhasil", data.message ?? "Data berhasil dikirim.", "success")
                        .then(() => {
                            window.location.href = "{{ route('face.index') }}";
                        });
                })
                .catch((err) => {
                    Swal.fire("Error", "Gagal mengirim gambar: " + err, "error");
                });
        }
    </script>
@endpush
