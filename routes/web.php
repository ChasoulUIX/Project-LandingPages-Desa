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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Cms\DanaController;
use App\Http\Controllers\Cms\CmsDomisiliController;
use App\Http\Controllers\Cms\StrukturProfileController;
use App\Http\Controllers\Cms\CmsHeroSliderController;
use Illuminate\Support\Facades\Auth;

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
Route::prefix('cms')->middleware(['auth:web,struktur'])->name('cms.')->group(function () {
    // Kegiatan Routes
    Route::get('/kegiatan', [CmsKegiatanController::class, 'index'])->name('kegiatan.index');
    Route::post('/kegiatan', [CmsKegiatanController::class, 'store'])->name('kegiatan.store');
    Route::get('/kegiatan/{id}/edit', [CmsKegiatanController::class, 'edit'])->name('kegiatan.edit');
    Route::put('/kegiatan/{id}', [CmsKegiatanController::class, 'update'])->name('kegiatan.update');
    Route::delete('/kegiatan/{id}', [CmsKegiatanController::class, 'destroy'])->name('kegiatan.destroy');
});

Route::prefix('cms')->name('cms.')->group(function () {
    Route::post('/berita', [CmsBeritaController::class, 'store'])->name('berita.store');
});

Route::prefix('cms')->middleware(['auth:web,struktur'])->group(function () {
    // Produk Routes
    Route::get('/produk', [CmsProdukController::class, 'index'])->name('cms.produk.index');
    Route::post('/produk', [CmsProdukController::class, 'store'])->name('cms.produk.store');
    Route::get('/produk/{id}/edit', [CmsProdukController::class, 'edit'])->name('cms.produk.edit');
    Route::put('/produk/{id}', [CmsProdukController::class, 'update'])->name('cms.produk.update');
    Route::delete('/produk/{id}', [CmsProdukController::class, 'destroy'])->name('cms.produk.destroy');
});

Route::get('/cms/suratketerangan/domisili', [CmsDomisiliController::class, 'index'])->name('suratketerangan.domisili');
Route::put('/cms/suratketerangan/domisili/{id}/status', [CmsDomisiliController::class, 'updateStatus'])->name('suratketerangan.domisili.update-status');


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
    // Route untuk surat KTP
    Route::get('/suratketerangan/ktp', [CmsSuratKtpController::class, 'ktp'])
        ->name('suratketerangan.ktp');

    Route::put('/suratketerangan/ktp/{id}/update-status', [CmsSuratKtpController::class, 'updateStatus'])
        ->name('cms.ktp.update-status');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    // Route untuk surat kelahiran
    Route::get('/suratketerangan/kelahiran', [CmsSuratKelahiranController::class, 'kelahiran'])
        ->name('suratketerangan.kelahiran');

    Route::put('/suratketerangan/kelahiran/{id}/update-status', [CmsSuratKelahiranController::class, 'updateStatus'])
        ->name('cms.kelahiran.update-status');
});

Route::get('/layanan/pengaduan', [PengaduanController::class, 'index'])->name('layanan.pengaduan');
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
    // Route untuk halaman pengaduan
    Route::get('/pengaduan', [CmsPengaduanController::class, 'index'])->name('cms.pengaduan.index');
    Route::get('/pengaduan/{id}/edit', [CmsPengaduanController::class, 'edit'])->name('cms.pengaduan.edit');
    Route::put('/pengaduan/{id}', [CmsPengaduanController::class, 'update'])->name('cms.pengaduan.update');
});

Route::get('/cms/app/kependudukan', function () {
    return view('cms.pages.kependudukan');
});

Route::middleware(['auth:web,struktur'])->prefix('cms')->name('cms.')->group(function () {
    Route::resource('kependudukan', KependudukanController::class);
    Route::get('/kependudukan/{nik}/edit', [KependudukanController::class, 'edit'])
        ->name('kependudukan.edit');
    Route::delete('/cms/app/kependudukan/{nik}', [KependudukanController::class, 'destroy'])
        ->name('cms.kependudukan.destroy');
});

Route::get('/cms/dana', function () {
    return view('cms.pages.dana');
});

Route::middleware(['auth:web,struktur'])->prefix('cms')->group(function () {
    Route::controller(DanaDesaController::class)->group(function () {
        Route::get('/dana', 'index')->name('dana.index');
        Route::get('/dana/create', 'create')->name('dana.create');
        Route::post('/dana', 'store')->name('dana.store');
        Route::get('/dana/{id}/edit', 'edit')->name('dana.edit');
        Route::put('/dana/{id}', 'update')->name('dana.update');
        Route::delete('/dana/{id}', 'destroy')->name('dana.destroy');
    });
});

