@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar User</h1>
    <h2 class="h6 mb-2">
        <span class="text-primary">
            @if (Route::is('users.create'))
                <a href="{{ route('users.index') }}" class="text-primary">Manajemen Users</a> -> 
                <a href="{{ route('users.create') }}" class="text-primary">Tambah User</a>
            @elseif (Route::is('users.edit'))
                <a href="{{ route('users.index') }}" class="text-primary">Manajemen Users</a> -> 
                <a href="{{ route('users.edit', $user->id) }}" class="text-primary">Edit User</a>
            @else
                <a href="{{ route('users.index') }}" class="text-primary">Manajemen Users</a>
            @endif
        </span>
    </h2>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Jabatan</th>
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
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
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