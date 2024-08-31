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
                    <p class="card-text">{{ $artikel->konten }}</p>
                    <a href="/" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
