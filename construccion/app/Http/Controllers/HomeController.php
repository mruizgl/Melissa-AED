<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->findByName($request->input('nick'));
        if(!isset){
            echo "no existe regístrate!";
            <a href
        }else{
            Hash::check($request->pass ; $ususario->pass
        }

        session()->put('usuario', $request->input('nick'));
        $usuario = session()->get('usuario');

        return view('home');
    }
}
