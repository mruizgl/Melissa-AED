<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PeliculaController;
use App\Http\Controllers\Api\V1\ActorController;
use App\Http\Controllers\Api\V1\CategoriaController;
use App\Http\Controllers\Api\V1\DirectorController;

Route::prefix('v1')->group(function() {
    // Rutas API para la versión v1
    Route::apiResource('peliculas', PeliculaController::class); 
    Route::get('peliculas', [PeliculaController::class, 'index']); 
});
