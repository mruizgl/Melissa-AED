<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableroController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FiguraController;
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

/**
 *Login
 */
Route::get('/', function () {
    return view('login');
});

Route::any('/login', [HomeController::class, 'login']);

Route::get('/register', function () {
    return view('register');
});

Route::post('/register', [HomeController::class, 'register']);

Route::get('/home', [HomeController::class, 'index']); 

/**
 * Tablero
 */
Route::get('/tableros/create', [TableroController::class, 'create']);
Route::post('/tableros', [TableroController::class, 'store']);
Route::get('/tableros/{id}', [TableroController::class, 'showBoard'])->name('tableros.show');
Route::post('/tableros/add-figure', [TableroController::class, 'addFigure'])->name('tableros.addFigure');

/**
 * Gestion de usuarios
 */
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

/**
 * Figuras
 */
Route::get('admin/figuras/create', [FiguraController::class, 'createFigura'])->name('figuras.create');
Route::post('/figuras', [FiguraController::class, 'storeFigura'])->name('figuras.store');
Route::delete('/figuras/{id}', [FiguraController::class, 'destroy'])->name('figuras.destroy');