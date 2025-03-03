<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmeController;
use App\Http\Controllers\CategoriaController;

// Rotas de Autenticação
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Protegendo as rotas de Filmes e Categorias com autenticação
Route::middleware('auth:api')->group(function () {

    // Rotas para Filmes
    Route::prefix('filmes')->group(function () {
        Route::post('/', [FilmeController::class, 'create']);
        Route::get('/', [FilmeController::class, 'list']);
        Route::get('{id}', [FilmeController::class, 'show']);
        Route::put('{id}', [FilmeController::class, 'update']);
        Route::delete('{id}', [FilmeController::class, 'delete']);
    });

    // Rotas para Categorias
    Route::prefix('categorias')->group(function () {
        Route::post('/', [CategoriaController::class, 'create']);
        Route::get('/', [CategoriaController::class, 'list']);
        Route::get('{id}', [CategoriaController::class, 'show']);
        Route::put('{id}', [CategoriaController::class, 'update']);
        Route::delete('{id}', [CategoriaController::class, 'delete']);
    });

});
