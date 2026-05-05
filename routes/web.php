<?php

use App\Http\Controllers\FrontPendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/pendaftaran', [FrontPendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [FrontPendaftaranController::class, 'store'])->name('pendaftaran.store');