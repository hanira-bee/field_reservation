<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Pelanggan\HomeController;
use Illuminate\Support\Facades\Route;

// Rute Publik | bisa diakses siapa saja tanpa login
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lapangan', [HomeController::class, 'lapangan'])->name('lapangan');
Route::get('/lapangan/{id}', [HomeController::class, 'detail'])->name('lapangan.detail');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');


// Rute Pengguna | Harus login untuk reservasi
Route::middleware('auth')->group(function () {
    Route::get('/reservasi', [HomeController::class, 'reservasi'])->name('reservasi');
    Route::post('/reservasi', [HomeController::class, 'submitReservasi'])->name('reservasi.submit');
});

// Guest/tamu Route
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Route
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
