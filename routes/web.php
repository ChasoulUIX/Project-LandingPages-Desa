<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cms\CmsKegiatanController;
use App\Http\Controllers\Cms\CmsBeritaController;
use App\Http\Controllers\Cms\CmsProdukController;
use App\Http\Controllers\User\KeteranganDomisiliController;
// Auth
// ... existing code ...

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ... existing code ...
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])
    ->middleware('guest');

//ladningpages
// Pages
Route::get('/', function () {
    return view('user.app.dashboard');
});
Route::get('/layanan', function () {
    return view('user.pages.layanan');
});
Route::get('/berita', function () {
    return view('user.pages.berita');
});
Route::get('/galery', function () {
    return view('user.pages.galery');
});
Route::get('/kontak', function () {
    return view('user.pages.kontak');
});
Route::get('/produk', function () {
    return view('user.pages.produk');
});
Route::get('/aboutdesa', function () {
    return view('user.pages.aboutdesa');
});

// Struktural
Route::get('/pamongdesa', function () {
    return view('user.pages.pamongdesa');
});

// Layanan
Route::get('/keterangan', function () {
    return view('user.pages.layanan.keterangan');
});
Route::get('/pengaduan', function () {
    return view('user.pages.layanan.pengaduan');
});
Route::get('/informasidesa', function () {
    return view('user.pages.layanan.informasidesa');
});
Route::get('/datakependudukan', function () {
    return view('user.pages.layanan.datakependudukan');
});
Route::get('/bantuansosial', function () {
    return view('user.pages.layanan.bantuansosial');
});
Route::get('/danadesa', function () {
    return view('user.pages.layanan.danadesa');
});

//layanan surat keterangan
Route::get('/suratketerangan/domisili', function () {
    return view('user.pages.layanan.suratketerangan.domisili');
});
Route::post('/suratketerangan/domisili', [KeteranganDomisiliController::class, 'store'])->name('domicili.store');
Route::get('/suratketerangan/domisili', [KeteranganDomisiliController::class, 'create'])->name('user.domisili.layanan.suratketerangan.domisili');

Route::get('/suratketerangan/tidakmampu', function () {
    return view('user.pages.layanan.suratketerangan.tidakmampu');
});
Route::get('/suratketerangan/usaha', function () {
    return view('user.pages.layanan.suratketerangan.usaha');
});
Route::get('/suratketerangan/ktp', function () {
    return view('user.pages.layanan.suratketerangan.ktp');
});
Route::get('/suratketerangan/kelahiran', function () {
    return view('user.pages.layanan.suratketerangan.kelahiran');
});
Route::get('/suratketerangan/kematian', function () {
    return view('user.pages.layanan.suratketerangan.kematian');
});

// Route untuk mengambil gambar dari public/images
Route::get('/images/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
});

//cms
Route::get('/cms/app/dashboard', function () {
    return view('cms.app.dashboard');
});

Route::get('/cms/kegiatan', function () {
    return view('cms.pages.kegiatan');
});

//pages
Route::resource('cms/kegiatan', CmsKegiatanController::class);

Route::prefix('cms')->group(function () {
    Route::resource('berita', CmsBeritaController::class);
});

Route::resource('cms/produk', CmsProdukController::class);

Route::get('/cms/suratketerangan/domisili', function () {
    return view('cms.pages.suratketerangan.domisili');
});