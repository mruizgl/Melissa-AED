<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableroController extends Controller
{
    protected $tableroDAO;

    public function __construct(TableroDAO $tableroDAO)
    {
        $this->tableroDAO = $tableroDAO;
    }


    public function create()
    {
        return view('tableros.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);


        $tablero = new Tablero();
        $tablero->setNombre($request->input('nombre'));
        $tablero->setContenido($request->input('contenido'));
        $tablero->setUsuarioId(session('usuario_id'));
        $tablero->setFecha(time()); 

        if ($this->tableroDAO->save($tablero)) {
            return redirect('/home')->with('success', 'Tablero creado exitosamente.');
        } else {
            return back()->withErrors(['save_error' => 'Error al guardar el tablero.']);
        }
    }
}
