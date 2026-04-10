<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Pendaftaran API
Route::get('/pendaftaran', [ApiController::class, 'getPendaftaranDanKandidat']);
Route::get('/pendaftaran/{id}', [ApiController::class, 'getPendaftaranById']);

// Kandidat API
Route::get('/kandidat', [ApiController::class, 'getKandidat']);
Route::get('/kandidat/{id}', [ApiController::class, 'getKandidatById']);
