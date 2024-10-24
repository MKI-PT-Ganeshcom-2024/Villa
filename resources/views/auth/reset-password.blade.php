<!doctype html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Import CSS -->
    <link rel="stylesheet" href="{{ asset('login-form/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('login-form/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('login-form/css/custom.css') }}">

    <title>Reset Password</title>

</head>
<body>

<div class="d-lg-flex half">
    <!-- Gambar di Sebelah Kiri -->
    <div class="bg order-2 order-md-1" style="background-image: url('{{ asset('login-form/images/bedroom.jpg') }}');"></div>
    
    <!-- Form Reset Password di Sebelah Kanan -->
    <div class="contents order-1 order-md-2 d-flex justify-content-center align-items-center">
        <div class="container reset-container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3 style="color: #007bff">Reset Password <strong>Villa Sanur</strong></h3>
                    <p class="mb-4">Masukkan email Anda dan kata sandi baru untuk mereset akun Anda.</p>

                    <!-- Form Reset Password -->
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Token Input -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <!-- Email Input -->
                        <div class="form-group first">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="your-email@gmail.com" value="{{ old('email', $request->email) }}" required autofocus>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group last mb-3">
                            <label for="password">Kata Sandi Baru</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="New Password" required>
                        </div>

                        <!-- Password Confirmation Input -->
                        <div class="form-group last mb-3">
                            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password" required>
                        </div>

                        <!-- Submit Button -->
                        <input type="submit" value="Reset Password" class="btn btn-primary btn-block">

                        <!-- Error Handling with SweetAlert -->
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import JS -->
<script src="{{ asset('login-form/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('login-form/js/popper.min.js') }}"></script>
<script src="{{ asset('login-form/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('login-form/js/main.js') }}"></script>
</body>
</html>
