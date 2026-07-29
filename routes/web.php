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
Route::get('/pelajari', [HomeController::class, 'pelajari'])->name('pelajari');


// Rute Pengguna | Harus login untuk reservasi
Route::middleware('auth')->group(function () {
    Route::get('/reservasi', [HomeController::class, 'reservasi'])->name('reservasi');
    Route::post('/reservasi', [HomeController::class, 'submitReservasi'])->name('reservasi.submit');
    // riwayat
    Route::get('/riwayat', [HomeController::class, 'riwayatIndex'])->name('pelanggan.riwayat');
    Route::post('/riwayat/{id}/upload-bukti', [HomeController::class, 'uploadBuktiPembayaran'])->name('pelanggan.upload-bukti');
    // profil
    Route::get('/profil', [HomeController::class, 'profilEdit'])->name('pelanggan.profil.edit');
    Route::put('/profil/update', [HomeController::class, 'profilUpdate'])->name('pelanggan.profil.update');
    // batal reservasi
    Route::post('/riwayat/{id}/batal-mandiri', [HomeController::class, 'batalMandiriPelanggan'])->name('pelanggan.batal-mandiri');
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

    // reservasi
    Route::get('/reservasi', [DashboardController::class, 'reservasiIndex'])->name('reservasi.index');
    Route::post('/reservasi/{id}/update-status', [DashboardController::class, 'updateStatusReservasi'])->name('reservasi.update');
    // lapangan
    Route::get('/lapangan', [DashboardController::class, 'lapanganIndex'])->name('lapangan.index');
    Route::get('/lapangan/create', [DashboardController::class, 'lapanganCreate'])->name('lapangan.create');
    Route::post('/lapangan/store', [DashboardController::class, 'lapanganStore'])->name('lapangan.store');
    Route::get('/lapangan/{id}/edit', [DashboardController::class, 'lapanganEdit'])->name('lapangan.edit');
    Route::post('/lapangan/{id}/update', [DashboardController::class, 'lapanganUpdate'])->name('lapangan.update');
    Route::post('/lapangan/{id}/toggle-status', [DashboardController::class, 'lapanganToggleStatus'])->name('lapangan.toggle-status');
    Route::delete('/lapangan/{id}/delete', [DashboardController::class, 'lapanganDestroy'])->name('lapangan.destroy');
    // akun
    Route::get('/akun', [DashboardController::class, 'akunIndex'])->name('akun.index');
    Route::get('/akun/create', [DashboardController::class, 'akunCreate'])->name('akun.create');
    Route::post('/akun/store', [DashboardController::class, 'akunStore'])->name('akun.store');
    Route::get('/akun/{id}/edit', [DashboardController::class, 'akunEdit'])->name('akun.edit');
    Route::post('/akun/{id}/update', [DashboardController::class, 'akunUpdate'])->name('akun.update');
    Route::delete('/akun/{id}/delete', [DashboardController::class, 'akunDestroy'])->name('akun.destroy');
    // laporan
    Route::get('/laporan', [DashboardController::class, 'laporanIndex'])->name('laporan.index');
    Route::get('/laporan/unduh-pdf', [DashboardController::class, 'unduhLaporanPdf'])->name('laporan.pdf');
});
