@extends('layouts.dashboard')

@section('title', 'Artikel')

@section('judul', 'Artikel')

@section('content')
<div class="card shadow border-0">
    <div class="card-body">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Artikel</button>
        <table class="table table-bordered mt-4" id="datatable">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Konten</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artikels as $artikel)
                <tr>
                    <td>{{ $artikel->judul }}</td>
                    <td>{{ $artikel->konten }}</td>
                    <td>
                        @if ($artikel->gambar)
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" width="100">
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $artikel->id }}">Edit</button>
                        <form action="{{ route('artikels.destroy', $artikel->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $artikel->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $artikel->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $artikel->id }}">Edit Artikel</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('artikels.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="judul">Judul:</label>
                                        <input type="text" class="form-control" id="judul" name="judul" value="{{ $artikel->judul }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="konten">Konten:</label>
                                        <textarea class="form-control" id="konten" name="konten">{{ $artikel->konten }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">Gambar:</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar">
                                        @if ($artikel->gambar)
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="Gambar Artikel" width="100" class="mt-2">
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Artikel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('artikels.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul:</label>
                        <input type="text" class="form-control" id="judul" name="judul">
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten:</label>
                        <textarea class="form-control" id="konten" name="konten"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="gambar">Gambar:</label>
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
