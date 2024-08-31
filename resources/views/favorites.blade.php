@extends('layouts.homepage')

@section('content')

    <style>
        .card-hover {
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card-hover:hover {
            transform: translateY(-10px);
        }
    </style>

    <div class="container my-5 vh-100">
        <h2 class="mb-4 fw-bold">Wisata Favorit</h2>

        @if ($wisataFavorites->isEmpty())
            <div class="text-center">
                <img src="https://img.freepik.com/premium-vector/flat-no-data-concept-outline-design-style-minimal-vector-illustration-landing-page-web-banner-infographics-hero-images_269730-1906.jpg"
                    alt="No Favorites" class="img-fluid mb-4" style="max-width: 300px;">
                <p class="fs-4 fw-semibold m-0">Belum ada wisata favorit yang ditambahkan.</p>
                <p class="fs-6 m-0">Jelajahi wisata kami dan tambahkan ke favorit Anda!</p>
                <a href="{{ route('wisata.index') }}" class="btn btn-dark rounded-5 px-4 mt-3">Jelajahi Wisata </a>
            </div>
        @else
            <div class="row">
                @foreach ($wisataFavorites as $item)
                    <div class="col-md-3">
                        <div class="swiper-slide swiper-card card-hover">
                            <div class="position-relative">
                                <a href="{{ route('detail', $item->id) }}" class="d-block nav-link">
                                    @if ($item->gambar)
                                        @php
                                            $gambarPertama = json_decode($item->gambar)[0] ?? '';
                                        @endphp
                                        @if ($gambarPertama)
                                            <img src="{{ $gambarPertama }}" alt="Gambar" width="100"
                                                class="me-2 rounded-3" style="height: 230px">
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
                                        <h6 class="fw-semibold text-start text-dark text-decoration-none">{{ $loop->iteration }}. {{ $item->nama }}</h6>
                                        <div class="d-flex">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            (30)
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
