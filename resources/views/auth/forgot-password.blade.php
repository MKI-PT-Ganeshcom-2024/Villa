<x-guest-layout>
    <div class="d-lg-flex half">
        <!-- Gambar di Sebelah Kiri -->
        <div class="bg" style="background-image: url('{{ asset('login-form/images/bedroom.jpg') }}');"></div>

        <!-- Form Forgot Password di Sebelah Kanan -->
        <div class="contents d-flex justify-content-center align-items-center">
            <div class="container reset-container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3 style="color: #007bff">Forgot Password <strong>Villa Sanur</strong></h3>
                        <p class="mb-4">{{ __('Lupa kata sandi Anda? Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami 
                        akan mengirimkan email berisi tautan pengaturan ulang kata sandi yang memungkinkan Anda memilih yang baru.') }}</p>

                        @session('status')
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endsession

                        <x-validation-errors class="mb-4" />

                        <!-- Form Forgot Password -->
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group">
                                <x-label for="email" value="{{ __('Email') }}" />
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button>
                                    {{ __('Email Password Reset Link') }}
                                </x-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

<!-- Import CSS -->
<link rel="stylesheet" href="{{ asset('login-form/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('login-form/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('login-form/css/custom.css') }}">

<!-- Import JS -->
<script src="{{ asset('login-form/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('login-form/js/popper.min.js') }}"></script>
<script src="{{ asset('login-form/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('login-form/js/main.js') }}"></script>
