<?php

use App\Http\Controllers\FrontPendaftaranController;
use App\Http\Controllers\PerkembanganAnakPdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda');
});

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
});

Route::get('/pendaftaran', [FrontPendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [FrontPendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('/perkembangan-anak/{perkembanganAnak}/pdf', PerkembanganAnakPdfController::class)
    ->name('perkembangan-anak.pdf')
    ->middleware('auth');

Route::get('/api/proxy-region/{endpoint}', function ($endpoint) {
    $response = \Illuminate\Support\Facades\Http::get('https://lokaid.gilangpratama.id/' . $endpoint);
    return $response->json();
})->where('endpoint', '.*');