<?php

use App\Http\Controllers\Ej13;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ListarProductos;
use App\Http\Controllers\Practica17;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PruebaController;

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

use App\Http\Controllers\PrimosController;

Route::get('/', [PrimosController::class, 'index']);
Route::post('/calcular', [PrimosController::class, 'calcular']);


Route::get('/pruebita', function () {
    echo "se ha ejecutado peticion a /pruebita";
    die();
});

Route::any('/relatos/{numero}', function ($numero) {
    echo "peticion recibido para el parametro: $numero";
    die();
})-> where('numero', '[0-9]+');

Route::get('/hola', [PruebaController::class, 'saludar']);

Route::get('/formulario', function(){
    return view('formaleatorios');
});


Route::get('/procesarformulario', [PruebaController::class, 'procesarform']);

Route::post('/fileupload', '\App\Http\Controllers\PruebaController@subir');


//Route::get('/', [ListarProductos::class, 'mostrarget']);

//Route::post('/', [ListarProductos::class, 'mostrarpost']);

Route::get('/aleatorios', [PruebaController::class, 'mostrarNumerosAleatorios']);

Route::get('/palabras', [PruebaController::class, 'showForm'])->name('palabras.form');
Route::post('/palabras', [PruebaController::class, 'processForm'])->name('palabras.process');

Route::get('/practica12', function () {
    return view('practica12');
});


Route::get('/colores', [Ej13::class, 'index'])->name('colores.index');
Route::post('/colores', [Ej13::class, 'store'])->name('colores.store');

Route::get('/usuario', [PruebaController::class, 'index'])->name('usuario.index');
Route::post('/usuario', [PruebaController::class, 'store'])->name('usuario.store');

Route::get('/mostrar-csv', [PruebaController::class, 'showCSV'])->name('csv.show');

//PRACTICA 17
Route::get('/crear-directorio', [Practica17::class, 'index'])->name('directorio.index');
Route::post('/crear-directorio', [Practica17::class, 'store'])->name('directorio.store');

//PRACTICA 18
Route::get('/csv/create', [FileController::class, 'create'])->name('csv.create');
Route::post('/csv/store', [FileController::class, 'store'])->name('csv.store');
Route::get('/csv/show', [FileController::class, 'show'])->name('csv.show');

//PRACTICA 19
Route::get('/archivos', [FileController::class, 'listarArchivos'])->name('archivos.listar');
Route::get('/descargar/{nombre}', [FileController::class, 'descargar'])->name('archivos.descargar');
//PRACTICA 20
Route::delete('/archivos/borrar/{nombre}', [FileController::class, 'borrar'])->name('archivos.borrar');



