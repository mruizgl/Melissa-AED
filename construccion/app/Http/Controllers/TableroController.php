<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\TableroDAO;
use App\Models\Tablero;


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
        $tablero->setUsuarioId(session('usuario_id')); 
        $tablero->setNombre($request->input('nombre')); 
        $tablero->setContenido($request->input('contenido'));
        $tablero->setFecha(time()); 


        if ($this->tableroDAO->save($tablero)) {
            return redirect('/home')->with('success', 'Tablero creado exitosamente.');
        } else {
            return back()->withErrors(['save_error' => 'Error al guardar el tablero.']);
        }
    }
}
