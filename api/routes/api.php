<?php

use App\Http\Controllers\FakultasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/fakultas', [FakultasController::class, 'index']);

Route::get('/prodi', [ProdiController::class, 'index']);

Route::post('/fakultas/store', [FakultasController::class, 'store']);

Route::post('/prodi/store', [ProdiController::class, 'store']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store']);
