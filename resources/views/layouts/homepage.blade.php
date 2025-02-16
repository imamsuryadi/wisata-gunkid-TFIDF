<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title id="page-title">Wisata Gunung Kidul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

</head>

<style>
    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 0 0 10px 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1001;
    }

    .search-result-item {
        padding: 10px;
        cursor: pointer;
    }

    .search-result-item:hover {
        background-color: #f0f0f0;
    }

    .search-container {
        position: relative;
    }
</style>

<body>
    <div class="overlay" id="overlay"></div>
    <nav class="navbar navbar-expand-lg sticky-top bg-white shadow  ">
        <div class="container">
            <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png" width="70"
                alt="">
            <a class="navbar-brand fw-bold" href="#">GunKid</a>
            <div class="col-md-4">
                <form class="d-flex search-container" role="search" onsubmit="return false;">
                    <input id="search-input" class="form-control me-2 ps-5" type="search" placeholder="Cari Wisata"
                        aria-label="search" style="border-radius: 24px;" oninput="searchWisata()"
                        onfocus="showResults()" onblur="hideResults()">
                    <i class="bi bi-search position-absolute"
                        style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
                    <div id="search-results" class="search-results d-none rounded-4"></div>
                </form>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mx-5 gap-3">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ Request::is('semua-wisata') ? 'active' : '' }}" href="/semua-wisata">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ Request::routeIs('favorites') ? 'active' : '' }}" href="{{ route('favorites') }}">Favorite</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ Request::routeIs('artikel') ? 'active' : '' }}" href="{{ route('artikel') }}">Artikel</a>
                    </li>                    
                </ul>
                <ul class="navbar-nav ">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="btn btn-dark rounded-5 px-4 py-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-dark rounded-5 px-4 py-2" href="{{ route('login') }}">Masuk</a>
                            </li>

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/register') }}">Register</a>
                                </li>
                            @endif --}}
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    @yield('content')



    <footer class="text-light pt-4 pb-3"
        style="background: rgb(64,64,202);
background: linear-gradient(90deg, rgba(64,64,202,1) 0%, rgba(0,142,255,1) 100%);">
        <div class="container">
            <div class="row text-center  d-flex justify-content-center align-items-center">
                <!-- Logo and Address -->
                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <div class="mb-3">
                        <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png"
                            width="100" alt="Logo">
                    </div>
                    <p>Jl. KH Agus Salim No.126, Ledoksari, Kepek, Kec. Wonosari, Kabupaten Gunung Kidul, Daerah Istimewa Yogyakarta 55813</p>
                    <p>Dinas Pariwisata Kab. Gunungkidul</p>
                </div>
                <!-- Useful Links -->
                <div class="col-md-4 mb-3 mb-md-0 text-center">
                    <h5>Useful Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Terms &amp; Conditions</a></li>
                    </ul>
                </div>
                <!-- Social Media -->
                <div class="col-md-4 text-center">
                    <h5>Follow Us</h5>
                    <div class="d-flex justify-content-center">
                        <a href="https://facebook.com" class="text-light me-3" target="_blank" aria-label="Facebook">
                            <i class="bi bi-facebook fs-4"></i>
                        </a>
                        <a href="https://twitter.com" class="text-light me-3" target="_blank" aria-label="Twitter">
                            <i class="bi bi-twitter fs-4"></i>
                        </a>
                        <a href="https://instagram.com" class="text-light me-3" target="_blank"
                            aria-label="Instagram">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="https://linkedin.com" class="text-light" target="_blank" aria-label="LinkedIn">
                            <i class="bi bi-linkedin fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <p class="mb-0">Copyright &copy; 2025 - Gunkids. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.toggle-favorite-btn').on('click', function() {
                var btn = $(this);
                var wisataId = btn.data('id');
                var url = '{{ route('wisata.toggleFavorite', ':id') }}';
                url = url.replace(':id', wisataId);

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'added') {
                            btn.find('i').removeClass('bi-heart').addClass(
                                'text-danger bi-heart-fill');
                            btn.attr('title', 'Hapus dari favorit').tooltip('dispose')
                                .tooltip();
                        } else if (response.status === 'removed') {
                            btn.find('i').removeClass('text-danger bi-heart-fill').addClass(
                                'bi-heart');
                            btn.attr('title', 'Tambahkan ke favorit').tooltip('dispose')
                                .tooltip();
                        }
                    },
                    error: function(response) {
                        if (response.status === 401) {
                            window.location.href = '{{ route('login') }}';
                        }
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- jQuery (required for Owl Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>

    @yield('script')
    <script>
        function searchWisata() {
            let query = document.getElementById('search-input').value;

            if (query.length > 0) {
                fetch(`/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        displayResults(data.results);
                    });
            } else {
                clearResults();
            }
        }

        function displayResults(results) {
            let resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = '';

            if (results.length > 0) {
                results.forEach(result => {
                    let div = document.createElement('div');
                    div.className = 'search-result-item';

                    let link = document.createElement('a');
                    link.href = result.detail_url;
                    link.className = 'search-result-link';
                    link.innerHTML = `
                <img src="${result.image_url}" width="50" class="rounded-2" alt="">
                <span>${result.nama}</span>
            `;
                    link.addEventListener('click', function(event) {
                        console.log('Link clicked:', result.detail_url); 
                        window.location.href = result.detail_url; 
                    });

                    div.appendChild(link);
                    resultsContainer.appendChild(div);
                });
            } else {
                resultsContainer.innerHTML = '<div class="search-result-item">Tidak ada hasil ditemukan</div>';
            }

            resultsContainer.classList.remove('d-none');
        }

        function clearResults() {
            let resultsContainer = document.getElementById('search-results');
            resultsContainer.innerHTML = '';
            resultsContainer.classList.add('d-none');
        }

        function showResults() {
            let resultsContainer = document.getElementById('search-results');
            if (resultsContainer.children.length > 0) { // At least one result item
                resultsContainer.classList.remove('d-none');
            }
        }

        function hideResults() {
            setTimeout(() => {
                let resultsContainer = document.getElementById('search-results');
                resultsContainer.classList.add('d-none');
            }, 200);
        }
    </script>
   <script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        scrollbar: {
            el: '.swiper-scrollbar',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>

    <script>
        var swiperCard = new Swiper(".swiperCard", {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    </script>
    @if ($errors->any())
        <script>
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += "{{ $error }}\n";
            @endforeach

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessages,
            });
        </script>
    @endif

    @if (session('success') || session('error'))
        <script>
            $(document).ready(function() {
                var successMessage = "{{ session('success') }}";
                var errorMessage = "{{ session('error') }}";

                if (successMessage) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: successMessage,
                    });
                }

                if (errorMessage) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                    });
                }
            });
        </script>
    @endif

    <script>
        // When a link is clicked, update the page title dynamically
        document.querySelectorAll('a[data-title]').forEach(function (link) {
            link.addEventListener('click', function (e) {
                document.getElementById('page-title').textContent = link.getAttribute('data-title');
            });
        });

        // Set initial page title based on the current link
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('a[data-title]');

        navLinks.forEach(function (link) {
            if (link.getAttribute('href') === currentPath) {
                document.getElementById('page-title').textContent = link.getAttribute('data-title');
            }
        });
    </script>
</body>

</html>
