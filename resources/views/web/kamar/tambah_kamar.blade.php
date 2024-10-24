@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
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
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nomor Kamar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-door-open"></i></span>
                                <input type="text" name="nomor_kamar" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Tipe Kamar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-bed"></i></span>
                                <input type="text" name="tipe_kamar" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">Rp</span>
                                <input type="text" name="harga_kamar" class="form-control" id="harga_kamar" required oninput="formatRupiah(this)">
                                <input type="hidden" name="harga_kamar_raw" id="harga_kamar_raw">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kapasitas Kamar</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="fas fa-user-friends"></i></span>
                                <input type="number" name="kapasitas_kamar" class="form-control" required>
                            </div>
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
        
                        <!-- Tempat menampilkan preview gambar atau gambar default -->
                        <div class="form-group">
                            <img id="imagePreview" src="{{ asset('img/camera.png') }}" alt="Preview Foto" style="max-width: 45%; height: auto;" />
                        </div>
        
                        <!-- Tombol Hapus Foto -->
                        <button type="button" class="btn btn-danger" id="hapusFoto" style="display: none;" onclick="removeImage()">Hapus Foto</button>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('kamar.index') }}" class="btn btn-danger ms-3"><i class="fas fa-times-circle"></i> Batal</a>
                </div> 
            </form>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '{{ $errors->first() }}',
            timer: 3000, // Tampilkan selama 3 detik
            showConfirmButton: false
        });
    </script>
@endif

<script>
    // Fungsi untuk memformat input harga menjadi format IDR tanpa 'Rp'
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        let formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Hapus 'Rp '
        input.value = formattedValue;

        // Simpan nilai mentah ke input tersembunyi
        document.getElementById('harga_kamar_raw').value = value;
    }

    // Fungsi untuk menampilkan preview gambar
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function(){
            var imagePreview = document.getElementById('imagePreview');
            imagePreview.src = reader.result;
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
        
        // Mengembalikan gambar default
        imagePreview.src = "{{ asset('img/camera.png') }}";
        document.getElementById('hapusFoto').style.display = 'none'; // Sembunyikan tombol hapus
    }
</script>
@endsection
