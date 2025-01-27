<?php

use App\Http\Controllers\ActorRESTController;
use App\Http\Controllers\CategoriaRESTController;
use App\Http\Controllers\DirectorRESTController;
use App\Http\Controllers\PeliculaRESTController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/peliculas', [PeliculaRESTController::class, 'index']);
Route::get('/peliculas/{pelicula}', [PeliculaRESTController::class, 'show']);
Route::post('/peliculas', [PeliculaRESTController::class, 'store']);
Route::put('/peliculas/{pelicula}', [PeliculaRESTController::class, 'update']);
Route::delete('/peliculas/{pelicula}', [PeliculaRESTController::class, 'destroy']);


Route::get('/categorias', [CategoriaRESTController::class, 'index']);
Route::get('/categorias/{categoria}', [CategoriaRESTController::class, 'show']);
Route::post('/categorias', [CategoriaRESTController::class, 'store']);
Route::put('/categorias/{categoria}', [CategoriaRESTController::class, 'update']);
Route::delete('/categorias/{categoria}', [CategoriaRESTController::class, 'destroy']);



Route::get('/actors', [ActorRESTController::class, 'index']);
Route::get('/actors/{actor}', [ActorRESTController::class, 'show']);    
Route::post('/actors', [ActorRESTController::class, 'store']);
Route::put('/actors/{actor}', [ActorRESTController::class, 'update']);
Route::delete('/actors/{actor}', [ActorRESTController::class, 'destroy']);




Route::get('/directors', [DirectorRESTController::class, 'index']);
Route::get('/directors/{director}', [DirectorRESTController::class, 'show']);
Route::post('/directors', [DirectorRESTController::class, 'store']);
Route::put('/directors/{director}', [DirectorRESTController::class, 'update']);
Route::delete('/directors/{director}', [DirectorRESTController::class, 'destroy']);
