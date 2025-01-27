<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use App\DAO\UsuarioDAO;

/**
 * Controlador de la gestión de usuarios de la aplicacion
 * @author Melissa Ruiz
 */
class UserController extends Controller
{
    protected $usuarioDAO;

    public function __construct()
    {
        $this->usuarioDAO = new UsuarioDAO(); 
    }

    public function index()
    {
        $usuarios = $this->usuarioDAO->findAll(); 
        return view('users.index', compact('usuarios'));
    }

    public function edit($id)
    {
        $usuario = $this->usuarioDAO->findById($id); 
        return view('users.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string',
            'password' => 'nullable|string|min:6',
        ]);

        $usuario = $this->usuarioDAO->findById($id);
        $usuario->setNombre($request->input('nombre'));
        
        if ($request->has('password') && !empty($request->input('password'))) {
            $usuario->setPassword($request->input('password'));
        }

        $this->usuarioDAO->update($usuario); 
        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $this->usuarioDAO->delete($id); 
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string',
            'password' => 'required|string|min:6',
        ]);


        $usuario = new Usuario();
        $usuario->setNombre($request->nombre);
        $usuario->setPassword($request->password);
        $usuario->setRolId(1); 

        $this->usuarioDAO->save($usuario); 

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito');
    }


}
