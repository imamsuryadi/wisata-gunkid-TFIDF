@extends('layouts.dashboard')

@section('title', 'Sewa Motor')

@section('content')
<div class="card shadow border-0">
    <div class="card-body">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Sewa Kendaraan</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Wisata</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sewaMotors as $sewaMotor)
                <tr>
                    <td>{{ $sewaMotor->nama }}</td>
                    <td>{{ $sewaMotor->deskripsi }}</td>
                    <td><a href="{{ $sewaMotor->lokasi }}" target="_blank">Lihat Lokasi</a></td>
                    <td>{{ $sewaMotor->wisata->nama }}</td>
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $sewaMotor->id }}">Edit</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $sewaMotor->id }}">Hapus</button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal{{ $sewaMotor->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $sewaMotor->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $sewaMotor->id }}">Edit Sewa Motor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('sewaMotor.update', $sewaMotor->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nama">Nama:</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $sewaMotor->nama }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lokasi">Lokasi (URL):</label>
                                        <input type="url" class="form-control" id="lokasi" name="lokasi" value="{{ $sewaMotor->lokasi }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="deskripsi">deskripsi:</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="{{ $sewaMotor->deskripsi }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="wisata_id">Wisata:</label>
                                        <select class="form-control" id="wisata_id" name="wisata_id" required>
                                            @foreach ($wisatas as $wisata)
                                            <option value="{{ $wisata->id }}" {{ $sewaMotor->wisata_id == $wisata->id ? 'selected' : '' }}>{{ $wisata->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $sewaMotor->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $sewaMotor->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel{{ $sewaMotor->id }}">Hapus Sewa Motor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus Sewa Motor "{{ $sewaMotor->nama }}"?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('sewaMotor.destroy', $sewaMotor->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
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
                <h5 class="modal-title" id="createModalLabel">Tambah Sewa Motor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('sewaMotor.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama:</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi (URL):</label>
                        <input type="url" class="form-control" id="lokasi" name="lokasi" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">deskripsi :</label>
                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="wisata_id">Wisata:</label>
                        <select class="form-control" id="wisata_id" name="wisata_id" required>
                            @foreach ($wisatas as $wisata)
                            <option value="{{ $wisata->id }}">{{ $wisata->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
