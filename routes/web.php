<?php

use Illuminate\Support\Facades\Route;


// Auth
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});

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
