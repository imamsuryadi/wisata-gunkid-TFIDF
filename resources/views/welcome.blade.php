@extends('layouts.homepage')

@section('content')
    <div class="container py-5">
        {{-- BANNER --}}
        <section>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper" style="height: 28rem">
                    <div class="swiper-slide" style="height: 28rem">
                        <img style="height: 28rem"
                            src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
                            alt="">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/1430677/pexels-photo-1430677.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
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
                        <span class="fw-semibold px-4 btn btn-outline-dark rounded-5 text-sm">
                            <i class="bi bi-geo-alt"></i> Pantai
                        </span>
                        <span class="fw-semibold px-4 btn btn-outline-dark rounded-5">
                            <i class="bi bi-geo-alt"></i> Gunung
                        </span>
                        <span class="fw-semibold px-4 btn btn-outline-dark rounded-5">
                            <i class="bi bi-water"></i> Air Terjun
                        </span>
                    </div>

                </div>
            </div>
            <div class="swiper swiperCard my-4" style="height: 24rem">
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
                                    <a href="/detailWisata" class="nav-link"><h6 class="fw-semibold text-start">1. Pantai Indrayanti</h6></a>
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
        </section>

    </div>
@endsection
