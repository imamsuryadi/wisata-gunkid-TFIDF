<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

</head>
<style>
    .search-history {
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

    .search-history-item {
        padding: 10px;
        cursor: pointer;
    }

    .search-history-item:hover {
        background-color: #f0f0f0;
    }

    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 999;
        display: none;
    }

    .search-container {
        position: relative;
        z-index: 1001;
    }
</style>

<body>
    <div class="overlay" id="overlay"></div>
    <nav class="navbar navbar-expand-lg ">
        <div class="container">
            <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png" width="70"
                alt="">
            <a class="navbar-brand fw-bold" href="#">Gunkidsss Bos.</a>
            <div class="col-md-4">
                <form class="d-flex search-container" role="search" onsubmit="return false;">
                    <input id="search-input" class="form-control me-2 ps-5" type="search" placeholder="Cari Wisata"
                        aria-label="search" style="border-radius: 24px;" onfocus="showHistory()" onblur="hideHistory()">
                    <i class="bi bi-search position-absolute"
                        style="top: 50%; left: 10px; transform: translateY(-50%);"></i>
                    <div id="search-history" class="search-history d-none rounded-4">
                        <div class="search-history-item rounded-4">
                            <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png" width="50" class="rounded-4" alt="">
                            Epic Family Adventures s
                        </div>
                        <span class="mx-3 text-muted" style="font-size: 12px">Terakhir dilihat</span>
                        <div class="search-history-item">
                            <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png" width="50" class="rounded-4" alt="">
                            Pantai Jungwok
                        </div>
                        <div class="search-history-item">
                            <img src="https://api.bbksdajatim.org/tiket-api/upload/lokasi/2024-03-29/file/MIB9eY128h.png" width="50" class="rounded-4" alt="">
                            Gunung Kidul
                        </div>
                    </div>
                </form>

            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mx-5 gap-3">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="/wisata">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#">Favorite</a>
                    </li>

                </ul>
                <ul class="navbar-nav ">
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/home') }}">Home</a>
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
                    <p>Jl. Cempedak I No. 10, Cempedak, Kec. Cilacap Tengah, Kab. Cilacap, Jawa Tengah</p>
                    <p>Gunung Kidul</p>
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
                <p class="mb-0">Copyright &copy; 2023 - Gunkids. All Rights Reserved.</p>
            </div>
        </div>
    </footer>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @yield('script')
    <script>
        function showHistory() {
            document.getElementById('search-history').classList.remove('d-none');
            document.getElementById('overlay').style.display = 'block';
        }

        function hideHistory() {
            document.getElementById('search-history').classList.add('d-none');
            document.getElementById('overlay').style.display = 'none';
        }

        document.getElementById('overlay').addEventListener('click', function() {
            hideHistory();
        });

        document.getElementById('search-input').addEventListener('focus', function() {
            showHistory();
        });

        document.getElementById('search-input').addEventListener('blur', function() {
            setTimeout(hideHistory, 100); // Timeout to allow click events on search history items
        });
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
            },
        });
    </script>

    <script>
        var swiper = new Swiper(".swiperCard", {
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


</body>

</html>
