<div class="modal fade" id="editModal{{ $wisata->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $wisata->id }}" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $wisata->id }}">Edit Wisata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $wisata->nama }}">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $wisata->deskripsi }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori:</label>
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ $wisata->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket_masuk">Harga Tiket Masuk:</label>
                                <input type="text" class="form-control" id="harga_tiket_masuk" name="harga_tiket_masuk" value="{{ $wisata->harga_tiket_masuk }}">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar:</label>
                                <input type="file" class="form-control" id="gambar{{ $wisata->id }}" name="gambar[]" multiple onchange="previewImages({{ $wisata->id }})">
                            </div>
                            <div class="form-group">
                                <label for="preview">Preview:</label>
                                <div id="preview{{ $wisata->id }}">
                                    @if ($wisata->gambar)
                                        @foreach (json_decode($wisata->gambar) as $gambar)
                                            <img src="{{ $gambar }}" alt="Gambar" width="100" class="me-2">
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_buka">Jam Buka:</label>
                                <input type="time" class="form-control" id="jam_buka" name="jam_buka" value="{{ $wisata->jam_buka }}">
                            </div>
                            <div class="form-group">
                                <label for="jam_tutup">Jam Tutup:</label>
                                <input type="time" class="form-control" id="jam_tutup" name="jam_tutup" value="{{ $wisata->jam_tutup }}">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude:</label>
                                <input type="text" class="form-control" id="longitude" name="longitude" value="{{ $wisata->longitude }}">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" name="latitude" value="{{ $wisata->latitude }}">
                            </div>
                        </div>
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

<script>
function previewImages(id) {
    var preview = document.querySelector('#preview' + id);
    preview.innerHTML = '';
    var input = document.querySelector('#gambar' + id);

    if (input.files) {
        [].forEach.call(input.files, readAndPreview);
    }

    function readAndPreview(file) {


        var reader = new FileReader();

        reader.addEventListener("load", function() {
            var image = new Image();
            image.height = 100;
            image.title = file.name;
            image.src = this.result;
            preview.appendChild(image);
        });

        reader.readAsDataURL(file);
    }
}

document.querySelector('#gambar{{ $wisata->id }}').addEventListener("change", function() {
    previewImages({{ $wisata->id }});
});
</script>
