<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\UserController;
use App\Models\Fasilitas;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/profile', function () {
        return view('web.profile.show');
    })->name('profile.show');


    // Routing untuk manajemen kamar
    Route::resource('kamar', KamarController::class);
    Route::post('kamar/{id_kamar}/remove-photo', [KamarController::class, 'removePhoto'])->name('kamar.removePhoto');

    // Routing untuk manajemen kamar
    Route::resource('fasilitas', FasilitasController::class);

    // Routing untuk manajemen users
    Route::resource('users', UserController::class);

});

route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');


