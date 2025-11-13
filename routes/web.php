<?php

use Illuminate\Support\Facades\Route;




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
});




use App\Http\Controllers\PageController;

Route::get('/institusi', [PageController::class, 'institusi'])->name('institusi');
Route::get('/penempatan', [PageController::class, 'penempatan'])->name('penempatan');
Route::get('/interview', [PageController::class, 'interview'])->name('interview');
Route::get('/admin', [PageController::class, 'admin'])->name('admin');
Route::get('/admin/user', [PageController::class, 'adminUser'])->name('admin.user');
Route::get('/cabang', [PageController::class, 'cabang'])->name('cabang');

use App\Http\Controllers\CabangController;
use App\Http\Controllers\DashboardController;

Route::resource('cabang', CabangController::class);


use App\Http\Controllers\PendaftaranController;

Route::get('/pendaftaran/kandidat', [PendaftaranController::class, 'datacabang'])->name('pendaftaran.create');
Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/siswa', [PendaftaranController::class, 'DataKandidat'])->name('siswa.index');
Route::get('/siswa/{id}/edit', [PendaftaranController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [PendaftaranController::class, 'update'])->name('siswa.update');


// (Opsional untuk admin)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/kandidat', [DashboardController::class, 'DataKandidat'])->name('pendaftar');

Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
use App\Http\Controllers\DokumenController;

Route::get('/dokumen/{id}', [DokumenController::class, 'show'])->name('dokumen.show');
