@extends('layouts.homepage')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-between mb-4">
            <div class="col-md-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select id="kategori" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategori as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="sort-rating" class="form-label">Urutkan Berdasarkan Rating</label>
                <select id="sort-rating" class="form-select">
                    <option value="">Pilih</option>
                    <option value="highest_rating">Rating Tertinggi</option>
                    <option value="lowest_rating">Rating Terendah</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="filter-location" class="form-label">Lokasi Terdekat</label>
                <button id="detect-location" class="btn btn-outline-primary w-100">Gunakan Lokasi Saya</button>
            </div>            
            <div class="col-md-3">
                <div class="d-flex">
                    <div class="me-2">
                        <label for="min-price" class="form-label">Harga Minimum</label>
                        <input type="number" id="min-price" class="form-control" placeholder="0">
                    </div>
                    <div>
                        <label for="max-price" class="form-label">Harga Maksimum</label>
                        <input type="number" id="max-price" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row d-flex mt-5" id="wisata-container">
            <h2>Daftar Wisata</h2>
            @foreach ($wisata as $item)
                @php
                    // Calculate average rating and count the number of reviews
                    $averageRating = $item->comments->avg('rating');
                    $reviewsCount = $item->comments->count();
                @endphp

                <div class="col-md-3 wisata-item mb-4" 
                     data-price="{{ $item->harga_tiket_masuk }}" 
                     data-kategori="{{ $item->kategori_id }}" 
                     data-rating="{{ $averageRating }}"
                     data-lat="{{ $item->latitude }}" 
                     data-lon="{{ $item->longitude }}">
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
                                <div class="d-flex align-items-center">
                                    <h5 class="fw-bold mb-0">
                                        {{ number_format($averageRating ?? 0, 1) }}
                                    </h5>
                                    <div class="ms-2">
                                        @if ($averageRating > 0)
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= floor($averageRating) ? '-fill text-warning' : '' }}"></i>
                                            @endfor
                                        @else
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star text-warning"></i>
                                            @endfor
                                        @endif
                                        <span> ({{ $reviewsCount }} Ulasan)</span>
                                    </div>
                                </div>
                                <div class="text-start mt-2">
                                    <h6>Jam Operasional : {{ \Carbon\Carbon::parse($item->jam_buka)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->jam_tutup)->format('H:i') }}</h6>
                                    <span class="fw-semibold text-end mt-3 badge bg-danger">Rp. {{ number_format($item->harga_tiket_masuk, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="d-flex justify-content-center">
                {{ $wisata->links() }} <!-- Pagination -->
            </div> --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $wisata->links('pagination::bootstrap-5') }} <!-- Pagination links -->
            </div>
            <!-- Pagination controls -->
            {{-- <div class="d-flex justify-content-between mt-3">
                <button id="prev-page" class="btn btn-primary" disabled>Previous</button>
                <button id="next-page" class="btn btn-primary">Next</button>
            </div> --}}

        </div>
    </div>
@endsection

@section('script')
    <script>
       document.addEventListener('DOMContentLoaded', function () {
            const kategoriSelect = document.getElementById('kategori');
            const minPriceInput = document.getElementById('min-price');
            const maxPriceInput = document.getElementById('max-price');
            const sortRatingSelect = document.getElementById('sort-rating');
            const wisataItems = document.querySelectorAll('.wisata-item');

            function filterWisata() {
                const selectedKategori = kategoriSelect.value;
                const minPrice = parseInt(minPriceInput.value) || 0;
                const maxPrice = parseInt(maxPriceInput.value) || Infinity;
                const sortRating = sortRatingSelect.value;

                const filteredItems = Array.from(wisataItems).filter(item => {
                    const price = parseInt(item.getAttribute('data-price'));
                    const kategori = item.getAttribute('data-kategori');
                    return (price >= minPrice && price <= maxPrice) && 
                        (selectedKategori === '' || kategori === selectedKategori);
                });

                if (sortRating === 'highest_rating') { 
                    filteredItems.sort((a, b) => {
                        const ratingA = parseFloat(a.querySelector('.fw-bold.mb-0').innerText);
                        const ratingB = parseFloat(b.querySelector('.fw-bold.mb-0').innerText);
                        return ratingB - ratingA;
                    });
                } else if (sortRating === 'lowest_rating') {
                    filteredItems.sort((a, b) => {
                        const ratingA = parseFloat(a.querySelector('.fw-bold.mb-0').innerText);
                        const ratingB = parseFloat(b.querySelector('.fw-bold.mb-0').innerText);
                        return ratingA - ratingB;
                    });
                }

                // Reset display and re-order items
                wisataItems.forEach(item => item.style.display = 'none');
                const container = document.getElementById('wisata-container');
                filteredItems.forEach(item => {
                    item.style.display = 'block';
                    container.appendChild(item);
                });
            }

            kategoriSelect.addEventListener('change', filterWisata);
            minPriceInput.addEventListener('input', filterWisata);
            maxPriceInput.addEventListener('input', filterWisata);
            sortRatingSelect.addEventListener('change', filterWisata);
        });
        
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const itemsPerPage = 12;
            const items = document.querySelectorAll('.wisata-item');
            let currentPage = 1;
            const totalPages = Math.ceil(items.length / itemsPerPage);
            
            function showPage(page) {
                const start = (page - 1) * itemsPerPage;
                const end = page * itemsPerPage;
                
                items.forEach((item, index) => {
                    if (index >= start && index < end) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Show the first page initially
            showPage(currentPage);

            // Handle next page button click
            document.getElementById('next-page').addEventListener('click', function () {
                if (currentPage < totalPages) {
                    currentPage++;
                    showPage(currentPage);
                    document.getElementById('prev-page').disabled = false;
                }
                if (currentPage === totalPages) {
                    document.getElementById('next-page').disabled = true;
                }
            });

            // Handle previous page button click
            document.getElementById('prev-page').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    showPage(currentPage);
                    document.getElementById('next-page').disabled = false;
                }
                if (currentPage === 1) {
                    document.getElementById('prev-page').disabled = true;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                autoplay: true,
                autoplayTimeout: 3000,
                items: 4,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 4 }
                }
            });
        });
    </script>
   <script>
    // Function to calculate the distance using Haversine formula
    function calculateDistance(lat1, lon1, lat2, lon2) {
        const toRad = (value) => value * Math.PI / 180;
        const R = 6371; // Earth's radius in kilometers
        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                  Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                  Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Return distance in kilometers
    }

    document.addEventListener('DOMContentLoaded', function () {
        const detectLocationButton = document.getElementById('detect-location');
        const wisataContainer = document.getElementById('wisata-container');
        const wisataItems = document.querySelectorAll('.wisata-item');

        detectLocationButton.addEventListener('click', function () {
            detectLocationButton.textContent = 'Mendeteksi...';
            detectLocationButton.disabled = true;

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        detectLocationButton.textContent = 'Gunakan Lokasi Saya';
                        detectLocationButton.disabled = false;

                        const userLatitude = position.coords.latitude;
                        const userLongitude = position.coords.longitude;

                        const itemsWithinDistance = Array.from(wisataItems).map(item => {
                            const latitude = parseFloat(item.getAttribute('data-lat'));
                            const longitude = parseFloat(item.getAttribute('data-lon'));
                            const distance = calculateDistance(userLatitude, userLongitude, latitude, longitude);

                            // Pastikan elemen jarak sebelumnya dihapus
                            const existingDistanceElement = item.querySelector('.distance');
                            if (existingDistanceElement) {
                                existingDistanceElement.remove();
                            }

                            return { item, distance };
                        }).filter(({ distance }) => distance < 500);

                        itemsWithinDistance.sort((a, b) => a.distance - b.distance);

                        wisataContainer.innerHTML = ''; // Kosongkan kontainer
                        if (itemsWithinDistance.length > 0) {
                            itemsWithinDistance.forEach(({ item, distance }) => {
                                const distanceElement = document.createElement('p');
                                distanceElement.className = 'distance text-muted';
                                distanceElement.textContent = `Jarak: ${distance.toFixed()} km`;
                                item.appendChild(distanceElement); // Tambahkan jarak ke item
                                wisataContainer.appendChild(item); // Tampilkan item
                            });
                        } else {
                            wisataContainer.innerHTML = '<p class="text-center">Tidak ada destinasi dalam jarak kurang dari 100 km.</p>';
                        }
                    },
                    (error) => {
                        detectLocationButton.textContent = 'Gunakan Lokasi Saya';
                        detectLocationButton.disabled = false;
                        alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diberikan.');
                    }
                );
            } else {
                detectLocationButton.textContent = 'Gunakan Lokasi Saya';
                detectLocationButton.disabled = false;
                alert('Geolocation tidak didukung oleh browser Anda.');
            }
        });

    });
</script>

@endsection
