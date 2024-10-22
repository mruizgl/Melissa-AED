<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditorControl;
use Illuminate\Http\Request;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [HomeController::class, 'login']);

Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/home', [HomeController::class, 'showHome']);

Route::post('/create-file', [FileController::class, 'createFile']);

Route::get('/editor', [FileController::class, 'showEditor']);

Route::post('/editor', [FileController::class, 'storeFile']);

Route::post('/redirect-editor', [FileController::class, 'redirectEditor']);

Route::post('/directory', [FileController::class, 'crearListarCarpetaUsuario']);

Route::post('/create-file', [FileController::class, 'createFile'])->name('createFile');



