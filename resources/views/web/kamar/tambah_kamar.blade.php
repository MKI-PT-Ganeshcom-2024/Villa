@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    {{-- <a href="{{ route('kamar.create') }}" class="btn btn-primary">Tambah Kamar</a> --}}
    <h1 class="h3 mb-2 text-gray-800">Tambah Kamar</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            @if (Route::is('kamar.create'))
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a> -> 
                <a href="{{ route('kamar.create') }}" class="text-primary">Tambah Kamar</a>
            @elseif (Route::is('kamar.edit'))
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a> -> 
                <a href="{{ route('kamar.edit', $kamar->id_kamar) }}" class="text-primary">Edit Kamar</a>
            @else
                <a href="{{ route('kamar.index') }}" class="text-primary">Manajemen Kamar</a>
            @endif
        </span>
    </h2>
</div>
<div class="container-fluid">
    <br>
    <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nomor Kamar</label>
                    <input type="text" name="nomor_kamar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Tipe Kamar</label>
                    <input type="text" name="tipe_kamar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" name="harga_kamar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status_kamar" class="form-control" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Booked">Booked</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kapasitas Kamar</label>
                    <input type="number" name="kapasitas_kamar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Fasilitas</label><br>
                    @foreach ($fasilitas as $f)
                        <div class="form-check">
                            <input type="checkbox" name="id_fasilitas[]" value="{{ $f->id_fasilitas }}" class="form-check-input">
                            <label class="form-check-label">{{ $f->nama_fasilitas }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-md-6">
                <!-- Input Foto Kamar dengan Preview -->
                <div class="form-group">
                    <label>Foto Kamar</label>
                    <input type="file" id="foto_kamar" name="foto_kamar" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                </div>

                <!-- Tempat menampilkan preview gambar -->
                <div class="form-group">
                    <img id="imagePreview" src="#" alt="Preview Foto" style="display: none; max-width: 100%; height: auto;" />
                </div>

                <!-- Tombol Hapus Foto -->
                <button type="button" class="btn btn-danger" id="hapusFoto" style="display: none;" onclick="removeImage()">Hapus Foto</button>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kamar.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
<script>
    // Fungsi untuk menampilkan preview gambar
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block'; // Menampilkan gambar preview
            document.getElementById('hapusFoto').style.display = 'inline-block'; // Menampilkan tombol hapus
        };

        if(input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]); // Membaca data gambar sebagai URL
        }
    }

    // Fungsi untuk menghapus gambar yang dipilih
    function removeImage() {
        var imagePreview = document.getElementById('imagePreview');
        var fotoKamarInput = document.getElementById('foto_kamar');

        // Reset nilai input file
        fotoKamarInput.value = ''; 
        
        // Sembunyikan preview dan tombol hapus
        imagePreview.style.display = 'none';
        document.getElementById('hapusFoto').style.display = 'none';
    }
</script>
@endsection
