<?php

use App\Http\Controllers\MutasiController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/mutasi');

Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');
Route::post('/mutasi', [MutasiController::class, 'store'])->name('mutasi.store');
Route::get('/mutasi/{id}/edit', [MutasiController::class, 'edit'])->name('mutasi.edit');
Route::match(['put', 'patch'], '/mutasi/{id}', [MutasiController::class, 'update'])->name('mutasi.update');
Route::delete('/mutasi/{id}', [MutasiController::class, 'destroy'])->name('mutasi.destroy');
use App\Http\Controllers\LaporanController;

// Jalur untuk Layanan Pelaporan Masyarakat
Route::get('/lapor', [LaporanController::class, 'index']); // Halaman form lapor
Route::post('/lapor', [LaporanController::class, 'store']); // Menyimpan data laporan
// Jalur untuk Petugas melihat dan memproses laporan warga
Route::get('/laporan-masuk', [LaporanController::class, 'petugasIndex']);
Route::put('/laporan-masuk/{id}', [LaporanController::class, 'updateStatus']);

// Jalur untuk masyarakat mengecek status laporan
Route::get('/cek-laporan', [LaporanController::class, 'cekLaporan'])->name('cek-laporan');
Route::post('/cek-laporan', [LaporanController::class, 'cariLaporan'])->name('cek-laporan.cari');
