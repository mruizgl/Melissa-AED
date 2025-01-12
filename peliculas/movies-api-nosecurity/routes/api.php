<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\PeliculaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/peliculas', [PeliculaController::class, 'index']);
Route::get('/peliculas/{pelicula}', [PeliculaController::class, 'show']);



Route::get('/actores', [ActorController::class, 'index']);
Route::get('/actores/{actor}', [ActorController::class, 'show']);



Route::get('/directores', [DirectorController::class, 'index']);
Route::get('/directores/{director}', [DirectorController::class, 'show']);


