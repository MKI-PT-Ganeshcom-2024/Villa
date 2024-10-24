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

    <title>Login</title>

</head>
<body>
  
<div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('login-form/images/bedroom.jpg') }}');"></div>
    <div class="contents order-2 order-md-1 d-flex justify-content-center align-items-center">
        <div class="container login-container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-7">
                    <h3 style="color: #007bff">Login ke <strong>Villa Sanur</strong></h3>
                    <p class="mb-4">Silakan login dengan memasukkan alamat email dan kata sandi Anda.</p>

                    <!-- Form Login -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Input -->
                        <div class="form-group first">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="your-email@gmail.com" value="{{ old('email') }}" required autofocus>
                        </div>

                        <!-- Password Input -->
                        <div class="form-group last mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Your Password" required>
                        </div>

                        <!-- Remember Me Checkbox -->
                        <div class="d-flex mb-5 align-items-center justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="remember" id="remember_me">
                                <label class="form-check-label" for="remember_me">
                                    Remember me
                                </label>
                            </div>
                            <span class="ms-auto">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password</a>
                                @endif
                            </span> 
                        </div>

                        <!-- Submit Button -->
                        <input type="submit" value="Log In" class="btn btn-primary btn-block">

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
