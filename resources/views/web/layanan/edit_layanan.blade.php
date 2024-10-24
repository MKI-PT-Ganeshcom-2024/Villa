@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    <h1 class="h3 mb-2 text-gray-800">Edit Layanan</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            <a href="{{ route('layanan.index') }}" class="text-primary">Layanan</a> -> 
            <a href="{{ route('layanan.edit', $layanan->id_layanan) }}" class="text-primary">Edit Layanan</a>
        </span>
    </h2>
</div>
<div class="container-fluid">
    <br>
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ route('layanan.update', $layanan->id_layanan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="kategori_layanan" class="form-label">Kategori Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-list"></i></span>
                            <input type="text" class="form-control" id="kategori_layanan" name="kategori_layanan" value="{{ $layanan->kategori_layanan }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nama_layanan" class="form-label">Nama Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control" id="nama_layanan" name="nama_layanan" value="{{ $layanan->nama_layanan }}" required>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="harga_layanan">Harga Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">Rp</span>
                        <input type="text" name="harga_layanan" id="harga_layanan" class="form-control" 
                               value="{{ old('harga_layanan', number_format($layanan->harga_layanan, 0, ',', '.')) }}" required
                               oninput="formatCurrency(this)">
                        <input type="hidden" name="harga_layanan_raw" id="harga_layanan_raw">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="deskripsi_layanan" class="form-label">Deskripsi Layanan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-align-left"></i></span>
                        <textarea class="form-control" id="deskripsi_layanan" name="deskripsi_layanan" rows="3">{{ $layanan->deskripsi_layanan }}</textarea>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status_layanan" class="form-label">Status Layanan</label>
                    <div class="form-switch-toggle">
                        <input type="hidden" name="status_layanan" id="status_layanan_hidden" value="{{ $layanan->status_layanan }}">
                        <input type="checkbox" id="status_layanan_switch" class="switch-toggle" {{ $layanan->status_layanan == 'Aktif' ? 'checked' : '' }}>
                        <label for="status_layanan_switch" class="switch-label"></label>
                        <span id="status_text">{{ $layanan->status_layanan == 'Aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
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
    // Fungsi untuk format input menjadi format IDR
    function formatCurrency(input) {
        let value = input.value.replace(/[^0-9]/g, ''); // Hapus semua karakter selain angka
        input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format angka dengan pemisah ribuan
    }

    // Fungsi untuk menyimpan nilai asli ke dalam input hidden saat submit
    document.querySelector('form').addEventListener('submit', function() {
        const hargaInput = document.getElementById('harga_layanan');
        const rawInput = document.getElementById('harga_layanan_raw');
        rawInput.value = hargaInput.value.replace(/[^0-9]/g, ''); // Simpan nilai tanpa pemisah ribuan
    });

    document.getElementById('status_layanan_switch').addEventListener('change', function() {
        const statusText = document.getElementById('status_text');
        const hiddenInput = document.getElementById('status_layanan_hidden');
        if (this.checked) {
            statusText.textContent = 'Aktif';
            hiddenInput.value = 'Aktif';
        } else {
            statusText.textContent = 'Nonaktif';
            hiddenInput.value = 'Nonaktif';
        }
    });
</script>
@endsection
