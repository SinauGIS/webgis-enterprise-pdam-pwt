<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pelanggans', [ApiController::class, 'index'])->name('api.pelanggans');
Route::get('/dmas', [ApiController::class, 'dma'])->name('api.dmas');