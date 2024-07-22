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
            <h1 class="fw-bold">Pantain Jungkuntod</h1>
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
                    style="width: 100%;height: 80%" class="img-fluid rounded-3" alt="">
                <div class="mt-3">
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam porro nemo explicabo distinctio
                        blanditiis tenetur voluptate consequatur, rem voluptatum odio, illum reiciendis in repellendus animi
                        omnis eligendi aut nesciunt quia?
                    </p>
                </div>
            </div>
        </div>

        <h2 class="fw-bold text-dark mt-5 mb-4">Rekomendasi Wisata</h2>
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
            <div class="col-md-8">
                <h3 class="fw-bold">Lokasi</h3>
                <div id="map" style="height: 400px;"></div>
                <div class="mt-3">
                    <a href="https://www.google.com/maps/search/?api=1&query=-7.797068,110.370529" target="_blank"
                        class="btn btn-dark px-3 rounded-5">
                        Buka di Google Maps
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="fw-bold">
                    Disekitar Pantai
                </h3>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Fasilitas</th>
                            <th>Jarak</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ATM</td>
                            <td>500m</td>
                            <td>Terletak di sebelah toko A</td>
                        </tr>
                        <tr>
                            <td>Restoran</td>
                            <td>1.2km</td>
                            <td>Restoran B menyajikan makanan lokal</td>
                        </tr>
                        <tr>
                            <td>Hotel</td>
                            <td>2km</td>
                            <td>Hotel C dengan fasilitas lengkap</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>

        <div class="col-md-12 mt-5">
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
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
        
                    <div class="d-flex justify-content-between">
                        <span>Sangat bagus</span>
                        <span>4</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
        
                    <div class="d-flex justify-content-between">
                        <span>Biasa</span>
                        <span>3</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
        
                    <div class="d-flex justify-content-between">
                        <span>Buruk</span>
                        <span>0</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
        
                    <div class="d-flex justify-content-between">
                        <span>Sangat buruk</span>
                        <span>0</span>
                    </div>
                    <div class="progress mb-2 rounded-5" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
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
                            <div>
                                <p class="text-small text-muted" style="font-size: 12px">8 Januari 2024</p>
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
            var map = L.map('map').setView([-7.797068, 110.370529], 14); // Example coordinates

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-7.797068, 110.370529]).addTo(map) // Example coordinates
                .bindPopup('Kos Adaha.')
                .openPopup();
        });
    </script>
@endsection
