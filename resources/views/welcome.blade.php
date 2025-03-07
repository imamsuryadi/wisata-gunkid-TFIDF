@extends('layouts.homepage')

@section('content')
    <div class="container py-5">
        {{-- BANNER --}}
        <section>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper" style="height: 28rem">

                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/237272/pexels-photo-237272.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="">
                    </div>
                    <div class="swiper-slide" style="height: 28rem">
                        <img style="height: 28rem"
                            src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/414061/pexels-photo-414061.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="">
                    </div>
                </div>
                <div class="swiper-button-prev">
                    <img src="{{ asset('icon/arrow.png') }}" width="50" />
                </div>
                <div class="swiper-button-next">
                    <img src="{{ asset('icon/arrow.png') }}" width="50" />
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        {{-- GUNUNG KIDUL --}}

        <section class="my-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4 text-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSsRgcf3m2oaevHEqhTCcRkt2mV-B3o_92Lsw&s"
                        class="img-fluid" alt="">
                </div>
                <div class="col-md-8">
                    <span></span>
                    <h2 class="fw-bold text-dark mt-0 mb-4">Gunung Kidul</h2>
                    <p class="text-small ">Gunung Kidul adalah destinasi wisata yang menawarkan keindahan alam yang beragam dan memukau. Kawasan ini dikenal dengan pantainya yang berpasir putih, lautan biru yang jernih, serta bukit-bukit karst yang menakjubkan. Selain itu, terdapat berbagai gua eksotis dengan stalaktit dan stalagmit yang memukau, cocok untuk kegiatan susur gua yang memacu adrenalin. Wisatawan juga dapat menikmati air terjun alami dengan suasana yang asri dan menenangkan, serta embung yang menawarkan pemandangan matahari terbenam yang spektakuler.
                        Bagi pecinta petualangan, Gunung Kidul memiliki area perbukitan dengan jalur trekking yang menantang dan panorama alam yang mempesona. Semua pengalaman ini menjadikan Gunung Kidul sebagai destinasi yang sempurna untuk berlibur, menjelajah, dan menikmati keajaiban alam.</p>
                </div>
            </div>
        </section>

        <div class="swiper swiperCard my-4" style="height: 32rem">
            <h2>Sedang Trending</h2>
            <br>
            <div class="swiper-wrapper">
                @foreach ($trendingWisata as $item)
                    @php
                        $averageRating = $item->comments->avg('rating');
                        $reviewsCount = $item->comments->count();
                        $gambarPertama = json_decode($item->gambar)[0] ?? '';
                    @endphp
                    <div class="swiper-slide swiper-card">
                        <div class="card p-3 shadow border-primary rounded-3">
                            <div class="position-relative">
                                @if ($gambarPertama)
                                    <img src="{{ $gambarPertama }}" alt="Gambar" class="card-img-top rounded-3" style="height: 230px; object-fit: cover;">
                                @endif
                                <div class="card-body mt-3">
                                    <a href="{{ route('detail', $item->id) }}" class="nav-link text-dark">
                                        <h5 class="card-title fw-semibold text-start">{{ $item->nama }}</h5>
                                    </a>
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="fw-bold mb-0">{{ number_format($averageRating ?? 0, 1) }}</h6>
                                        <div class="ms-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi bi-star{{ $i <= floor($averageRating) ? '-fill text-warning' : '' }}"></i>
                                            @endfor
                                            <span class="ms-1">({{ $reviewsCount }} Ulasan)</span>
                                        </div>
                                    </div>
                                    <div class="text-start mt-2">
                                        <span class="fw-semibold badge bg-danger">Rp. {{ number_format($item->harga_tiket_masuk, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-prev">
                <img src="{{ asset('icon/arrow.png') }}" width="50" style="margin-top: -120px" />
            </div>
            <div class="swiper-button-next">
                <img src="{{ asset('icon/arrow.png') }}" width="50" style="margin-top: -120px" />
            </div>
            <div class="swiper-pagination"></div>
        </div>

        {{-- LIST WISATA --}}

        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="fw-bold text-dark mt-0 mb-3 mt-5">Top Rekomendasi</h2>
                    {{-- <p class="text-small mb-3 ">Menampilkan destinasi wisata terbaik berdasarkan rating, popularitas, atau kategori tertentu, sehingga memudahkan pengguna menemukan tempat wisata unggulan di Gunung Kidul.</p> --}}
                        <div class="d-flex gap-2 mt-3 ">
                            @foreach ($kategori as $item)
                                <a href="{{ route('wisata.filter', $item->id) }}" class="btn btn-outline-dark rounded-5 text-sm">
                                    {{ $item->nama }}
                                </a>
                            @endforeach
                            <a href="/semua-wisata" class="text-primary ms-auto text-decoration-none fw-semibold">
                                Lihat Semua Wisata <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        
                </div>
            </div>
            <div class="swiper swiperCard my-4" style="height: 24rem">
                <div class="swiper-wrapper">
                    @foreach ($wisata as $item)
                        <div class="swiper-slide swiper-card">
                            <div class=" position-relative">
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
                                    <i
                                        class="bi fs-6 fw-bold {{ Auth::check() && Auth::user()->favorites->contains($item->id) 
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
        </section>
        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="fw-bold text-dark mt-0 mb-3 mt-5">Yang Menarik di kunjungi</h2>
                    <p></p>
                </div>
            </div>
            <div class="swiper swiperCard " style="height: 24rem">
                <div class="swiper-wrapper">
                    @foreach ($wisata as $item)
                        <div class="swiper-slide swiper-card">
                            <div class=" position-relative">
                                @if ($item->gambar)
                                    @php
                                        $gambarPertama = json_decode($item->gambar)[0] ?? '';
                                    @endphp
                                    @if ($gambarPertama)
                                        <img src="{{ $gambarPertama }}" alt="Gambar" width="100"
                                            class="me-2 rounded-3" style="height: 230px">
                                    @endif
                                @endif
                                <button class="btn btn-light position-absolute top-0 end-0 mx-4 my-2 rounded-circle"
                                    style="z-index: 1;">
                                    <i class="bi bi-heart fs-6 fw-bold"></i>
                                </button>
                                <div class="mt-3">
                                    <a href="{{ route('detail', $item->id) }}" class="nav-link">
                                        <h6 class="fw-semibold text-start">{{ $loop->iteration }}. {{ $item->nama }}
                                        </h6>
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
        </section>

    </div>


@endsection
