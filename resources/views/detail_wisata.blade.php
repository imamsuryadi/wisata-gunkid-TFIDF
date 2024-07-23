@extends('layouts.homepage')

@section('content')
    <div class="container min-vh-100 my-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-dark nav-link" href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $wisata->nama }}</li>
            </ol>
        </nav>

        <div>
            <h1 class="fw-bold">{{ $wisata->nama }}</h1>
            <div class="d-flex mb-3">
                <i class="bi bi-star-fill text-warning me-1"></i>
                <i class="bi bi-star-fill text-warning me-1"></i>
                <i class="bi bi-star-fill text-warning me-1"></i>
                <i class="bi bi-star-fill text-warning me-1"></i>
                <i class="bi bi-star text-warning me-1"></i>
                <span class="mx-2"> (14 Ulasan)</span>
            </div>
            <a href="#" class="text-dark"> Tulis Ulasan</a>
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
                    <span class="badge" style="background-color: {{ $wisata->kategori->warna }}">{{ $wisata->kategori->nama }}</span>
                    <p class="mt-2">
                        {{ $wisata->deskripsi }} Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe quos illo animi aperiam et magni fugit error a expedita optio necessitatibus reprehenderit, in voluptatibus, ipsa incidunt sit sunt nam eos? Delectus velit debitis ipsa officiis ea necessitatibus modi numquam nostrum? 
                        <br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus nam incidunt numquam eum consectetur? Quos nam, aliquam provident velit voluptatum inventore neque error quod aspernatur similique, molestias alias fugiat numquam? Vero repellat deleniti, voluptatibus quia, alias et inventore aliquam vel officiis soluta distinctio commodi tempore. Ratione expedita saepe esse aperiam!
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
                                    <td class="text-dark">: <span class="fw-semibold text-danger " style="font-weight: 900">{{ $wisata->formatted_harga_tiket_masuk }}</span></td>
                                </tr>

                            </table>
                        </div>
                        <div>
                            <a href="" class="btn btn-outline-dark rounded-5 px-4 py-2 ms-5"> <i class="bi bi-heart"></i> Simpan Favorite</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-dark mb-4">Rekomendasi Wisata</h2>
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

        <div class="col-md-12 mt-5">
            <h5 class="fw-bold"> <i class="bi bi-chat-dots me-2"></i> Komentar</h5>
            <div class="card shadow border-0 ">
                <form action="">
                    <div class="card-body ">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Tulis Komentar</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Upload Gambar (Opsional)</label>
                            <input type="file" class="form-control" id="gambar">
                        </div>
                        <button type="submit" class="btn btn-dark px-3 mb-2 rounded-5 float-end">Kirim</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-4">
                <div class="d-flex gap-3">
                    <h5 class="fw-bold">
                        4.5
                    </h5>
                    <div>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star text-warning"></i>
                        <span> (14 Ulasan)</span>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="d-flex justify-content-between">
                        <span>Luar biasa</span>
                        <span>7</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Sangat bagus</span>
                        <span>4</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%;" aria-valuenow="30"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Biasa</span>
                        <span>3</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 20%;" aria-valuenow="20"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Buruk</span>
                        <span>0</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Sangat buruk</span>
                        <span>0</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0">
                    <div class="card-body">
                        <form class="d-flex position-relative" role="search">
                            <input class="form-control me-2 ps-5" type="search" placeholder="Cari Wisata"
                                aria-label="search" style="border-radius: 24px;">
                            <i class="bi bi-search position-absolute"
                                style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
                        </form>
                        <div class="dropdown my-3">
                            <button class="btn btn-outline-dark rounded-5 px-4 btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" type="button">Terbaru</button></li>
                                <li><button class="dropdown-item" type="button">Terlama</button></li>
                            </ul>
                        </div>
                        <hr>
                        {{-- KOMENTAR --}}
                        <div>
                            <div class="d-flex gap-2">
                                <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                    width="50" class="rounded-5" height="50" alt="">
                                <div>
                                    <h6 class="fw-bold m-0">Kos Adaha</h6>
                                    <p>Lorem ipsum</p>
                                </div>
                            </div>
                            <div>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div class="mt-2">

                                <div class="d-flex gap-2 mb-3">
                                    <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                        width="100" class="rounded-3" alt="">
                                    <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                        width="100" class="rounded-3" alt="">
                                </div>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est dolor voluptatum beatae,
                                    odit illo expedita doloribus adipisci ratione nesciunt? Obcaecati necessitatibus dolor
                                    illum autem voluptatem sapiente sequi neque eveniet. Voluptatibus aut est nihil, ea sint
                                    cum molestias fugit dolore reiciendis?</p>
                                <p class="text-small text-muted" style="font-size: 12px">8 Januari 2024</p>

                                <hr>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex gap-2">
                                <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                    width="50" class="rounded-5" height="50" alt="">
                                <div>
                                    <h6 class="fw-bold m-0">Kos Adaha</h6>
                                    <p>Lorem ipsum</p>
                                </div>
                            </div>
                            <div>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div class="mt-2">

                                <div class="d-flex gap-2 mb-3">
                                    <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                        width="100" class="rounded-3" alt="">
                                    <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                        width="100" class="rounded-3" alt="">
                                </div>
                                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Est dolor voluptatum beatae,
                                    odit illo expedita doloribus adipisci ratione nesciunt? Obcaecati necessitatibus dolor
                                    illum autem voluptatem sapiente sequi neque eveniet. Voluptatibus aut est nihil, ea sint
                                    cum molestias fugit dolore reiciendis?</p>
                                <p class="text-small text-muted" style="font-size: 12px">8 Januari 2024</p>

                                <hr>
                            </div>
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
