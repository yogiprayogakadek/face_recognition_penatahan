@extends('template.master')

@section('page-title', 'Dashboard')

@section('content')
    <div class="row">
        {{-- STATUS ABSENSI --}}
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="text-bg-primary p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-clipboard-check"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="fs-6">Status Absensi Hari Ini</h4>
                        <h5 class="fs-4 fw-medium text-primary mb-0">
                            Masuk: {{ $kehadiranMasuk?->created_at?->format('H:i') ?? '-' }} <br>
                            Pulang: {{ $kehadiranPulang?->created_at?->format('H:i') ?? '-' }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- ATURAN KEHADIRAN --}}
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="text-bg-info p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-settings"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h4 class="fs-6">Jam Masuk</h4>
                            <h5 class="fs-4 fw-medium text-info mb-0">
                                {{ $aturanMasuk->start_time }} - {{ $aturanMasuk->end_time }}
                            </h5>
                        </div>
                        <div class="text-center">
                            <h4 class="fs-6">Jam Pulang</h4>
                            <h5 class="fs-4 fw-medium text-info mb-0">
                                {{ $aturanPulang->start_time }} - {{ $aturanPulang->end_time }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- JAM SEKARANG --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="text-bg-success p-4 rounded-3 rounded-bottom-0">
                    <div class="text-center text-white display-6">
                        <i class="ti ti-clock"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mx-auto text-center">
                        <h4 class="fs-6">Jam Sekarang</h4>
                        <h5 class="fs-4 fw-medium text-success mb-0" id="current-time"></h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- HISTORI ABSENSI (Optional) --}}
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="ti ti-history me-2"></i>Histori Absensi
                </div>
                <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($histori as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_absensi)->format('d M Y') }}</td>
                                    <td>{{ $item->masuk?->created_at?->format('H:i') ?? '-' }}</td>
                                    <td>{{ $item->pulang?->created_at?->format('H:i') ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada histori</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
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

        setTimeout(() => {
            $('[id^="mini-"]').removeClass('selected');
            $('#dashboard').addClass('selected');
            $('body').attr('data-sidebartype', 'mini-sidebar');

            $('.container-fluid').css('max-width', '1500px');
        }, 1000);
    </script>
@endpush
