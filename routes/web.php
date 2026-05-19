<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SiswaMapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\AkunPenggunaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Resource routes untuk semua CRUD
Route::resource('kelas', KelasController::class);
Route::resource('guru', GuruController::class);
Route::resource('mata-pelajaran', MataPelajaranController::class);
Route::resource('siswa', SiswaController::class);
Route::resource('siswa-mapel', SiswaMapelController::class);
Route::resource('nilai', NilaiController::class);
Route::resource('akun-pengguna', AkunPenggunaController::class);