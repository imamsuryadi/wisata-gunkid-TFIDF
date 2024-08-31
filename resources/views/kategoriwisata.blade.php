@extends('layouts.homepage')

@section('title', 'Wisata Berdasarkan Kategori')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-dark mt-0 mb-3">Wisata Berdasarkan Kategori</h2>
    <div class="swiper swiperCard my-4" style="height: 24rem">
        <div class="swiper-wrapper">
            @foreach ($wisata as $item)
                <div class="swiper-slide swiper-card">
                    <div class="position-relative">
                        <a href="{{ route('detail', $item->id) }}" class="d-block">
                            @if ($item->gambar)
                                @php
                                    $gambarPertama = json_decode($item->gambar)[0] ?? '';
                                @endphp
                                @if ($gambarPertama)
                                    <img src="{{ $gambarPertama }}" alt="Gambar" width="100" class="me-2 rounded-3"
                                        style="height: 230px">
                                @endif
                            @endif
                            </a>
                        <button 
                            type="button"
                            class="btn btn-light position-absolute top-0 end-0 mx-4 my-2 rounded-circle toggle-favorite-btn"
                            style="z-index: 1;" 
                            data-bs-toggle="tooltip" 
                            data-bs-placement="bottom"
                            title="{{ Auth::check() && Auth::user()->favorites->contains($item->id) ? 'Hapus dari favorit' : 'Tambahkan ke favorit' }}"
                            data-id="{{ $item->id }}">
                            <i class="bi fs-6 fw-bold {{ Auth::check() && Auth::user()->favorites->contains($item->id) 
                                ? 'text-danger bi-heart-fill' 
                                : 'bi-heart' }}">
                            </i>
                        </button>
                        <div class="mt-3">
                            <a href="{{ route('detail', $item->id) }}" class="nav-link">
                                <h6 class="fw-semibold text-start">{{ $loop->iteration }}. {{ $item->nama }}</h6>
                            </a>
                            <div class="d-flex">
                                @php
                                    $averageRating = $item->comments->first()->average_rating ?? 0;
                                    $fullStars = floor($averageRating);
                                    $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;
                                    $emptyStars = 5 - $fullStars - $halfStar;
                                @endphp
                                
                                @for ($i = 0; $i < $fullStars; $i++)
                                    <i class="bi bi-star-fill text-warning"></i>
                                @endfor

                                @if ($halfStar)
                                    <i class="bi bi-star-half text-warning"></i>
                                @endif

                                @for ($i = 0; $i < $emptyStars; $i++)
                                    <i class="bi bi-star text-warning"></i>
                                @endfor

                                <span>({{ number_format($averageRating, 1) }})</span>
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
</div>
@endsection
