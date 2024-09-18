@extends($layout) <!-- Menggunakan layout yang diteruskan dari controller -->
@section('content')
<div class="card-header py-3">
    <!-- Page Heading -->
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
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" required>
                <span class="input-group-text">
                    <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                </span>
            </div>
        </div>            
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="">Pilih Role</option>
                <option value="Staff">Staff</option>
                <option value="Resepsionis">Resepsionis</option>
            </select>
        </div>
        <div class="mb-3" id="jabatan-field">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-control" id="jabatan" name="jabatan">
                <option value="">Pilih Jabatan</option>
                <option value="Koki">Koki</option>
                <option value="Room Service">Room Service</option>
                <option value="Waiter">Waiter</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('users.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>

<!-- Tambahkan jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // Toggle tipe input antara password dan text
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Toggle ikon mata
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    });

    $(document).ready(function() {
        // Function to hide or show the 'jabatan' field based on role selection
        $('#role').on('change', function() {
            var selectedRole = $(this).val();
            if (selectedRole === 'Staff') {
                $('#jabatan-field').show(); // Tampilkan jika role adalah Staff
            } else {
                $('#jabatan-field').hide(); // Sembunyikan jika role bukan Staff
                $('#jabatan').val(''); // Kosongkan value pada field jabatan
            }
        });

        // Default: sembunyikan 'jabatan' field jika role bukan Staff
        var initialRole = $('#role').val();
        if (initialRole !== 'Staff') {
            $('#jabatan-field').hide();
        }
    });
</script>
@endsection
