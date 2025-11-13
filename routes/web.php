<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("dashboard");
})->middleware(['auth'])->name('dashboard');


use App\Http\Controllers\AuthController;

// Halaman registrasi hanya untuk guest
Route::middleware('guest')->group(function () {
    Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'register'])->name('registrasi.post');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function() {
        return view('dashboard'); // Buat halaman dashboard
    })->name('dashboard');
});




use App\Http\Controllers\PageController;

Route::get('/pendaftaran/kandidat', [PageController::class, 'pendaftaranKandidat'])->name('pendaftaran.kandidat');
Route::get('/kandidat', [PageController::class, 'kandidat'])->name('kandidat');
Route::get('/institusi', [PageController::class, 'institusi'])->name('institusi');
Route::get('/penempatan', [PageController::class, 'penempatan'])->name('penempatan');
Route::get('/interview', [PageController::class, 'interview'])->name('interview');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');
Route::get('/admin/user', [PageController::class, 'adminUser'])->name('admin.user');