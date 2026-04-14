<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

<<<<<<< HEAD
Route::get('/pendaftaran', [ApiController::class, 'getPendaftaranDanKandidat']);
Route::get('/pendaftaran/{id}', [ApiController::class, 'getPendaftaranById']);

Route::get('/kandidat', [ApiController::class, 'getKandidat']);
Route::get('/kandidat/{id}', [ApiController::class, 'getKandidatById']);

Route::get('/history', [ApiController::class, 'getHistory']);
Route::get('/history/{id}', [ApiController::class, 'getHistoryById']);
=======
// Pendaftaran API
Route::get('/pendaftaran', [ApiController::class, 'getPendaftaranDanKandidat']);
Route::get('/pendaftaran/{id}', [ApiController::class, 'getPendaftaranById']);

// Kandidat API
Route::get('/kandidat', [ApiController::class, 'getKandidat']);
Route::get('/kandidat/{id}', [ApiController::class, 'getKandidatById']);
>>>>>>> 9e148e526cf717e766b7394ff7df9dd73195158d
