@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
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
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="invalid-feedback">Nama tidak boleh kosong.</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="invalid-feedback">Email tidak valid.</div>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-user-tag"></i></span>
                        <select class="form-control" id="role" name="role" required>
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Resepsionis" {{ $user->role == 'Resepsionis' ? 'selected' : '' }}>Resepsionis</option>
                            <option value="Staff" {{ $user->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">Silakan pilih role.</div>
                </div>
                <div class="mb-3" id="jabatan-field">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-briefcase"></i></span>
                        <select class="form-control" id="jabatan" name="jabatan">
                            <option value="">Pilih Jabatan</option>
                            <option value="Koki" {{ $user->jabatan == 'Koki' ? 'selected' : '' }}>Koki</option>
                            <option value="Room Service" {{ $user->jabatan == 'Room Service' ? 'selected' : '' }}>Room Service</option>
                            <option value="Waiter" {{ $user->jabatan == 'Waiter' ? 'selected' : '' }}>Waiter</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="status_user" class="form-label">Status User</label>
                    <div class="form-switch-toggle">
                        <input type="hidden" name="status_user" id="status_user_hidden" value="{{ $user->status_user }}">
                        <input type="checkbox" id="status_user_switch" class="switch-toggle" {{ $user->status_user == 'Aktif' ? 'checked' : '' }}>
                        <label for="status_user_switch" class="switch-label"></label>
                        <span id="status_text">{{ $user->status_user == 'Aktif' ? 'Aktif' : 'Nonaktif' }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger ms-3"><i class="fas fa-times-circle"></i> Batal</a>
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
            timer: 3000,
            showConfirmButton: false
        });
    </script>
@endif

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

    document.getElementById('status_user_switch').addEventListener('change', function() {
        const statusText = document.getElementById('status_text');
        const hiddenInput = document.getElementById('status_user_hidden');
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
