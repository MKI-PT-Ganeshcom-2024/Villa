<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PenugasanStaffController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'checkStatus',
])->group(function () {

    route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', function () {
        return view('web.profile.show');
    })->name('profile.show');


    // Routing untuk manajemen kamar
    Route::resource('kamar', KamarController::class)->middleware('role:Superadmin,Owner,Admin');
    // Route::post('kamar/{id_kamar}/remove-photo', [KamarController::class, 'removePhoto'])->name('kamar.removePhoto');

    // Routing untuk manajemen kamar
    Route::resource('fasilitas', FasilitasController::class)->middleware('role:Superadmin,Owner,Admin');

    // Routing untuk manajemen users
    Route::resource('users', UserController::class)->middleware('role:Superadmin,Owner,Admin');

    // Routing untuk manajemen layanan
    Route::resource('layanan', LayananController::class);

    // Routing untuk penugasan staff
    Route::resource('penugasan_staff', PenugasanStaffController::class);

});



