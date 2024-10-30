<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TableroController;

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