Route::middleware(['auth:web,struktur'])->prefix('cms')->group(function () {
    Route::get('/sambutan', [SambutanController::class, 'index'])->name('cms.sambutan.index');
    Route::get('/sambutan/{id}/edit', [SambutanController::class, 'edit'])->name('sambutan.edit');
    Route::put('/sambutan/{id}', [SambutanController::class, 'update'])->name('sambutan.update');
});

Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/tidak-mampu', [CmsSuratTidakMampuController::class, 'index'])->name('cms.tidakmampu.index');
    Route::put('/tidak-mampu/{id}/update-status', [CmsSuratTidakMampuController::class, 'updateStatus'])
        ->name('cms.tidakmampu.update-status');
});

Route::middleware(['auth:web,struktur'])->prefix('cms')->group(function () {
    Route::get('/profile-desa', [ProfileDesaController::class, 'index'])->name('cms.profile-desa.index');
    Route::post('/profile-desa', [ProfileDesaController::class, 'store'])->name('cms.profile-desa.store');
    Route::put('/cms/profiledesa/update', [ProfileDesaController::class, 'update'])->name('cms.profiledesa.update');
});

Route::middleware(['auth:web,struktur'])->prefix('cms')->group(function () {
    Route::get('/aktifitas', [CmsAktifitasController::class, 'index'])->name('cms.aktifitasdesa.index');
    Route::post('/aktifitas', [CmsAktifitasController::class, 'store'])->name('cms.aktifitasdesa.store');
    Route::get('/aktifitas/{id}/edit', [CmsAktifitasController::class, 'edit'])->name('cms.aktifitasdesa.edit');
    Route::put('/aktifitas/{id}', [CmsAktifitasController::class, 'update'])->name('cms.aktifitasdesa.update');
    Route::delete('/aktifitas/{id}', [CmsAktifitasController::class, 'destroy'])->name('cms.aktifitasdesa.destroy');
});

Route::get('/cms/editprofile', function () {
    return view('cms.pages.editprofile');
});

Route::middleware(['auth:web'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/{id}', [ProfileController::class, 'updateById'])->name('profile.update.byid');
});

// Routes untuk user biasa
Route::middleware(['auth:web'])->group(function () {
    // Routes dengan akses penuh
});

// Routes untuk struktur
Route::middleware(['auth:struktur'])->group(function () {
    // Routes dengan akses terbatas
    Route::get('/cms/app/dashboard', 'DashboardController@index');
    Route::get('/cms/app/kependudukan', 'KependudukanController@index');
    Route::get('/struktur/profile/edit', [StrukturProfileController::class, 'edit'])
        ->name('struktur.profile.edit');
    Route::put('/struktur/profile/update', [StrukturProfileController::class, 'update'])
        ->name('struktur.profile.update');
    Route::put('/struktur/profile/{id}', [StrukturProfileController::class, 'updateById'])
        ->name('struktur.profile.update.byid');
});

// Routes untuk kedua tipe user
Route::middleware(['auth:web,struktur'])->group(function () {
    Route::get('/cms/app/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cms/app/kependudukan', [KependudukanController::class, 'index'])->name('cms.kependudukan.index');
    Route::get('/cms/app/kependudukan/create', [KependudukanController::class, 'create'])->name('kependudukan.create');
    Route::post('/cms/app/kependudukan', [KependudukanController::class, 'store'])->name('kependudukan.store');
    Route::get('/cms/app/kependudukan/{id}/edit', [KependudukanController::class, 'edit'])->name('kependudukan.edit');
    Route::put('/cms/app/kependudukan/{id}', [KependudukanController::class, 'update'])->name('kependudukan.update');
    Route::delete('/cms/app/kependudukan/{id}', [KependudukanController::class, 'destroy'])->name('kependudukan.destroy');
});

