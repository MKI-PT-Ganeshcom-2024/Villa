@extends($layout)
@section('content')
<div class="container-fluid">
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">Daftar Fasilitas</h1>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary shadow-sm rounded" data-toggle="modal" data-target="#tambahFasilitasModal">
                <i class="fas fa-plus"></i> Tambah Fasilitas
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-primary">
                        <tr>
                            <th>No.</th>
                            <th>Nama Fasilitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($fasilitas->isEmpty()) 
                            <tr>
                                <td colspan="3" class="text-center">Belum Ada Data</td>
                            </tr>
                        @else
                            @foreach ($fasilitas as $f)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $f->nama_fasilitas }}</td>
                                    <td>
                                        <!-- Button trigger modal for editing -->
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editFasilitasModal{{ $f->id_fasilitas }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Tombol Hapus dengan Icon -->
                                        <form action="{{ route('fasilitas.destroy', $f->id_fasilitas) }}" method="POST" style="display:inline-block;" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-delete" type="button" data-id="{{ $f->id_fasilitas }}" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @include('web.fasilitas.edit_fasilitas')

                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div> 
        </div>
    </div>
</div>
@include('web.fasilitas.tambah_fasilitas')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: '{{ session('success') }}',
        timer: 1500, // Tampilkan selama 1 detik
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
        timer: 1500, // Tampilkan selama 1 detik
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
                text: "Fasilitas yang dihapus tidak bisa dikembalikan!",
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
