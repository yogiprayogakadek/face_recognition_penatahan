@extends('template.master')

@section('page-title', 'Face Encoding')

@push('css')
    <link rel="stylesheet"
        href="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <!-- Add GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <style>
        .face-images-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .face-image-thumbnail {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s;
        }

        .face-image-thumbnail:hover {
            transform: scale(1.05);
        }

        .json-data {
            max-height: 300px;
            overflow-y: auto;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
        }
    </style>
@endpush

@section('content')
    {{-- Success Alert --}}
    @if (session('success'))
        <div class="alert customize-alert alert-dismissible text-success alert-light-success bg-success-subtle fade show remove-close-icon"
            role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div class="d-flex align-items-center  me-3 me-md-0">
                <i class="ti ti-info-circle fs-5 me-2 text-success"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="modalDetail" tabindex="-1" data-bs-backdrop="static" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h4 class="modal-title">Detail Data Face Encoding - <span id="staffName"></span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless" id="tableFaceEncoding">
                        <thead>
                            <tr>
                                <th width="30%">Data Encoding</th>
                                <th>Face Images</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="json-data" id="jsonData"></div>
                                </td>
                                <td>
                                    <div class="face-images-container" id="faceImagesContainer"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Daftar Face Encoding</h5>

            <div class="table-responsive">
                <table id="table" class="table table-striped table-bordered text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Data Face Encoding</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            @php
                                $foto = $data->foto_profil;
                                $profilePhoto = $foto
                                    ? asset('storage/' . $foto)
                                    : 'https://bootstrapdemos.adminmart.com/matdash/dist/assets/images/profile/user-' .
                                        mt_rand(1, 15) .
                                        '.jpg';
                            @endphp
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-6">
                                        <img src="{{ $profilePhoto }}" width="45" class="rounded-circle" />
                                        <h6 class="mb-0"> {{ $data->nama }} </h6>
                                    </div>
                                </td>
                                <td>{{ $data->user->email }}</td>
                                <td class="text-center">
                                    @if ($data->faceEncoding)
                                        <button type="button" class="btn bg-info-subtle text-info btn-detail"
                                            data-id="{{ $data->id }}"
                                            data-face="{{ json_encode($data->faceEncoding->encodings) }}"
                                            data-images="{{ json_encode($data->faceEncoding->face_images) }}"
                                            data-nama="{{ $data->nama }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Lihat Face Encoding">
                                            <iconify-icon icon="solar:eye-bold" width="1em"
                                                height="1em"></iconify-icon>
                                        </button>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if (!$data->faceEncoding)
                                        <a href="{{ route('face.create', $data->id) }}">
                                            <button class="btn btn-outline-info" data-bs-toggle="tooltip"
                                                data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                                data-bs-title="Create Face Encoding">
                                                <iconify-icon icon="solar:face-scan-square-broken" width="1em"
                                                    height="1em"></iconify-icon>
                                            </button>
                                        </a>
                                    @else
                                        <a href="{{ route('face.create', $data->id) }}">
                                            <button class="btn btn-outline-success" data-bs-toggle="tooltip"
                                                data-bs-custom-class="custom-tooltip" data-bs-placement="top"
                                                data-bs-title="Edit">
                                                <iconify-icon icon="solar:clapperboard-edit-linear" width="1em"
                                                    height="1em"></iconify-icon>
                                            </button>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://bootstrapdemos.adminmart.com/matdash/dist/assets/libs/datatables.net/js/jquery.dataTables.min.js">
    </script>
    <!-- Add GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        $("#table").DataTable();

        // Initialize GLightbox
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: false,
            moreText: 'Lihat lebih banyak',
            zoomable: true
        });

        $('body').on('click', '.btn-detail', function() {
            let face = $(this).data('face');
            let images = $(this).data('images');
            let nama = $(this).data('nama');

            $('#modalDetail').modal('show');
            $('#staffName').text(nama);

            // Format and display JSON data
            $('#jsonData').text(JSON.stringify(face, null, 2));

            // Clear previous images
            $('#faceImagesContainer').empty();

            // Check if images exist and is not null
            if (images) {
                try {
                    // Handle double-encoded JSON
                    let parsedImages = images;

                    // Keep parsing until we get an array
                    while (typeof parsedImages === 'string') {
                        parsedImages = JSON.parse(parsedImages);
                    }

                    console.log('Final parsed images:', parsedImages);
                    console.log('Is array?', Array.isArray(parsedImages));
                    console.table(parsedImages);

                    // Check if parsed result is an array and has items
                    if (Array.isArray(parsedImages) && parsedImages.length > 0) {
                        parsedImages.forEach((image, index) => {
                            if (image.image_path) {
                                const fullImagePath = "{{ asset('storage') }}/" + image.image_path;
                                $('#faceImagesContainer').append(`
                            <a href="${fullImagePath}" class="glightbox" data-gallery="gallery-${nama}">
                                <img src="${fullImagePath}" class="face-image-thumbnail" alt="Face Image ${index + 1}">
                            </a>
                        `);
                            }
                        });
                    } else {
                        $('#faceImagesContainer').html(
                            '<p class="text-muted">Tidak ada gambar wajah tersimpan</p>');
                    }
                } catch (error) {
                    console.error('Error parsing images JSON:', error);
                    $('#faceImagesContainer').html('<p class="text-muted">Error memproses data gambar</p>');
                }
            } else {
                $('#faceImagesContainer').html('<p class="text-muted">Tidak ada gambar wajah tersimpan</p>');
            }

            // Refresh GLightbox to include new images
            lightbox.reload();
        });
    </script>
@endpush
