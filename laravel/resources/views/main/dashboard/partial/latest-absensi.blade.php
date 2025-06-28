<ul class="list-group">
    @foreach ($absensi as $item)
        {{-- Data histori realtime akan tampil di sini --}}
        <li class="list-group-item">
            <strong>{{ $item->pegawai->nama }}</strong> - Absen <span
                class="badge {{ $item->tipe == 'masuk' ? 'bg-success' : 'bg-danger' }}">{{ ucfirst($item->tipe) }}</span>
            pada
            {{ \Carbon\Carbon::parse($item->checked_in_at)->format('H:i') }}
        </li>
        {{-- Tambahkan data dinamis di sini --}}
    @endforeach
</ul>
