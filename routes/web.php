<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\AuthController;



use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])
    ->name('socialite.redirect');

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])
    ->name('socialite.callback');

// Route::get('/cv', function () {
//     return view('cv.pdf');
// });
// Route::get('/cv2', function () {
//     return view('cv.pdf2');
// });

// Route::get('/cv/violeta', function () {
//     return view('cv.pdf1');
// });
Route::middleware('guest')->group(function () {
    Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'register'])->name('registrasi.post');
    Route::get('/register/activate/{id}', [AuthController::class, 'activate'])->name('registrasi.activate');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/lupa/password', [AuthController::class, 'showLupaPassword'])->name('lupa.password');
});

Route::middleware('auth')->post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/cv/export/pdf/{id}', [App\Http\Controllers\CvController::class, 'exportPdf'])
    ->name('cv.export.pdf');


// Proses reset password
Route::post('/lupa/password', [AuthController::class, 'resetPassword'])->name('reset.submit');


/*
|--------------------------------------------------------------------------
| DASHBOARD (AUTH)
|--------------------------------------------------------------------------
*/


use App\Http\Controllers\DashboardController;

Route::middleware([
    'auth',
    'role:super admin,kandidat,Cabang Cianjur Selatan Mendunia,Cabang Cianjur Pamoyanan Mendunia,Cabang Batam Mendunia,Cabang Banyuwangi Mendunia,Cabang Kendal Mendunia,Cabang Pati Mendunia,Cabang Tulung Agung Mendunia,Cabang Bangkalan Mendunia,Cabang Bojonegoro Mendunia,Cabang Jember Mendunia,Cabang Wonosobo Mendunia,Cabang Eshan Mendunia'
])->group(function () {
    // Semua route di sini bisa diakses oleh semua role
    Route::middleware('auth')->get('/', [DashboardController::class, 'index'])->name('dashboard');
});



















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
    ->middleware('auth', 'role:super admin,Cabang Cianjur Selatan Mendunia,Cabang Cianjur Pamoyanan Mendunia,Cabang Batam Mendunia,Cabang Banyuwangi Mendunia,Cabang Kendal Mendunia,Cabang Pati Mendunia,Cabang Tulung Agung Mendunia,Cabang Bangkalan Mendunia,Cabang Bojonegoro Mendunia,Cabang Jember Mendunia,Cabang Wonosobo Mendunia,Cabang Eshan Mendunia')
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
use App\Http\Controllers\CvController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\PendaftaranController;

Route::middleware(['auth', 'role:super admin'])
    ->resource('cabang', CabangController::class);
// routes/web.php
Route::post('/pendaftaran/import', [PendaftaranController::class, 'import'])->name('pendaftaran.import');
Route::get('/pendaftaran/export', [PendaftaranController::class, 'export'])->name('pendaftaran.export');
Route::get('pendaftaran/{id}/edit-full', [PendaftaranController::class, 'editFull'])->name('pendaftaran.edit.full');
Route::put('pendaftaran/{id}/update-full', [PendaftaranController::class, 'updateFull'])->name('pendaftaran.update.full');
Route::delete('/pendaftaran/{id}', [App\Http\Controllers\PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
Route::get('/pendaftaran/{id}/pendaftar', [PendaftaranController::class, 'showPendaftar'])->name('show.Pendaftar');



Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])
    ->name('pendaftaran.destroy');
Route::middleware(['auth', 'role:super admin'])->group(function () {

    Route::get('/pendaftaran/export', [PendaftaranController::class, 'export'])->name('pendaftaran.export');
    // routes/web.php
    Route::get('/kandidat/export/{id}', [KandidatController::class, 'export'])->name('kandidat.export');

    Route::get('/pendaftaran/export-pdf', [PendaftaranController::class, 'exportPDF'])->name('pendaftaran.export.pdf');


    // Data siswa + paginate
    Route::get('/siswa', [PendaftaranController::class, 'DataKandidat'])
        ->name('siswa.index');

    // Edit & update data
    Route::get('/siswa/{id}/edit', [PendaftaranController::class, 'edit'])
        ->name('siswa.edit');

    Route::put('/siswa/{id}', [PendaftaranController::class, 'update'])
        ->name('siswa.update');
    Route::get('/data/cv/kandidat', [CvController::class, 'index']);
});
Route::get('/cv/export-word/{id}', [CvController::class, 'exportWord'])->name('cv.export.word');


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





Route::middleware('auth')->group(function () {
    Route::get('/pendaftaran/cv', [CvController::class, 'create'])->name('pendaftaran.cv.create');
    Route::get('/data/pendaftaran/cv', [CvController::class, 'create']);
});

Route::middleware('auth')->group(function () {
    Route::post('/pendaftaran/cv', [CvController::class, 'store'])->name('pendaftaran.cv.store');
});
Route::middleware(['auth', 'role:kandidat'])->group(function () {



    // Menampilkan form edit CV
    Route::get('/pendaftaran/cv/{id}/edit', [CvController::class, 'edit'])->name('pendaftaran.cv.edit');

    // Menyimpan atau update CV
    Route::post('/pendaftaran/cv', [CvController::class, 'store'])->name('pendaftaran.cv.store');


    // Update CV
    Route::put('/pendaftaran/cv/{id}', [CvController::class, 'update'])->name('pendaftaran.cv.update')->middleware(['auth', 'role:kandidat']);
    // Menghapus CV
    Route::delete('/pendaftaran/cv/{id}', [CvController::class, 'destroy'])->name('pendaftaran.cv.destroy');
});

Route::middleware(['auth', 'role:kandidat'])->group(function () {
    Route::get('/api/cv', [CVController::class, 'index']);


    // Form pendaftaran
    Route::get('/pendaftaran/kandidat', [PendaftaranController::class, 'datacabang'])
        ->name('pendaftaran.create');

    // Simpan data
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');


    // Detail pendaftaran
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])
        ->name('pendaftaran.show');




    Route::middleware('auth')->get('/dokumen/{id}', [DokumenController::class, 'show'])
        ->name('dokumen.show');

    Route::get('/cv/export/{id}', [CvController::class, 'export'])->name('cv.export');
});

    /*
    |--------------------------------------------------------------------------
    | DOKUMEN KANDIDAT
    |--------------------------------------------------------------------------
    */
    // Route ini memerlukan ID Kandidat sebagai parameter
    Route::get('/kandidat/{id}/riwayat', [KandidatController::class, 'showHistory'])
        ->name('kandidat.riwayat');


Route::middleware('auth')->group(function () {

    Route::get('/cv/show/{id}', [CvController::class, 'show'])->name('cv.show');
    Route::get('/cv/show/pdf/{id}', [CvController::class, 'showPdf'])->name('cv.show.pdf');
    Route::get('/cv/show/pdf/violeta/{id}', [CvController::class, 'showPdfVioleta'])->name('cv.show.pdf.violeta');
});

// cv controller





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

Route::middleware([
    'auth',
    'role:super admin,kandidat,Cabang Cianjur Selatan Mendunia,Cabang Cianjur Pamoyanan Mendunia,Cabang Batam Mendunia,Cabang Banyuwangi Mendunia,Cabang Kendal Mendunia,Cabang Pati Mendunia,Cabang Tulung Agung Mendunia,Cabang Bangkalan Mendunia,Cabang Bojonegoro Mendunia,Cabang Jember Mendunia,Cabang Wonosobo Mendunia,Cabang Eshan Mendunia'
])->group(function () {
    // Semua route di sini bisa diakses oleh semua role
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
