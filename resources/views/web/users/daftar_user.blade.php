@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800">Daftar User</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus"></i> Tambah User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-primary">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isEmpty()) 
                                <tr>
                                    <td colspan="9" class="text-center">Belum Ada Data</td>
                                </tr>
                        @else
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>
                                        <span class="badge-status {{ $user->status_user === 'Aktif' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $user->status_user }}
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit dan Hapus -->
                                        @if ($user->role !== 'Owner')
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> <!-- Icon edit -->
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" class="form-delete">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-delete" type="button" data-id="{{ $user->id}}" title="Hapus">
                                                <i class="fas fa-trash-alt"></i> <!-- Icon Hapus -->
                                            </button>
                                        </form>
                                        @endif
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
                text: "User yang dihapus tidak bisa dikembalikan!",
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