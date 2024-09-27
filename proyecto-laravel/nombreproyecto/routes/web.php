<?php

use Illuminate\Support\Facades\Route;

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
    echo "Under construction";
    die();
});

Route::post('/pruebita', function () {
    echo "se ha ejecutado peticion a /pruebita";
    die();
});

Route::any('/relatos/{numero}', function ($numero) {
    echo "peticion recibido para el parametro: $numero";
    die();
})-> where('numero', '[0-9]+');

