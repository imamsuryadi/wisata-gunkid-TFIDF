@extends('layouts.dashboard')

@section('title', 'Wisata')

@section('judul', 'Wisata')

@section('content')
<div class="card shadow border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Form for Filtering by Category (aligned to the left) -->
            <form method="GET" action="{{ route('wisata.index') }}" class="d-flex">
                <div class="input-group">
                    <select id="kategori" name="kategori_id" class="form-select" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ (isset($kategoriId) && $kategoriId == $kategori->id) ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- "Tambah Wisata" Button (aligned to the right) -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Wisata
            </button>
        </div>
        <table class="table table-bordered mt-4" id="datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga Tiket Masuk</th>
                    <th>Jam Buka</th>
                    <th>Jam Tutup</th>
                    <th>Lokasi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($wisatas as $wisata)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $wisata->nama }}</td>
                        <td>
                            <span class="badge text-white" style="background-color: {{ $wisata->kategori->warna }}">
                                {{ $wisata->kategori->nama }}
                            </span>
                        </td>
                        <td><span class="fw-semibold text-danger" style="font-weight: 900">{{ $wisata->formatted_harga_tiket_masuk }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($wisata->jam_buka)->format('H:i') }} WIB</td>
                        <td>{{ \Carbon\Carbon::parse($wisata->jam_tutup)->format('H:i') }} WIB</td>
                        <td>
                            <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}"
                                target="_blank" class="text-decoration-none text-primary">Lihat di Google Maps</a>
                        </td>
                        <td>
                            @if ($wisata->gambar)
                                @foreach (json_decode($wisata->gambar) as $gambar)
                                    <img src="{{ $gambar }}" alt="Gambar" width="100" class="me-2">
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#showModal{{ $wisata->id }}">Detail</button>
                                <button type="button" class="btn btn-warning mx-1" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $wisata->id }}">Edit</button>
                                <form action="{{ route('wisata.destroy', $wisata->id) }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('admin.wisata.create')

@foreach ($wisatas as $wisata)
    @include('admin.wisata.edit', ['wisata' => $wisata])
    @include('admin.wisata.show', ['wisata' => $wisata])
@endforeach

@endsection
