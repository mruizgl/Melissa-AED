<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListarProductos extends Controller
{
    public function mostrarget() {
        echo "Ejecutando el controlador ListarProductos mediante get";
    }

    public function mostrarpost() {
        echo "Ejecutando el controlador ListarProductos mediante POST";
    }
}
