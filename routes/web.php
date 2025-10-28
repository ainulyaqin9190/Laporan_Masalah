<?php

use Illuminate\Support\Facades\Route;
use App\Http\controllers\laporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/laporan', [LaporanController::class, 'index']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

Route::get('/laporan', [LaporanController::class, 'index']);

Route::resource('mahasiswa', MahasiswaController::class);

Route::resource('dosen', DosenController::class);

Route::resource('laporan', LaporanController::class)->parameters(['laporan' => 'laporan']);