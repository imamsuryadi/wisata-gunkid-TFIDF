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
                    <span>Jelajahi</span>
                    <h2 class="fw-bold text-dark mt-0 mb-4">Gunung Kidul</h2>
                    <p class="text-small ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, voluptate natus,
                        obcaecati accusantium odit esse aperiam architecto ipsa velit incidunt consectetur rem provident
                        expedita reiciendis molestias quidem sequi, enim soluta qui explicabo veniam assumenda corrupti!
                        Inventore quo porro laboriosam perspiciatis!</p>
                </div>
            </div>
        </section>

        {{-- LIST WISATA --}}

        <section class="my-5">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h2 class="fw-bold text-dark mt-0 mb-3 mt-5">Paling Banyak Dikunjungi</h2>
                    <p class="text-small mb-3 ">Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, voluptate
                        natus,
                        obcaecati accusantium odit esse aperiam architecto ipsa velit incidunt consectetur rem provident
                        expedita reiciendis molestias quidem sequi, enim soluta qui explicabo veniam assumenda corrupti!
                        Inventore quo porro laboriosam perspiciatis!</p>
                    <div class="d-flex gap-2 mt-3">

                        @foreach ($kategori as $item)
                            <span class="kategori-btn fw-semibold px-4 btn btn-outline-dark rounded-5 text-sm"
                                data-kategori-id="{{ $item->id }}">
                                {{ $item->nama }}
                            </span>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="swiper swiperCard my-4" style="height: 24rem">
                <div class="swiper-wrapper">
                    @foreach ($wisata as $item)
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
                    <h2 class="fw-bold text-dark mt-0 mb-3 mt-5">Paling Sepi Nih Boss</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique, neque.</p>
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
        </section>

    </div>


@endsection
