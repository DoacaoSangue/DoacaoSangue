<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DoacaoController;
use App\Http\Controllers\Api\LocalController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\TipoSanguineoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('doacoes', DoacaoController::class);
    Route::apiResource('locais', LocalController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::get('/tipos-sanguineos', [TipoSanguineoController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
