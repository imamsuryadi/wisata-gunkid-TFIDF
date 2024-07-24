@extends('layouts.homepage')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
           <div class="col-md-4">
           <div class="d-flex">
            <div class="">
                <label for="min-price" class="form-label">Harga Minimum</label>
                <input type="number" id="min-price" class="form-control" placeholder="0">
            </div>
            <div class="">
                <label for="max-price" class="form-label">Harga Maksimum</label>
                <input type="number" id="max-price" class="form-control" placeholder="0">
            </div>
           </div>
           </div>
        </div>

        <div class="row d-flex mt-5" id="wisata-container">
            @foreach ($wisata as $item)
                <div class="col-md-3 wisata-item mb-4" data-price="{{ $item->harga_tiket_masuk }}" data-kategori="{{ $item->kategori_id }}">
                    <div class="swiper-slide swiper-card card p-3 shadow border-primary">
                        <div class="position-relative">
                            @if ($item->gambar)
                                @php
                                    $gambarPertama = json_decode($item->gambar)[0] ?? '';
                                @endphp
                                @if ($gambarPertama)
                                    <img src="{{ $gambarPertama }}" alt="Gambar" width="100" class="me-2 rounded-3"
                                        style="height: 230px">
                                @endif
                            @endif
                            <button class="btn btn-light position-absolute top-0 end-0 mx-4 my-2 rounded-circle"
                                style="z-index: 1;">
                                <i class="bi bi-heart fs-6 fw-bold"></i>
                            </button>
                            <div class="mt-3">
                                <a href="{{ route('detail', $item->id) }}" class="nav-link">
                                    <h6 class="fw-semibold text-start">{{ $loop->iteration }}. {{ $item->nama }}</h6>
                                </a>
                                <div class="d-flex">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star text-warning"></i>
                                    (30)
                                </div>
                                <div class="text-start mt-2">
                                    <h6>Jam Operasional : {{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}</h6>
                                    <span class="fw-semibold text-end mt-3  badge bg-danger">Rp. {{ number_format($item->harga_tiket_masuk, 0, ',', '.') }}</span>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const kategoriSelect = document.getElementById('kategori');
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');
            const wisataItems = document.querySelectorAll('.wisata-item');

            function filterWisata() {
                const selectedKategori = kategoriSelect.value;
                const minPrice = parseInt(minPriceInput.value) || 0;
                const maxPrice = parseInt(maxPriceInput.value) || Infinity;

                wisataItems.forEach(item => {
                    const price = parseInt(item.getAttribute('data-price'));
                    const kategori = item.getAttribute('data-kategori');
                    
                    if ((price >= minPrice && price <= maxPrice) && 
                        (selectedKategori === '' || kategori === selectedKategori)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            kategoriSelect.addEventListener('change', filterWisata);
            minPriceInput.addEventListener('input', filterWisata);
            maxPriceInput.addEventListener('input', filterWisata);
        });
    </script>
@endsection
