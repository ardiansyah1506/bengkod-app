<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\UserPeriksaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('dokter')->group (function(){
    Route::resource('obat', ObatController::class);
    Route::resource('periksa', PeriksaController::class);
});

Route::get('/periksa', [UserPeriksaController::class, 'index'])->name('home');
Route::post('/periksa', [UserPeriksaController::class, 'store'])->name('pasien.periksa.store');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('home');
