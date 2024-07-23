@extends('layouts.homepage')

@section('content')
    <div class="container py-5">
        <div class="row d-flex">

            @foreach ($wisata as $item)
            <div class="col-md-3">
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
                </div>
                @endforeach
        </div>
    </div>


@endsection
