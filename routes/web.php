<?php

use App\Http\Controllers\PointsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('peta-utama');
});

Route::get('/pipa', function () {
    return view('peta-pipa');
});

Route::get('/peta-dma', function () {
    return view('peta-dma');
});

Route::get('/pelanggan', [PointsController::class, 'index'])->name('pelanggan.index');
Route::post('/pelanggan-simpan', [PointsController::class, 'store'])->name('pelanggan.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
