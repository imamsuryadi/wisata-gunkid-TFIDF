<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Tambah Wisata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('wisata.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori:</label>
                                <select class="form-control" id="kategori_id" name="kategori_id">
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket_masuk">Harga Tiket Masuk:</label>
                                <input type="text" class="form-control" id="harga_tiket_masuk" name="harga_tiket_masuk">
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar:</label>
                                <input type="file" class="form-control" id="gambar" name="gambar[]" multiple onchange="previewImages()">
                            </div>
                            <div class="form-group">
                                <label for="preview">Preview:</label>
                                <div id="preview"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jam_buka">Jam Buka:</label>
                                <input type="time" class="form-control" id="jam_buka" name="jam_buka">
                            </div>
                            <div class="form-group">
                                <label for="jam_tutup">Jam Tutup:</label>
                                <input type="time" class="form-control" id="jam_tutup" name="jam_tutup">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude:</label>
                                <input type="text" class="form-control" id="longitude" name="longitude">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Latitude:</label>
                                <input type="text" class="form-control" id="latitude" name="latitude">
                            </div>
                        </div>
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

<script>
function previewImages() {
    var preview = document.querySelector('#preview');
    preview.innerHTML = '';
    if (this.files) {
        [].forEach.call(this.files, readAndPreview);
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

document.querySelector('#gambar').addEventListener("change", previewImages);
</script>
