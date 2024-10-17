<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Ej13 extends Controller{
    public function index() {
        return view('ej13');

    }

    public function store(Request $request) {
        $colores = request()->get('color');
        if(isset($color)) {
            $colores = session()->get('colores');

            array_push($colores, $color);
            session()->put('colores', $colores);
        }
    }

    public function store(Request $request) {
        $color = request()->get('color');
        if (isset($color)) {
            $colores = session()->get('colores');

            array_push($colores, $color);
            session()->put('colores', $colores);
        }
    }
}
