<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiStudiController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\AuthController;

// === AREA PUBLIK (MAHASISWA) ===
Route::get('/', [AuthController::class, 'portal'])->name('portal');
Route::post('/cari-nim', [AuthController::class, 'cariNim']);

// === AREA AUTH (LOGIN) ===
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === AREA VIP ADMIN (Wajib Login) ===
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); // Ganti '/' jadi '/dashboard' di file index awal lu
    
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('alternatif', AlternatifController::class);
    Route::resource('mahasiswa', MahasiswaController::class);
    
    Route::get('/nilaistudi', [NilaiStudiController::class, 'index']);
    Route::get('/nilaistudi/create', [NilaiStudiController::class, 'create']);
    Route::post('/nilaistudi', [NilaiStudiController::class, 'store']);
    Route::delete('/nilaistudi/reset/{id}', [NilaiStudiController::class, 'destroy']);
    
    Route::get('/perhitungan', [HitungController::class, 'index']);
});

// Route Rapor ini dikeluarin dari auth biar mahasiswa bisa liat hasilnya
Route::get('/perhitungan/{id}', [HitungController::class, 'show']);
Route::get('/perhitungan/cetak_pdf/{id}', [HitungController::class, 'cetakPdf']);