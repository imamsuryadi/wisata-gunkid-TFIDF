@extends('layouts.homepage')

@section('title', $artikel->judul)

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-4">
                @if ($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top" alt="Gambar Artikel" style="object-fit: cover; height: 400px;">
                @endif
                <div class="card-body shadow-lg p-4">
                    <h1 class="card-title mb-4">{{ $artikel->judul }}</h1>
                    <div class="artikel-konten">
                        <p class="card-text">{!! nl2br(e($artikel->konten)) !!}</p>
                    </div>
                    <a href="/" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Styling untuk konten artikel */
    .artikel-konten {
        font-family: 'Arial', sans-serif;
        font-size: 1.1rem;
        line-height: 1.8;
        text-align: justify; /* Agar teks rata kanan kiri */
        margin-left: 20px; /* Memberikan margin kiri untuk efek geser ke kanan */
        margin-right: 20px; /* Memberikan margin kanan untuk membuat teks tidak terlalu mepet */
    }

    /* Styling untuk setiap paragraf dalam artikel */
    .artikel-konten p {
        margin-bottom: 1.5rem; /* Memberikan jarak antar paragraf */
        text-indent: 30px;
        text-align: justify; /* Memberikan indentasi pada awal paragraf agar terlihat lebih rapi */
    }

    /* Styling gambar yang ada di dalam artikel */
    .artikel-konten img {
        max-width: 100%;
        height: auto;
        margin: 20px 0; /* Memberikan margin pada gambar */
        display: block;
        border-radius: 5px; /* Membuat sudut gambar lebih halus */
    }

    /* Menambahkan sedikit padding di bagian bawah untuk tombol kembali */
    .btn-secondary {
        margin-top: 20px;
    }
</style>
@endpush
