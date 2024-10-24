@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="container-fluid">
     <!-- Page Heading -->
     <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">Daftar Layanan</h1>
            <a href="{{ route('layanan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Layanan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-primary">
                        <tr>
                            <th>No.</th>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($layanan as $layanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $layanan->kategori_layanan }}</td>
                                <td>{{ $layanan->nama_layanan }}</td>
                                <td>{{ 'Rp ' . number_format($layanan->harga_layanan, 0, ',', '.') }}</td>
                                <td>{{ $layanan->deskripsi_layanan }}</td>
                                <td>
                                    <span class="badge-status {{ $layanan->status_layanan === 'Aktif' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $layanan->status_layanan }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('layanan.edit', $layanan->id_layanan) }}" class="btn btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('layanan.destroy', $layanan->id_layanan) }}" method="POST" style="display:inline-block;" class="form-delete">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-delete" type="button" data-id="{{ $layanan->id_layanan }}" title="Hapus">
                                            <i class="fas fa-trash-alt"></i> <!-- Icon Hapus -->
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 1500, 
        showConfirmButton: false
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal',
        text: '{{ session('error') }}',
        timer: 1500, 
        showConfirmButton: false
    });
</script>
@endif

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const fasilitasId = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Layanan yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            })
        });
    });
</script>
@endsection
