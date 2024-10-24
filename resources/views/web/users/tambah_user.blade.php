@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    <h1 class="h3 mb-2 text-gray-800">Tambah User</h1>
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
            <form action="{{ route('users.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="invalid-feedback">Nama tidak boleh kosong.</div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white""><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="invalid-feedback">Email tidak valid.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white""><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <span class="input-group-text bg-primary text-white"">
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </span>
                    </div>
                    <div class="invalid-feedback">Password tidak boleh kosong.</div>
                </div>    
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white""><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <span class="input-group-text bg-primary text-white"">
                            <i class="fa fa-eye" id="togglePasswordConfirm" style="cursor: pointer;"></i>
                        </span>
                    </div>
                    <div class="invalid-feedback">Konfirmasi password tidak boleh kosong.</div>
                </div>   
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white""><i class="fas fa-user-tag"></i></span>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin">Admin</option>
                            <option value="Staff">Staff</option>
                            <option value="Resepsionis">Resepsionis</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">Silakan pilih role.</div>
                </div>
                <div class="mb-3" id="jabatan-field">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white""><i class="fas fa-briefcase"></i></span>
                        <select class="form-control" id="jabatan" name="jabatan">
                            <option value="">Pilih Jabatan</option>
                            <option value="Koki">Koki</option>
                            <option value="Room Service">Room Service</option>
                            <option value="Waiter">Waiter</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    $(document).ready(function() {
        $('#role').on('change', function() {
            var selectedRole = $(this).val();
            if (selectedRole === 'Staff') {
                $('#jabatan-field').show();
            } else {
                $('#jabatan-field').hide();
                $('#jabatan').val('');
            }
        });

        var initialRole = $('#role').val();
        if (initialRole !== 'Staff') {
            $('#jabatan-field').hide();
        }
    });
</script>
@endsection
