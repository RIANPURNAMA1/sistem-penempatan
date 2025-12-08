<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminKandidatController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\InstitusiController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Configuration & Utility Imports (Dihapus karena tidak digunakan di Route)
|--------------------------------------------------------------------------
|
| Import seperti Laravel\Socialite\Facades\Socialite, App\Models\User,
| dan Illuminate\Support\Facades\Auth tidak diperlukan dalam file web.php.
| Mereka lebih tepat berada di dalam Controller.
|
*/

// Mendefinisikan role untuk pengelompokan yang lebih bersih
$admin_roles = 'super-admin,Cabang Cianjur Selatan Mendunia,Cabang Cianjur Pamoyanan Mendunia,Cabang Batam Mendunia,Cabang Banyuwangi Mendunia,Cabang Kendal Mendunia,Cabang Pati Mendunia,Cabang Tulung Agung Mendunia,Cabang Bangkalan Mendunia,Cabang Bojonegoro Mendunia,Cabang Jember Mendunia,Cabang Wonosobo Mendunia,Cabang Eshan Mendunia';


Route::get('/generate', function () {
    Artisan::call('storage:link');
    return 'Storage link berhasil dibuat!';
});
/*
|--------------------------------------------------------------------------
| AUTHENTICATION & LOGIN/LOGOUT
|--------------------------------------------------------------------------
*/

// Rute untuk pengguna yang BELUM login (Guest)
Route::middleware('guest')->group(function () {
    // Registrasi
    Route::get('/registrasi', [AuthController::class, 'showRegister'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'register'])->name('registrasi.post');
    Route::get('/register/activate/{id}', [AuthController::class, 'activate'])->name('registrasi.activate');

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Lupa Password (Show Form)
    Route::get('/lupa/password', [AuthController::class, 'showLupaPassword'])->name('lupa.password');

    // Reset Password - Menggunakan ForgotPasswordController
    Route::get('/lupa-password', [ForgotPasswordController::class, 'showForgotForm'])->name('password.request'); // Show form
    Route::post('/lupa-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');   // Kirim link reset
});

// Proses Reset Password (Submit form)
Route::post('/lupa/password', [AuthController::class, 'resetPassword'])->name('reset.submit');

// Rute untuk Login Sosial (Google)
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('socialite.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('socialite.callback');

// Rute untuk pengguna yang SUDAH login
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD & PROFILE
|--------------------------------------------------------------------------
*/

// Dashboard Utama (Akses oleh Semua Role yang didefinisikan)
Route::middleware(['auth', "role:kandidat,$admin_roles"])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile Pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});


/*
|--------------------------------------------------------------------------
| KANDIDAT & PENDAFTARAN (Role: Kandidat)
|--------------------------------------------------------------------------
*/



Route::middleware(['auth', 'role:kandidat'])->group(function () {
    // Form Pendaftaran Kandidat
    Route::get('/pendaftaran/kandidat', [PendaftaranController::class, 'datacabang'])->name('pendaftaran.create');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

    // Detail Pendaftaran
    Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');

    // Dokumen
    Route::get('/dokumen/{id}', [DokumenController::class, 'show'])->name('dokumen.show');

    // CV (Curriculum Vitae) - CRUD
    Route::get('/api/cv', [CVController::class, 'index']); // API untuk CV?
    Route::get('/pendaftaran/cv/{id}/edit', [CvController::class, 'edit'])->name('pendaftaran.cv.edit');

    Route::post('/pendaftaran/cv', [CvController::class, 'store'])->name('pendaftaran.cv.store');
    Route::put('/pendaftaran/cv/{id}', [CvController::class, 'update'])->name('pendaftaran.cv.update');
    Route::delete('/pendaftaran/cv/{id}', [CvController::class, 'destroy'])->name('pendaftaran.cv.destroy');
    Route::get('/pendaftaran/cv/kandidat', [CvController::class, 'create'])->name('pendaftaran.cv.create');
});


// Route::get('/pendaftaran/cv/kandidat', [CvController::class, 'cvCreate'])->name('pendaftaran.cv.kandidat');
// Route::get('/data/pendaftaran/cv', [CvController::class, 'create']);
// CV (Akses Umum untuk Form CV - tidak spesifik kandidat, tapi perlu auth)
Route::middleware('auth')->group(function () {
    // Membuat CV

    // Melihat CV (Show)
    Route::get('/cv/show/{id}', [CvController::class, 'show'])->name('cv.show');
    Route::get('/cv/show/pdf/{id}', [CvController::class, 'showPdf'])->name('cv.show.pdf');
    Route::get('/cv/show/pdf/violeta/{id}', [CvController::class, 'showPdfVioleta'])->name('cv.show.pdf.violeta');
    Route::get('/cv/show/pdf/pdf_nawasena/{id}', [CvController::class, 'showPdfNawasena'])->name('cv.show.pdf.nawasena');
    Route::get('/cv/show/pdf/pdf_yambo/{id}', [CvController::class, 'showPdfYambo'])->name('cv.show.pdf.yambo');
    Route::get('/cv/show/pdf/pdf_madoka/{id}', [CvController::class, 'showPdfMadoka'])->name('cv.show.pdf.madoka');
    Route::get('/cv/show/pdf/pdf_mendunia/{id}', [CvController::class, 'showPdfMendunia'])->name('cv.show.pdf.mendunia');
});


