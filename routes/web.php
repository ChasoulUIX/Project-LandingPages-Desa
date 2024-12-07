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
    return view('app.dashboard');
});
Route::get('/layanan', function () {
    return view('pages.layanan');
});
Route::get('/berita', function () {
    return view('pages.berita');
});
Route::get('/galery', function () {
    return view('pages.galery');
});
Route::get('/kontak', function () {
    return view('pages.kontak');
});
Route::get('/produk', function () {
    return view('pages.produk');
});
Route::get('/aboutdesa', function () {
    return view('pages.aboutdesa');
});

// Struktural
Route::get('/pamongdesa', function () {
    return view('pages.pamongdesa');
});

// Layanan
Route::get('/keterangan', function () {
    return view('pages.layanan.keterangan');
});
Route::get('/pengaduan', function () {
    return view('pages.layanan.pengaduan');
});
Route::get('/informasidesa', function () {
    return view('pages.layanan.informasidesa');
});
Route::get('/datakependudukan', function () {
    return view('pages.layanan.datakependudukan');
});
Route::get('/bantuansosial', function () {
    return view('pages.layanan.bantuansosial');
});
Route::get('/danadesa', function () {
    return view('pages.layanan.danadesa');
});

//layanan surat keterangan
Route::get('/suratketerangan/domisili', function () {
    return view('pages.layanan.suratketerangan.domisili');
});
Route::get('/suratketerangan/tidakmampu', function () {
    return view('pages.layanan.suratketerangan.tidakmampu');
});
Route::get('/suratketerangan/usaha', function () {
    return view('pages.layanan.suratketerangan.usaha');
});
Route::get('/suratketerangan/ktp', function () {
    return view('pages.layanan.suratketerangan.ktp');
});
Route::get('/suratketerangan/kelahiran', function () {
    return view('pages.layanan.suratketerangan.kelahiran');
});
Route::get('/suratketerangan/kematian', function () {
    return view('pages.layanan.suratketerangan.kematian');
});

// Route untuk mengambil gambar dari public/images
Route::get('/images/{filename}', function ($filename) {
    $path = public_path('images/' . $filename);
    if (file_exists($path)) {
        return response()->file($path);
    }
    abort(404);
});
