@extends('layouts.homepage')

@section('content')
    <div class="container min-vh-100 my-5">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item "><a class="text-dark nav-link" href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav>

        <div>
            <h1 class="fw-bold">Pantai Jungkuntod</h1>
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

        <div class="row d-flex mt-3">
            <div class="col-md-12">
                <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                    style="width: 100%;height: 60%" class="img-fluid rounded-3" alt="">
                <div class="mt-3">
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam porro nemo explicabo distinctio
                        blanditiis tenetur voluptate consequatur, rem voluptatum odio, illum reiciendis in repellendus animi
                        omnis eligendi aut nesciunt quia? Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem culpa tempore, nesciunt laudantium expedita minus quod illo est eum doloremque aliquid autem non fugiat! Dolorem temporibus voluptatibus ipsa quisquam consequatur, ducimus sit voluptatum voluptas. Esse cum beatae ab amet tenetur, magni laudantium nostrum quidem animi blanditiis velit voluptatum quos ad. Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur nisi quae quasi consequatur nihil corrupti aut labore tempora asperiores, similique sed voluptate dicta distinctio. Pariatur possimus tempora, obcaecati quas consectetur molestiae temporibus et ea dolorum doloribus animi ab libero recusandae dignissimos quos velit incidunt ratione aliquid magni aliquam iusto? Illum amet deleniti aspernatur eum iste doloribus ad sed blanditiis quo dolor? Deserunt enim quo, doloremque sed facere dicta. Est aperiam, minima quaerat laborum voluptas sit nam hic obcaecati, quos, quod ullam vero veniam provident molestias sequi. Facilis quae ipsa hic, maxime sint nihil repellendus itaque vel nisi est rem delectus?
                    </p>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-dark mb-4">Rekomendasi Wisata</h2>
        <div class="swiper swiperCard " style="height: 24rem">
            <div class="swiper-wrapper">
                @for ($i = 1; $i < 6; $i++)
                    <div class="swiper-slide swiper-card">
                        <div class=" position-relative">
                            <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                                class="card-img-top rounded-3" alt="">
                            <button class="btn btn-light position-absolute top-0 end-0 mx-4 my-2 rounded-circle"
                                style="z-index: 1;">
                                <i class="bi bi-heart fs-6 fw-bold"></i>
                            </button>
                            <div class="mt-3">
                                <h6 class="fw-semibold  text-start">1. Pantai Indrayanti</h6>
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
                @endfor
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
                        <a href="https://www.google.com/maps/search/?api=1&query=-7.797068,110.370529" target="_blank"
                            class="nav-link  text-primary fw-semibold px-3 ">
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
            var map = L.map('map').setView([-7.797068, 110.370529], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            var pantaiJungkuntod = L.marker([-7.797068, 110.370529]).addTo(map)
                .bindPopup('Pantai Jungkuntod')
                .openPopup();

            // Query Overpass API for nearby restaurants
            var restaurantUrl =
                'https://overpass-api.de/api/interpreter?data=[out:json];node[amenity=restaurant](around:5000, -7.797068, 110.370529);out;';
            fetch(restaurantUrl)
                .then(response => response.json())
                .then(data => {
                    var restaurantList = document.getElementById('restaurant-list');
                    var elements = data.elements;

                    // Limit to 5 elements
                    var limitedElements = elements.slice(0, 5);

                    limitedElements.forEach(element => {
                        var latlng = [element.lat, element.lon];
                        var marker = L.marker(latlng).addTo(map);

                        var name = element.tags.name || 'Restaurant';
                        var distance = map.distance(pantaiJungkuntod.getLatLng(), latlng);

                        marker.bindPopup(name);

                        // Format distance
                        var distanceText = distance >= 1000 ? (distance / 1000).toFixed(2) + ' km' :
                            distance.toFixed(2) + ' meter';

                        // Create Google Maps link
                        var googleMapsLink =
                            `https://www.google.com/maps?q=${element.lat},${element.lon}`;

                        // Add restaurant to the list
                        var listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML =
                            ` <a href="${googleMapsLink}" class="text-decoration-none text-dark" target="_blank">${name}</a> - ${distanceText} `;
                        restaurantList.appendChild(listItem);
                    });
                })
                .catch(err => console.error(err));

            // Query Overpass API for nearby ATMs
            var atmUrl =
                'https://overpass-api.de/api/interpreter?data=[out:json];node[amenity=atm](around:5000, -7.797068, 110.370529);out;';
            fetch(atmUrl)
                .then(response => response.json())
                .then(data => {
                    var atmList = document.getElementById('atm-list');
                    var elements = data.elements;

                    // Limit to 5 elements
                    var limitedElements = elements.slice(0, 5);

                    limitedElements.forEach(element => {
                        var latlng = [element.lat, element.lon];
                        var marker = L.marker(latlng).addTo(map);

                        var name = element.tags.name || 'ATM';
                        var distance = map.distance(pantaiJungkuntod.getLatLng(), latlng);

                        marker.bindPopup(name);

                        // Format distance
                        var distanceText = distance >= 1000 ? (distance / 1000).toFixed(2) + ' km' :
                            distance.toFixed(2) + ' meter';

                        // Create Google Maps link
                        var googleMapsLink =
                            `https://www.google.com/maps?q=${element.lat},${element.lon}`;

                        // Add ATM to the list
                        var listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML =
                            ` <a href="${googleMapsLink}" class="text-decoration-none text-dark" target="_blank">${name}</a> - ${distanceText} `;
                        atmList.appendChild(listItem);
                    });
                })
                .catch(err => console.error(err));

            // Query Overpass API for nearby hotels
            var hotelUrl = 'https://overpass-api.de/api/interpreter?data=[out:json];node[tourism=hotel](around:5000, -7.797068, 110.370529);out;';

            fetch(hotelUrl)
                .then(response => response.json())
                .then(data => {
                    var hotelList = document.getElementById('hotel-list');
                    var elements = data.elements;

                    // Limit to 5 elements
                    var limitedElements = elements.slice(0, 5);

                    limitedElements.forEach(element => {
                        var latlng = [element.lat, element.lon];
                        var marker = L.marker(latlng).addTo(map);

                        var name = element.tags.name || 'Hotel';
                        var distance = map.distance(pantaiJungkuntod.getLatLng(), latlng);

                        marker.bindPopup(name);

                        // Format distance
                        var distanceText = distance >= 1000 ? (distance / 1000).toFixed(2) + ' km' :
                            distance.toFixed(2) + ' meter';

                        // Create Google Maps link
                        var googleMapsLink =
                            `https://www.google.com/maps?q=${element.lat},${element.lon}`;

                        // Add hotel to the list
                        var listItem = document.createElement('li');
                        listItem.className = 'list-group-item';
                        listItem.innerHTML =
                            ` <a href="${googleMapsLink}" class="text-decoration-none text-dark" target="_blank">${name}</a> - ${distanceText} `;
                        hotelList.appendChild(listItem);
                    });
                })
                .catch(err => console.error(err));
        });
    </script>
@endsection
