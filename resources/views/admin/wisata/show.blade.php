   <!-- Modal Detail -->
   <div class="modal fade" id="showModal{{ $wisata->id }}" tabindex="-1" aria-labelledby="showModalLabel{{ $wisata->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel{{ $wisata->id }}">{{ $wisata->nama }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Kategori:</strong> <span class="badge text-white"
                    style="background-color: {{ $wisata->kategori->warna }}">{{ $wisata->kategori->nama }}</span></p>
                <p><strong>Deskripsi:</strong> {{ $wisata->deskripsi }}</p>
                <p><strong>Harga Tiket Masuk:</strong> {{ $wisata->formatted_harga_tiket_masuk }}</p>
                <p><strong>Jam Buka:</strong> {{ \Carbon\Carbon::parse($wisata->jam_buka)->format('H:i') }}</p>
                <p><strong>Jam Tutup:</strong> {{ \Carbon\Carbon::parse($wisata->jam_tutup)->format('H:i') }}</p>
                <p><strong>Lokasi:</strong> {{ $wisata->longitude }}, {{ $wisata->latitude }}</p>
                <p><a href="https://www.google.com/maps?q={{ $wisata->longitude }},{{ $wisata->latitude }}"
                    target="_blank" class="text-decoration-none text-primary">Lihat di Google Maps</a></p>
                <p><strong>Gambar:</strong></p>
                @if ($wisata->gambar)
                    @foreach (json_decode($wisata->gambar) as $gambar)
                        <img src="{{ $gambar }}" alt="Gambar" width="200" class="me-2">
                    @endforeach
                @else
                    <p>Tidak ada gambar.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>