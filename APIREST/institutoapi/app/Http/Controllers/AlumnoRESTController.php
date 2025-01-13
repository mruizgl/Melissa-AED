<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoRESTController extends Controller
{
    public function index()
    {
        return response()->json([
        'saludo' => 'hola soy Melissa',
        ]);
    }
}
