<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Cms\CmsKegiatanController;
use App\Http\Controllers\Cms\CmsBeritaController;
use App\Http\Controllers\Cms\CmsProdukController;
use App\Http\Controllers\User\KeteranganDomisiliController;
use App\Http\Controllers\User\TidakMampuController;
use App\Http\Controllers\User\SuratKeteranganUsahaController;
use App\Http\Controllers\User\SuratKtpController;
use App\Http\Controllers\User\SuratKelahiranController;
use App\Http\Controllers\User\PengaduanController;
use App\Http\Controllers\Cms\StrukturDesaController;
use App\Http\Controllers\Cms\StrukturController;
use App\Http\Controllers\Cms\KependudukanController;
use App\Http\Controllers\Cms\DanaDesaController;
use App\Http\Controllers\Cms\SambutanController;
use App\Http\Controllers\Cms\CmsPengaduanController;
use App\Http\Controllers\Cms\CmsSuratTidakMampuController;
use App\Http\Controllers\Cms\CmsSuratUsahaController;
use App\Http\Controllers\Cms\CmsSuratKtpController;
use App\Http\Controllers\Cms\CmsSuratKelahiranController;
use App\Http\Controllers\Cms\ProfileDesaController;
use App\Http\Controllers\Cms\CmsAktifitasController;
use App\Http\Controllers\Cms\ProfileController;

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
Route::get('/surat-tidak-mampu', [TidakMampuController::class, 'index'])->name('surat-tidak-mampu.index');
Route::post('/surat-tidak-mampu', [TidakMampuController::class, 'store'])->name('surat-tidak-mampu.store');
Route::put('/surat-tidak-mampu/{id}/update-status', [TidakMampuController::class, 'updateStatus'])->name('cms.tidak-mampu.update-status');

Route::get('/suratketerangan/usaha', function () {
    return view('user.pages.layanan.suratketerangan.usaha');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/surat-usaha', [SuratKeteranganUsahaController::class, 'index'])->name('surat-usaha.index');
    Route::post('/surat-usaha', [SuratKeteranganUsahaController::class, 'store'])->name('surat-usaha.store');
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

//pages
Route::get('/cms/kegiatan', function () {
    return view('cms.pages.kegiatan');
});
Route::resource('cms/kegiatan', CmsKegiatanController::class);

Route::prefix('cms')->group(function () {
    Route::resource('berita', CmsBeritaController::class);
});

Route::resource('cms/produk', CmsProdukController::class);

Route::get('/cms/suratketerangan/domisili', function () {
    return view('cms.pages.suratketerangan.domisili');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/domisili', [KeteranganDomisiliController::class, 'index'])->name('cms.domisili.index');
    Route::put('/domisili/{id}/update-status', [KeteranganDomisiliController::class, 'updateStatus'])->name('cms.domisili.update-status');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/suratketerangan/tidakmampu', function () {
        return view('cms.pages.suratketerangan.tidakmampu');
    });
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/suratketerangan/usaha', [CmsSuratUsahaController::class, 'index'])->name('cms.usaha.index');
    Route::put('/suratketerangan/usaha/{id}/update-status', [CmsSuratUsahaController::class, 'updateStatus'])
        ->name('cms.usaha.update-status');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('surat-ktp', SuratKtpController::class);
});

Route::middleware(['auth'])->group(function () {
    Route::resource('surat-kelahiran', SuratKelahiranController::class);
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    // Surat Keterangan KTP routes
    Route::get('/suratketerangan/ktp', [CmsSuratKtpController::class, 'index'])->name('cms.ktp.index');
    Route::put('/suratketerangan/ktp/{id}/update-status', [CmsSuratKtpController::class, 'updateStatus'])
        ->name('cms.ktp.update-status');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    // Surat Keterangan Kelahiran routes
    Route::get('/suratketerangan/kelahiran', [CmsSuratKelahiranController::class, 'index'])->name('cms.kelahiran.index');
    Route::put('/suratketerangan/kelahiran/{id}/update-status', [CmsSuratKelahiranController::class, 'updateStatus'])
        ->name('cms.kelahiran.update-status');
});

