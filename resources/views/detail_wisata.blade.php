@extends('layouts.homepage')

@section('content')
    <style>
        .star-rating {
            direction: rtl;
            display: inline-block;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            font-size: 2rem;
            padding: 0;
            cursor: pointer;
        }

        .star-rating input[type="radio"]:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc700;
        }
    </style>
    <div class="container min-vh-100 my-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-dark nav-link" href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $wisata->nama }}</li>
            </ol>
        </nav>

        <div>
            <div class="d-flex mb-3">
                @php
                    $fullStars = floor($averageRating);
                    $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                    $emptyStars = 5 - $fullStars - $halfStar;
                @endphp
                
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="bi bi-star-fill text-warning me-1"></i>
                @endfor

                @if ($halfStar)
                    <i class="bi bi-star-half text-warning me-1"></i>
                @endif

                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="bi bi-star text-warning me-1"></i>
                @endfor

                <span class="mx-2"> ({{ $comments->count() }} Ulasan)</span>
            </div>
            <a href="#komentar" class="text-dark"> Tulis Ulasan</a>
        </div>

        <div class="row d-flex ">
            <div class="col-md-12">
                @if ($wisata->gambar)
                    @php
                        $gambarPertama = json_decode($wisata->gambar)[0] ?? '';
                    @endphp
                    @if ($gambarPertama)
                        <img src="{{ $gambarPertama }}" style="width: 100%;height: 60%" class="img-fluid rounded-3"
                            alt="">
                    @endif
                @endif

                <div class="mt-3">
                    <h3 class="fw-semibold">
                        {{ $wisata->nama }}
                    </h3>
                    <span class="badge"
                        style="background-color: {{ $wisata->kategori->warna }}">{{ $wisata->kategori->nama }}</span>
                    <p class="mt-2">
                        {{ $wisata->deskripsi }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe quos illo
                        animi aperiam et magni fugit error a expedita optio necessitatibus reprehenderit, in voluptatibus,
                        ipsa incidunt sit sunt nam eos? Delectus velit debitis ipsa officiis ea necessitatibus modi numquam
                        nostrum?
                        <br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus nam incidunt numquam eum
                        consectetur? Quos nam, aliquam provident velit voluptatum inventore neque error quod aspernatur
                        similique, molestias alias fugiat numquam? Vero repellat deleniti, voluptatibus quia, alias et
                        inventore aliquam vel officiis soluta distinctio commodi tempore. Ratione expedita saepe esse
                        aperiam!
                    </p>
                    <div class="d-flex justify-content-between">
                        <div>
                            <table>
                                <tr>
                                    <td class="text-muted">Jam Operasional</td>
                                    <td class="text-dark">: {{ \Carbon\Carbon::parse($wisata->jam_buka)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($wisata->jam_tutup)->format('H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Harga Tiket Masuk</td>
                                    <td class="text-dark">: <span class="fw-semibold text-danger "
                                            style="font-weight: 900">{{ $wisata->formatted_harga_tiket_masuk }}</span></td>
                                </tr>

                            </table>
                        </div>
                        <div>
                            @php
                                $favorites = Auth::check() && Auth::user()->favorites->contains($wisata->id);
                            @endphp
                            <button type="button" class="btn btn-outline-light my-2 rounded-circle toggle-favorite-btn"
                                style="z-index: 1;" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ Auth::check() && Auth::user()->favorites->contains($wisata->id) ? 'Hapus dari favorit' : 'Tambahkan ke favorit' }}"
                                data-id="{{ $wisata->id }}">
                                <i
                                    class="bi fs-4 fw-bold {{ Auth::check() && Auth::user()->favorites->contains($wisata->id) ? 'text-danger bi-heart-fill' : 'bi-heart' }}">
                                </i>
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-dark mb-4">Rekomendasi Wisata </h2>
        <div class="swiper swiperCard " style="height: 24rem">
            <div class="swiper-wrapper">
                @foreach ($rekomendasiWisata as $item)
                    <div class="swiper-slide swiper-card">
                        <div class=" position-relative">
                            @if ($item->gambar)
                                @php
                                    $gambarPertama = json_decode($item->gambar)[0] ?? '';
                                @endphp
                                @if ($gambarPertama)
                                    <img src="{{ $gambarPertama }}" alt="Gambar" width="100" class="me-2 rounded-3"
                                        style="height: 230px">
                                @endif
                            @endif
                            <button type="button"
                                class="btn btn-light position-absolute top-0 end-0 mx-4 my-2 rounded-circle toggle-favorite-btn"
                                style="z-index: 1;" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                title="{{ Auth::check() && Auth::user()->favorites->contains($item->id) ? 'Hapus dari favorit' : 'Tambahkan ke favorit' }}"
                                data-id="{{ $item->id }}">
                                <i
                                    class="bi fs-6 fw-bold {{ Auth::check() && Auth::user()->favorites->contains($item->id) ? 'text-danger bi-heart-fill' : 'bi-heart' }}">
                                </i>
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
                                <div class="text-start mt-2 fw-semibold">
                                    <h6 class="m-0">Similarity: <span class="fw-bold text-danger">{{ $item->similarity }}</span></h6>
                                <h6>Persentase Kemiripan: <span class="fw-bold text-danger">{{ number_format($item->similarity_percentage, 2) }}%</span></h6>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev">
                <img src="{{ asset('icon/arrow.png') }}" width="50" style="margin-top : -120px" />
            </div>
            <div class="swiper-button-next">
                <img src="{{ asset('icon/arrow.png') }}" width="50" style="margin-top : -120px" />
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="row d-flex">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h3 class="fw-bold">Lokasi</h3>
                    <div class="mt-3 float-end mb-2">
                        <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}"
                            target="_blank" class="nav-link  text-primary fw-semibold px-3 ">
                            Buka di Google Maps
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div id="map" style="height: 400px;"></div>

            </div>

            <div class="col-md-12 mt-5">
                <div class="row">
                    <div class="col-md-4 ">
                        <h5 class="fw-bold mt-4 text-center my-4">
                            <i class="bi bi-shop me-2"></i>Restoran Terdekat
                        </h5>
                        <ul id="restaurant-list" class="list-group">
                        </ul>
                    </div>
                    <div class="col-md-4 ">
                        <h5 class="fw-bold mt-4 text-center my-4">
                            <i class="bi bi-credit-card me-2"></i>ATM Terdekat
                        </h5>
                        <ul id="atm-list" class="list-group">
                        </ul>
                    </div>
                    <div class="col-md-4 ">
                        <h5 class="fw-bold mt-4 text-center my-4">
                            <i class="bi bi-building me-2"></i>Hotel Terdekat
                        </h5>
                        <ul id="hotel-list" class="list-group">
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12 mt-5" id="komentar">
            <h5 class="fw-bold"> <i class="bi bi-chat-dots me-2"></i> Komentar</h5>
            <div class="card shadow border-0 p-3 mt-3">
                <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tulis Komentar</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="6" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label
                                    for="star5" class="fas fa-star"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label
                                    for="star4" class="fas fa-star"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label
                                    for="star3" class="fas fa-star"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label
                                    for="star2" class="fas fa-star"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label
                                    for="star1" class="fas fa-star"></label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="image">
                        </div>
                        <input type="hidden" name="wisata_id" value="{{ $wisata->id }}">
                        <button type="submit" class="btn btn-dark px-3 mb-2 rounded-5 float-end">Kirim</button>
                    </div>
                </form>
            </div>
        </div>



        <div class="row mt-5">
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <h5 class="fw-bold">
                        {{ number_format($averageRating ?? 0, 1) }}
                    </h5>
                    <div>
                        @if ($averageRating > 0)
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star{{ $i <= floor($averageRating) ? '-fill text-warning' : '' }}"></i>
                            @endfor
                        @else
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi bi-star text-warning"></i>
                            @endfor
                        @endif
                        <span> ({{ $comments->count() }} Ulasan)</span>
                    </div>
                </div>
                <div class="mt-3">
                    @if ($comments->count() > 0)
                        <!-- Rating distribution -->
                        @foreach ([5 => 'Luar biasa', 4 => 'Sangat bagus', 3 => 'Biasa', 2 => 'Buruk', 1 => 'Sangat buruk'] as $rating => $label)
                            <div class="d-flex justify-content-between">
                                <span>{{ $label }}</span>
                                <span>{{ $ratingCounts->get((string)$rating, 0) }}</span>
                            </div>
                            <div class="progress mb-2 rounded-5" style="height: 20px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: {{ ($ratingCounts->get((string)$rating, 0) / $comments->count()) * 100 }}%;"
                                     aria-valuenow="{{ ($ratingCounts->get((string)$rating, 0) / $comments->count()) * 100 }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        @endforeach
                    @else
                        <p>No ratings available</p>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body">
                        <form class="d-flex position-relative" role="search" id="searchForm">
                            <input class="form-control me-2 ps-5" type="search" id="searchInput"
                                   placeholder="Cari Wisata" aria-label="search" style="border-radius: 24px;">
                            <i class="bi bi-search position-absolute"
                               style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
                        </form>
                        <div class="dropdown my-3">
                            <button class="btn btn-outline-dark rounded-5 px-4 btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu" id="filterOptions">
                                <li><button class="dropdown-item filter-btn" data-filter="terbaru" type="button">Terbaru</button></li>
                                <li><button class="dropdown-item filter-btn" data-filter="terlama" type="button">Terlama</button></li>
                                @foreach ([5 => 'Rating 5', 4 => 'Rating 4', 3 => 'Rating 3', 2 => 'Rating 2', 1 => 'Rating 1'] as $rating => $label)
                                    <li>
                                        <button class="dropdown-item filter-btn" data-filter="rating-{{ $rating }}" type="button">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= $rating ? '-fill text-warning' : '' }}"></i>
                                            @endfor
                                            {{ $label }}
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <hr>
                        <div id="commentSection">
                            @forelse ($wisata->comments as $comment)
                                <div class="comment" data-date="{{ $comment->created_at }}">
                                    <div class="d-flex gap-2 align-items-center">
                                        <img src="https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"
                                             width="50" class="rounded-5" height="50" alt="">
                                        <div>
                                            <h6 class="fw-bold m-0">{{ $comment->user->name }}</h6>
                                        </div>
                                    </div>
                                    <div>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $comment->rating ? '-fill text-warning' : '' }}"></i>
                                        @endfor
                                    </div>
                                    <div class="mt-2">
                                        <p>{{ $comment->content }}</p>
                                        @if ($comment->image)
                                            <div class="d-flex gap-2 mb-3">
                                                <img src="{{ asset($comment->image) }}" width="100" class="rounded-3" alt="">
                                            </div>
                                        @endif
                                        <p class="text-small text-muted" style="font-size: 12px">
                                            {{ $comment->created_at->format('d F Y') }}
                                        </p>
                                        <hr>
                                    </div>
                                </div>
                            @empty
                                <p>No comments available</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('script')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil data latitude dan longitude dari data yang diteruskan ke view
            var latitude = @json($wisata->latitude);
            var longitude = @json($wisata->longitude);
            var map = L.map('map').setView([latitude, longitude], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('{{ $wisata->nama }}')
                .openPopup();

            // Query Overpass API untuk restoran terdekat, ATM, dan hotel
            function addNearbyPlaces(url, listId, type) {
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        var list = document.getElementById(listId);
                        var elements = data.elements;

                        // Batasi hingga 5 elemen
                        var limitedElements = elements.slice(0, 5);

                        limitedElements.forEach(element => {
                            var latlng = [element.lat, element.lon];
                            var placeMarker = L.marker(latlng).addTo(map);

                            var name = element.tags.name || type;
                            var distance = map.distance(marker.getLatLng(), latlng);

                            placeMarker.bindPopup(name);

                            // Format jarak
                            var distanceText = distance >= 1000 ? (distance / 1000).toFixed(2) + ' km' :
                                distance.toFixed(2) + ' meter';

                            // Buat tautan Google Maps
                            var googleMapsLink =
                                `https://www.google.com/maps?q=${element.lat},${element.lon}`;

                            // Tambahkan tempat ke daftar
                            var listItem = document.createElement('li');
                            listItem.className = 'list-group-item';
                            listItem.innerHTML =
                                ` <a href="${googleMapsLink}" class="text-decoration-none text-dark" target="_blank">${name}</a> - ${distanceText} `;
                            list.appendChild(listItem);
                        });
                    })
                    .catch(err => console.error(err));
            }

            addNearbyPlaces(
                'https://overpass-api.de/api/interpreter?data=[out:json];node[amenity=restaurant](around:5000, ' +
                latitude + ', ' + longitude + ');out;', 'restaurant-list', 'Restaurant');
            addNearbyPlaces(
                'https://overpass-api.de/api/interpreter?data=[out:json];node[amenity=atm](around:5000, ' +
                latitude + ', ' + longitude + ');out;', 'atm-list', 'ATM');
            addNearbyPlaces(
                'https://overpass-api.de/api/interpreter?data=[out:json];node[tourism=hotel](around:5000, ' +
                latitude + ', ' + longitude + ');out;', 'hotel-list', 'Hotel');
        });
    </script>

    <script>
        $(document).ready(function() {
            // Function to filter comments based on the search input
            $('#searchInput').on('input', function() {
                let searchValue = $(this).val().toLowerCase();
                $('#commentSection .comment').each(function() {
                    let commentText = $(this).find('p').text().toLowerCase();
                    $(this).toggle(commentText.includes(searchValue));
                });
            });

            // Function to filter comments based on selected filter
            $('#filterOptions .filter-btn').on('click', function() {
                let filter = $(this).data('filter');
                $('#commentSection .comment').each(function() {
                    let show = true;

                    if (filter.startsWith('rating-')) {
                        let rating = filter.split('-')[1];
                        let stars = $(this).find('.bi-star-fill').length;
                        show = stars === parseInt(rating);
                    } else if (filter === 'terbaru') {
                        let dateA = new Date($(this).data('date'));
                        let dateB = new Date($('#commentSection .comment').first().data('date'));
                        show = dateB - dateA < 0;
                    } else if (filter === 'terlama') {
                        let dateA = new Date($(this).data('date'));
                        let dateB = new Date($('#commentSection .comment').first().data('date'));
                        show = dateA - dateB < 0;
                    }

                    $(this).toggle(show);
                });
            });
        });
    </script>
@endsection
