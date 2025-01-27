<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ej13 extends Controller{
    public function index()
    {
        $colores = session('colores', []);
        return view('colores.index', compact('colores'));
    }

    public function store(Request $request)
    {
        $color = $request->input('color');

        $colores = session('colores', []);
        $colores[] = $color;
        session(['colores' => $colores]);

        return redirect()->route('colores.index');
    }

}
