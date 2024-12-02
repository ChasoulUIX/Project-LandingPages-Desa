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
