<?php

use App\Http\Controllers\Api\CvController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\KandidatController;
use App\Http\Controllers\Api\PendaftaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'show']);

Route::get('/kandidat', [KandidatController::class, 'index']);
Route::get('/kandidat/{id}', [KandidatController::class, 'show']);
Route::put('/kandidat/update/data/{id}', [KandidatController::class, 'updateStatus']);

Route::get('/history', [HistoryController::class, 'index']);
Route::get('/history/{id}', [HistoryController::class, 'show']);

Route::get('/cv', [CvController::class, 'index']);
Route::get('/cv/{id}', [CvController::class, 'show']);