Route::get('/layanan/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/layanan/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');


// CMS Struktur Desa Routes
Route::prefix('cms')->middleware(['auth'])->group(function () {
    // Struktur Desa Routes
    Route::get('/strukturdesa', [StrukturController::class, 'index'])->name('cms.strukturdesa.index');
    Route::post('/strukturdesa', [StrukturController::class, 'store'])->name('cms.strukturdesa.store');
    Route::get('/strukturdesa/{struktur}/edit', [StrukturController::class, 'edit'])->name('cms.strukturdesa.edit');
    Route::put('/strukturdesa/{struktur}', [StrukturController::class, 'update'])->name('cms.strukturdesa.update');
    Route::delete('/strukturdesa/{struktur}', [StrukturController::class, 'destroy'])->name('cms.strukturdesa.destroy');
});

Route::resource('struktur', StrukturController::class);

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/pengaduan', [CmsPengaduanController::class, 'index'])->name('cms.pengaduan.index');
    Route::get('/pengaduan/{id}/edit', [CmsPengaduanController::class, 'edit'])->name('cms.pengaduan.edit');
    Route::put('/pengaduan/{id}', [CmsPengaduanController::class, 'update'])->name('cms.pengaduan.update');
});

Route::get('/cms/app/kependudukan', function () {
    return view('cms.pages.kependudukan');
});

Route::prefix('cms')->name('cms.')->middleware(['auth'])->group(function () {
    Route::resource('kependudukan', KependudukanController::class);
    Route::get('/kependudukan/{nik}/edit', [KependudukanController::class, 'edit'])
        ->name('kependudukan.edit');
});

Route::get('/cms/dana', function () {
    return view('cms.pages.dana');
});

Route::prefix('cms')->middleware(['auth'])->group(function () {
    Route::controller(DanaDesaController::class)->group(function () {
        Route::get('/dana', 'index')->name('dana.index');
        Route::get('/dana/create', 'create')->name('dana.create');
        Route::post('/dana', 'store')->name('dana.store');
        Route::get('/dana/{id}/edit', 'edit')->name('dana.edit');
        Route::put('/dana/{id}', 'update')->name('dana.update');
        Route::delete('/dana/{id}', 'destroy')->name('dana.destroy');
    });
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/sambutan', [SambutanController::class, 'index'])->name('cms.sambutan.index');
    Route::get('/sambutan/{id}/edit', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::put('/sambutan/{id}', [SambutanController::class, 'update'])->name('sambutan.update');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/tidak-mampu', [CmsSuratTidakMampuController::class, 'index'])->name('cms.tidakmampu.index');
    Route::put('/tidak-mampu/{id}/update-status', [CmsSuratTidakMampuController::class, 'updateStatus'])
        ->name('cms.tidakmampu.update-status');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/profile-desa', [ProfileDesaController::class, 'index'])->name('cms.profile-desa.index');
    Route::post('/profile-desa', [ProfileDesaController::class, 'store'])->name('cms.profile-desa.store');
    Route::put('/cms/profiledesa/update', [ProfileDesaController::class, 'update'])->name('cms.profiledesa.update');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/aktifitas', [CmsAktifitasController::class, 'index'])->name('cms.aktifitasdesa.index');
    Route::post('/aktifitas', [CmsAktifitasController::class, 'store'])->name('cms.aktifitasdesa.store');
    Route::get('/aktifitas/{id}/edit', [CmsAktifitasController::class, 'edit'])->name('cms.aktifitasdesa.edit');
    Route::put('/aktifitas/{id}', [CmsAktifitasController::class, 'update'])->name('cms.aktifitasdesa.update');
    Route::delete('/aktifitas/{id}', [CmsAktifitasController::class, 'destroy'])->name('cms.aktifitasdesa.destroy');
});

Route::get('/cms/editprofile', function () {
    return view('cms.pages.editprofile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
