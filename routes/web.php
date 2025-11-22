<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Proteksi resource dengan auth
Route::middleware(['auth'])->group(function(){
    Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
    Route::resource('mahasiswa', \App\Http\Controllers\MahasiswaController::class);
    Route::resource('dosen', \App\Http\Controllers\DosenController::class);
});

//profile routers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Hanya mahasiswa yang bisa membuat laporan
Route::middleware(['auth','role:mahasiswa'])->group(function(){
    Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
});

// Hanya DPA (admin) yang bisa mengelola mahasiswa, dosen, dan melihat semua laporan
Route::middleware(['auth','role:dpa'])->group(function(){
    Route::resource('mahasiswa', \App\Http\Controllers\MahasiswaController::class);
    Route::resource('dosen', \App\Http\Controllers\DosenController::class);
    Route::get('/admin/laporan', [\App\Http\Controllers\LaporanController::class,'index'])->name('admin.laporan.index');
});

require __DIR__.'/auth.php';
