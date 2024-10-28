<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO();
    }

    /**
     * Metodo de login
     */
    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'password' => 'required|string'
        ]);

        $nombre = $request->input('nombre');
        $password = $request->input('password');

        $usuario = $this->usuarioDAO->findByName($nombre);

        if ($usuario && password_verify($password, $usuario->getPassword())) {
            $request->session()->put('usuario_id', $usuario->getId());
            $request->session()->put('usuario_nombre', $usuario->getNombre());

            return redirect()->intended('/home');
        } else {
            return back()->withErrors([
                'login_error' => 'Nombre de usuario o contraseña incorrecta.'
            ]);
        }
    }
}
