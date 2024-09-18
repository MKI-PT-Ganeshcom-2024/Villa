@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>
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
</div>
<div class="container-fluid">
    <br>
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                <option value="Resepsionis" {{ $user->role == 'Resepsionis' ? 'selected' : '' }}>Resepsionis</option>
            </select>
        </div>
        <div class="mb-3" id="jabatan-field">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-control" id="jabatan" name="jabatan">
                <option value="">Pilih Jabatan</option>
                <option value="Koki" {{ $user->jabatan == 'Koki' ? 'selected' : '' }}>Koki</option>
                <option value="Room Service" {{ $user->jabatan == 'Room Service' ? 'selected' : '' }}>Room Service</option>
                <option value="Waiter" {{ $user->jabatan == 'Waiter' ? 'selected' : '' }}>Waiter</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleField = document.getElementById('role');
        const jabatanField = document.getElementById('jabatan-field');

        function toggleJabatanField() {
            if (roleField.value !== 'Staff') {
                jabatanField.style.display = 'none'; // Sembunyikan field jabatan
            } else {
                jabatanField.style.display = 'block'; // Tampilkan field jabatan
            }
        }

        // Panggil fungsi saat halaman dimuat
        toggleJabatanField();

        // Tambahkan event listener untuk memantau perubahan pada dropdown role
        roleField.addEventListener('change', toggleJabatanField);
    });
</script>
@endsection