/*
|--------------------------------------------------------------------------
| ADMINISTRATOR & SUPER ADMIN ROUTES
|--------------------------------------------------------------------------
*/

// Rute yang dapat diakses oleh SEMUA ROLE ADMIN
Route::middleware(['auth', "role:$admin_roles"])->group(function () {
    // Data Kandidat
    Route::get('/kandidat/data', [KandidatController::class, 'index'])->name('kandidat.data');

    // Edit/Update Kandidat
    Route::prefix('kandidat')->group(function () {
        Route::get('/{id}/edit', [KandidatController::class, 'edit'])->name('kandidat.edit');
        Route::put('/{id}', [KandidatController::class, 'update'])->name('kandidat.update');
    });

    // History Kandidat
    Route::get('/kandidat/{id}/history', [KandidatController::class, 'history'])->name('kandidat.history');
    Route::get('/admin/kandidat', [AdminKandidatController::class, 'index'])->name('admin.kandidat.index');
    Route::get('/admin/dashboard/kandidat/{id}', [DashboardController::class, 'showKandidat'])->name('admins.dashboard.kandidat.show');
});


// Rute Khusus SUPER ADMIN
Route::middleware(['auth', 'role:super-admin'])->group(function () {

    // update
    Route::put('/cv/update-kandidat/{id}', [CvController::class, 'updatecvkandidat'])
        ->name('cv.updatekandidat');

    // edit all cv
    Route::get('/edit/cv/kandidat/{id}', [CvController::class, 'editcvkandidat']);
    // Navigasi Halaman Admin
    Route::get('/kandidat', [DashboardController::class, 'DataKandidat'])->name('pendaftar');
    Route::get('/institusi', [PageController::class, 'institusi'])->name('page.institusi');
    Route::get('/penempatan', [PageController::class, 'penempatan'])->name('page.penempatan');
    Route::get('/interview', [PageController::class, 'interview'])->name('page.interview');
    Route::get('/cabang', [PageController::class, 'cabang'])->name('page.cabang');

    // Manajemen Cabang (Resource)
    Route::resource('cabang', CabangController::class);

    // Pengelolaan Siswa/Pendaftaran (Khusus Super Admin)
    Route::get('/siswa', [PendaftaranController::class, 'DataKandidat'])->name('siswa.index');
    Route::get('/siswa/{id}/edit', [PendaftaranController::class, 'edit'])->name('siswa.edit');
    Route::put('/siswa/{id}', [PendaftaranController::class, 'update'])->name('siswa.update');
    Route::get('/data/cv/kandidat', [CvController::class, 'index']);
    Route::post('/pendaftaran/{id}/update-full', [PendaftaranController::class, 'updateFull'])
        ->name('pendaftaran.update.full');

    // CRUD Institusi (Perusahaan)
    Route::prefix('institusi')->name('institusi.')->group(function () {
        Route::get('/', [InstitusiController::class, 'index'])->name('index');
        Route::get('/create', [InstitusiController::class, 'create'])->name('create');
        Route::post('/store', [InstitusiController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [InstitusiController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [InstitusiController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [InstitusiController::class, 'destroy'])->name('destroy');
    });

    // Admin Management (CRUD Admin)
    Route::prefix('admin')->name('admins.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');       // List admin
        Route::get('/create', [AdminController::class, 'create'])->name('create'); // Form tambah admin
        Route::post('/', [AdminController::class, 'store'])->name('store');       // Simpan admin baru
        Route::get('/{admin}/edit', [AdminController::class, 'edit'])->name('edit'); // Form edit admin
        Route::put('/{admin}', [AdminController::class, 'update'])->name('update');  // Update admin
        Route::delete('/{admin}', [AdminController::class, 'destroy'])->name('destroy'); // Hapus admin
    });
});


/*
|--------------------------------------------------------------------------
| IMPORT & EXPORT DATA
|--------------------------------------------------------------------------
*/

// Export CV (Word, PDF)
Route::get('/cv/export/pdf/{id}', [CvController::class, 'exportPdf'])->name('cv.export.pdf');
Route::get('/cv/export-word/{id}', [CvController::class, 'exportWord'])->name('cv.export.word');
Route::get('/cv/export/{id}', [CvController::class, 'export'])->name('cv.export');


// Rute Pendaftaran - Import/Export/Edit Full (Untuk Admin)
Route::get('pendaftaran/{id}/edit-full', [PendaftaranController::class, 'editFull'])->name('pendaftaran.edit.full');
Route::put('pendaftaran/{id}/update-full', [PendaftaranController::class, 'updateFull'])->name('pendaftaran.update.full');
Route::delete('/pendaftaran/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
Route::get('/pendaftaran/{id}/pendaftar', [PendaftaranController::class, 'showPendaftar'])->name('show.Pendaftar');


Route::middleware(['auth', 'role:super-admin'])->group(function () {
    // Export Pendaftaran (Khusus Super Admin)
    Route::get('/kandidat/export/{id}', [KandidatController::class, 'export'])->name('kandidat.export');
    Route::post('/pendaftaran/import', [PendaftaranController::class, 'import'])->name('pendaftaran.import');
    Route::get('/pendaftaran/export/exels', [PendaftaranController::class, 'export']);
    Route::get('/pendaftaran/export-pdf', [PendaftaranController::class, 'exportPDF'])->name('pendaftaran.export.pdf');
});