// Routes yang bisa diakses oleh kedua tipe user
Route::middleware(['auth:web,struktur'])->prefix('cms')->name('cms.')->group(function () {
    // Dashboard
    Route::get('/app/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Desa
    Route::get('/sambutan', [ProfileDesaController::class, 'sambutan'])->name('sambutan');
    Route::get('/profile-desa', [ProfileDesaController::class, 'index'])->name('profile-desa');

    // Kependudukan
        // Route::get('/app/kependudukan', [KependudukanController::class, 'index'])->name('kependudukan.index');
        // Route::middleware('auth:web')->group(function () {
        //     Route::post('/app/kependudukan', [KependudukanController::class, 'store'])->name('kependudukan.store');
        //     Route::put('/app/kependudukan/{id}', [KependudukanController::class, 'update'])->name('kependudukan.update');
        //     Route::delete('/app/kependudukan/{id}', [KependudukanController::class, 'destroy'])->name('kependudukan.destroy');
        // });

    // Struktur Desa
    Route::get('/strukturdesa', [StrukturController::class, 'index'])->name('strukturdesa.index');

    // Keuangan Desa
    Route::get('/dana', [DanaDesaController::class, 'index'])->name('dana.index');
    // Route::get('/kegiatan', [CmsKegiatanController::class, 'index'])->name('kegiatan.index');

    // Galeri
    Route::get('/berita', [CmsBeritaController::class, 'index'])->name('berita.index');
    Route::get('/aktifitas', [CmsAktifitasController::class, 'index'])->name('aktifitas.index');
    Route::get('/produk', [CmsProdukController::class, 'index'])->name('produk.index');

    // Layanan
    Route::prefix('suratketerangan')->name('suratketerangan.')->group(function () {
        Route::get('/domisili', [CmsDomisiliController::class, 'domisili'])->name('domisili');
        Route::get('/tidakmampu', [CmsSuratTidakMampuController::class, 'tidakMampu'])->name('tidakmampu');
        Route::get('/usaha', [CmsSuratUsahaController::class, 'usaha'])->name('usaha');
        Route::get('/ktp', [CmsSuratKtpController::class, 'ktp'])->name('ktp');
        Route::get('/kelahiran', [CmsSuratKelahiranController::class, 'kelahiran'])->name('kelahiran');
    });

    Route::get('/pengaduan', [CmsPengaduanController::class, 'index'])->name('pengaduan.index');
});

// Routes khusus untuk operasi CRUD yang hanya bisa diakses user biasa
Route::middleware(['auth:web'])->prefix('cms')->name('cms.')->group(function () {
    // Tambahkan route untuk operasi CRUD lainnya di sini
});

// Di dalam group middleware auth:web,struktur
Route::middleware(['auth:web,struktur'])->group(function() {
    Route::post('/berita', [CmsBeritaController::class, 'store'])->name('berita.store');
    Route::delete('/berita/{id}', [CmsBeritaController::class, 'destroy'])->name('berita.destroy');

    // Route untuk edit dan update berita dengan prefix cms
    Route::prefix('cms')->group(function () {
        Route::get('/berita/edit/{id}', [CmsBeritaController::class, 'edit'])->name('cms.berita.edit');
        Route::put('/berita/{id}', [CmsBeritaController::class, 'update'])->name('cms.berita.update');
    });
});

// Tambahkan route untuk update status domisili
Route::middleware(['auth'])->prefix('cms')->group(function () {
    Route::get('/suratketerangan/domisili', [CmsDomisiliController::class, 'index'])->name('suratketerangan.domisili');
    Route::put('/suratketerangan/domisili/{id}/update-status', [CmsDomisiliController::class, 'updateStatus'])
        ->name('cms.domisili.update-status');
});

// Routes untuk admin pengaduan
Route::middleware(['auth'])->prefix('cms/admin')->group(function () {
    Route::get('/pengaduan', [CmsPengaduanController::class, 'index'])->name('cms.pengaduan.index');
    Route::get('/pengaduan/{id}/edit', [CmsPengaduanController::class, 'edit'])->name('cms.pengaduan.edit');
    Route::put('/pengaduan/{id}', [CmsPengaduanController::class, 'update'])->name('cms.pengaduan.update');
});

Route::resource('dana', DanaDesaController::class);

Route::middleware(['auth:web,struktur'])->prefix('cms')->group(function () {
    Route::post('/sliders', [App\Http\Controllers\Cms\CmsHeroSliderController::class, 'store'])->name('sliders.store');
    Route::get('/sliders/{slider}/edit', [App\Http\Controllers\Cms\CmsHeroSliderController::class, 'edit'])->name('sliders.edit');
    Route::put('/sliders/{slider}', [App\Http\Controllers\Cms\CmsHeroSliderController::class, 'update'])->name('sliders.update');
    Route::delete('/sliders/{slider}', [App\Http\Controllers\Cms\CmsHeroSliderController::class, 'destroy'])->name('sliders.destroy');
});

Route::get('/api/check-session', function () {
    if (!Auth::check() && !Auth::guard('struktur')->check()) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    return response()->json(['message' => 'Authenticated']);
});
