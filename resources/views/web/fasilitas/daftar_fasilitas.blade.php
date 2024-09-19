@extends($layout)
@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Daftar Fasilitas</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahFasilitasModal">
                Tambah Fasilitas
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
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
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editFasilitasModal{{ $f->id_fasilitas }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('fasilitas.destroy', $f->id_fasilitas) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Hapus</button>
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

@endsection
