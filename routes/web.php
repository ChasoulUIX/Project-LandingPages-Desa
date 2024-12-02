<?php

use Illuminate\Support\Facades\Route;

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