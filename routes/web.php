<?php

use Illuminate\Support\Facades\Route;

// Controller Pelanggan
use App\Http\Controllers\Pelanggan\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');