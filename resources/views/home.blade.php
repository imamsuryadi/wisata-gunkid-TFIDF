@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('judul', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-primary rounded-3 shadow-lg">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Wisatawan</h5>
                    <p class="card-text display-4">{{ $jumlahWisatawan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-success rounded-3 shadow-lg">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Wisata</h5>
                    <p class="card-text display-4">{{ $jumlahWisata }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-info rounded-3 shadow-lg">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Kategori</h5>
                    <p class="card-text display-4">{{ $jumlahKategori }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card text-white bg-warning rounded-3 shadow-lg">
                <div class="card-body text-center">
                    <h5 class="card-title">Jumlah Artikel</h5>
                    <p class="card-text display-4">{{ $jumlahArtikel }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-12">
            <h2 class="mb-4">Grafik Jumlah Wisatawan</h2>
            <canvas id="grafikWisatawan"></canvas>
        </div>
    </div> --}}
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('grafikWisatawan').getContext('2d');
    var grafikWisatawan = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json(array_keys($dataGrafik)),
            datasets: [{
                label: 'Jumlah Wisatawan',
                data: @json(array_values($dataGrafik)),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: true,
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
    