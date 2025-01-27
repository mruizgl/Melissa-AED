<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->session()->put('usuario', $request->input('nick')); // Guardar el usuario en la sesión como 'usuario'
        $usuario = $request->session()->get('usuario'); // Obtener el valor de 'usuario'

        // Obtener archivos privados y compartidos
        $privados = Storage::files("private/" . $usuario);
        $compartidos = Storage::files("shared");

        // Asegurarse de que ambos sean arrays, incluso si no existen archivos
        $privados = is_array($privados) ? $privados : [];
        $compartidos = is_array($compartidos) ? $compartidos : [];

        // Retornar la vista con 'privados', 'compartidos', y 'usuario'
        return view('home', compact('privados', 'compartidos', 'usuario'));
    }

    public function showHome(Request $request)
    {
        if (!$request->session()->has('nick')) {
            return redirect('/');
        }

        $nick = $request->session()->get('nick');
        return view('home', ['nick' => $nick]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('nick');
        return redirect('/');
    }
}
