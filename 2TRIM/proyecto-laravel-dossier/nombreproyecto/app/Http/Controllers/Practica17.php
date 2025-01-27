<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Practica17 extends Controller
{
    public function index()
    {
        return view('directorio.create');
    }

    public function store(Request $request)
    {
        // Validar que el campo 'nombre' esté presente y no esté vacío
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Obtener el nombre del directorio desde el formulario
        $nombreDirectorio = $request->input('nombre');

        // Crear el directorio en storage si no existe
        Storage::makeDirectory($nombreDirectorio);

        return redirect()->route('directorio.index')->with('success', "El directorio '$nombreDirectorio' ha sido creado.");
    }
}
