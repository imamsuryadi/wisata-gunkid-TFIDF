@extends('layouts.homepage')

@section('title', 'Artikel')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Artikel</h1>
    
    <div class="row">
        @foreach ($artikels as $artikel)
        <div class="col-md-3 mb-4">
            <div class="card h-100">
                <div class="card-body  shadow-lg">
                @if ($artikel->gambar)
                <img src="{{ asset('storage/' . $artikel->gambar) }}" class="card-img-top" alt="Gambar Artikel" style="object-fit: cover; height: 180px;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $artikel->judul }}</h5>
                    <p class="card-text">{{ Str::limit($artikel->konten, 100) }}</p>
                    @if ($artikel->created_at->isToday())
                    @endif
                    <a href="{{ route('artikel.show', $artikel->id) }}" class="btn btn-primary mt-auto">Baca Selengkapnya</a>
                </div>
            </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
