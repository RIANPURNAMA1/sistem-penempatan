<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;


Route::middleware('guest')->group(function () {
    Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'register'])->name('registrasi.post');
    Route::get('/register/activate/{id}', [AuthController::class, 'activate'])->name('registrasi.activate');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/lupa/password', [AuthController::class, 'showLupaPassword'])->name('lupa.password');
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');

    
// Proses reset password
Route::post('/lupa/password', [AuthController::class, 'resetPassword'])->name('reset.submit');


/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH)
|--------------------------------------------------------------------------
*/


use App\Http\Controllers\DashboardController;

Route::middleware(['auth', 'role:super admin, admin cianjur selatan,admin cianjur, kandidat'])->group(function () {

});
Route::middleware('auth')->get('/', [DashboardController::class, 'index'])->name('dashboard');














use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});

/*
|--------------------------------------------------------------------------
| PAGE NAVIGATION (AUTH)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\PageController;

Route::middleware(['auth', 'role:super admin'])->group(function () {
    Route::middleware('auth')->get('/kandidat', [DashboardController::class, 'DataKandidat'])->name('pendaftar');
    Route::get('/institusi', [PageController::class, 'institusi'])->name('page.institusi');
    Route::get('/penempatan', [PageController::class, 'penempatan'])->name('page.penempatan');
    Route::get('/interview', [PageController::class, 'interview'])->name('page.interview');
    Route::get('/cabang', [PageController::class, 'cabang'])->name('page.cabang');
});

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKandidatController;

// Route::middleware(['auth', 'role:admin cianjur selatan,admin cianjur'])->group(function () {
// Route::get('/dashboard/kandidat/{id}', [DashboardController::class, 'showKandidat'])->name('dashboard.kandidat.show');
// });
// Resource route untuk manajemen admin (CRUD) hanya bisa diakses SUPER ADMIN
Route::prefix('admin')
    ->name('admins.')
    ->middleware('role:super admin, admin cianjur, admin cianjur selatan')
    ->group(function () {
        Route::get('/dashboard/kandidat/{id}', [DashboardController::class, 'showKandidat'])->name('dashboard.kandidat.show');
        Route::get('/', [AdminController::class, 'index'])->name('index');       // List admin
        Route::get('/create', [AdminController::class, 'create'])->name('create'); // Form tambah admin
        Route::post('/', [AdminController::class, 'store'])->name('store');       // Simpan admin baru
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit'); // Form edit admin
        Route::put('/{admin}', [AdminController::class, 'update'])->name('update');  // Update admin
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy'); // Hapus admin
    });




    Route::middleware(['auth'])->group(function () {
    Route::get('/admin/kandidat', [AdminKandidatController::class, 'index'])
        ->name('admin.kandidat.index');
});


/*
|--------------------------------------------------------------------------
| CABANG (AUTH)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\CabangController;

Route::middleware(['auth', 'role:super admin'])
    ->resource('cabang', CabangController::class);



use App\Http\Controllers\PendaftaranController;


Route::middleware(['auth', 'role:super admin'])->group(function () {
    // Data siswa + paginate
    Route::get('/siswa', [PendaftaranController::class, 'DataKandidat'])
        ->name('siswa.index');

    // Edit & update data
    Route::get('/siswa/{id}/edit', [PendaftaranController::class, 'edit'])
        ->name('siswa.edit');

    Route::put('/siswa/{id}', [PendaftaranController::class, 'update'])
        ->name('siswa.update');
});


/*
|--------------------------------------------------------------------------
| PENDAFTARAN KANDIDAT
|--------------------------------------------------------------------------
*/

// Proses ganti password
use App\Http\Controllers\Auth\ForgotPasswordController;
Route::post('/lupa-password', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');
Route::get('/lupa-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request');

// Kirim email reset password
Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

use App\Http\Controllers\DokumenController;
Route::middleware(['auth', 'role:kandidat'])->group(function () {




    // Form pendaftaran
    Route::get('/pendaftaran/kandidat', [PendaftaranController::class, 'datacabang'])
        ->name('pendaftaran.create');

    // Simpan data
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');


    // Detail pendaftaran
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])
    ->name('pendaftaran.show');
    /*
    |--------------------------------------------------------------------------
    | DOKUMEN KANDIDAT
    |--------------------------------------------------------------------------
    */
    
    
    Route::middleware('auth')->get('/dokumen/{id}', [DokumenController::class, 'show'])
        ->name('dokumen.show');
});






/*
|--------------------------------------------------------------------------
| INSTITUSI (PERUSAHAAN)
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\InstitusiController;

Route::middleware(['auth', 'role: super admin'])->prefix('institusi')->name('institusi.')->group(function () {
    Route::get('/', [InstitusiController::class, 'index'])->name('index');
    Route::get('/create', [InstitusiController::class, 'create'])->name('create');
    Route::post('/store', [InstitusiController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [InstitusiController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [InstitusiController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [InstitusiController::class, 'destroy'])->name('destroy');
});



/*
|--------------------------------------------------------------------------
| KANDIDAT
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\KandidatController;

Route::middleware(['auth','role:super admin, admin cianjur pamoyanan, admin cianjur selatan'])->group(function () {

    // Data kandidat
    Route::get('/kandidat/data', [KandidatController::class, 'index'])->name('kandidat.data');

    // Edit/update kandidat
    Route::prefix('kandidat')->group(function () {
        Route::get('/{id}/edit', [KandidatController::class, 'edit'])->name('kandidat.edit');
        Route::put('/{id}', [KandidatController::class, 'update'])->name('kandidat.update');
    });

    // History kandidat
    Route::get('/kandidat/{id}/history', [KandidatController::class, 'history'])
        ->name('kandidat.history');
});
