@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')

<div class="container-fluid">

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">Daftar Kamar</h1>
            <a href="{{ route('kamar.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kamar</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-primary">
                        <tr>
                            <th>No.</th>
                            <th>Foto Kamar</th>
                            <th>Nomor Kamar</th>
                            <th>Tipe Kamar</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kamar->isEmpty()) 
                            <tr>
                                <td colspan="9" class="text-center">Belum Ada Data</td>
                            </tr>
                        @else
                            @foreach ($kamar as $index => $k)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($k->foto_kamar)
                                            <img src="{{ asset('uploads/kamar/' . $k->foto_kamar) }}" alt="Foto Kamar" width="200" height="200">
                                        @else
                                            <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $k->nomor_kamar }}</td>
                                    <td>{{ $k->tipe_kamar }}</td>
                                    <td>Rp {{ number_format($k->harga_kamar, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge-status {{ $k->status_kamar === 'Tersedia' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $k->status_kamar }}
                                        </span>
                                    </td>
                                    <td>{{ $k->kapasitas_kamar }}</td>
                                    <td>
                                        @foreach ($k->fasilitas as $f)
                                            <span>{{ $f->nama_fasilitas }}</span><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('kamar.edit', $k->id_kamar) }}" class="btn btn-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('kamar.destroy', $k->id_kamar) }}" method="POST" style="display:inline-block;" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-delete" type="button" data-id="{{ $k->id_kamar }}" title="Hapus">
                                                <i class="fas fa-trash-alt"></i> <!-- Icon Hapus -->
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
                text: "Kamar yang dihapus tidak bisa dikembalikan!",
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
