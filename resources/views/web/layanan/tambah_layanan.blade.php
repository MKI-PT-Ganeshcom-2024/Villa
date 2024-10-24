@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Layanan</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            @if (Route::is('layanan.create'))
                <a href="{{ route('layanan.index') }}" class="text-primary">Layanan</a> -> 
                <a href="{{ route('layanan.create') }}" class="text-primary">Tambah Layanan</a>
            @elseif (Route::is('layanan.edit'))
                <a href="{{ route('layanan.index') }}" class="text-primary">Layanan</a> -> 
                <a href="{{ route('layanan.edit', $layanan->id_layanan) }}" class="text-primary">Edit Layanan</a>
            @else
                <a href="{{ route('layanan.index') }}" class="text-primary">Layanan</a>
            @endif
        </span>
    </h2>
</div>
<div class="container-fluid">
    <br>
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ route('layanan.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kategori_layanan" class="form-label">Kategori Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-list"></i></span>
                            <input type="text" class="form-control" id="kategori_layanan" name="kategori_layanan" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_layanan">Harga Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">Rp</span>
                        <input type="text" name="harga_layanan" id="harga_layanan" class="form-control" onkeyup="formatRupiah(this);" required>
                        <input type="hidden" name="harga_layanan_raw" id="harga_layanan_raw" value="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_layanan" class="form-label">Deskripsi Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-align-left"></i></span>
                        <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" rows="3"></textarea>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
                    <a href="{{ route('layanan.index') }}" class="btn btn-danger ms-3"><i class="fas fa-times-circle"></i> Batal</a>
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
    // Fungsi untuk memformat input harga menjadi format IDR
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        let formattedValue = 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        input.value = formattedValue;

        // Simpan nilai mentah ke input tersembunyi
        document.getElementById('harga_layanan_raw').value = value; // Pastikan ini sesuai dengan id input tersembunyi
    }
</script>
@endsection
