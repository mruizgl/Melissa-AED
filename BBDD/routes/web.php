<?php

use App\Models\Alumno;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/veralumno/{id}', [AlumnoController::class, 'show']);

Route::get('/listar', [AlumnoController::class, 'listar']);

Route::get('/crear-historico-dolar', [AlumnoController::class, 'crearHistoricoDolar']);

Route::get('/practica17', [AlumnoController::class, 'practica17']);