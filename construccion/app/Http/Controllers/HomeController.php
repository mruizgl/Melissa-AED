<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\UsuarioDAO;
use App\DAO\TableroDAO;
use App\Models\Usuario;
use App\Models\Tablero;

use function Laravel\Prompts\error;

class HomeController extends Controller
{
    protected $usuarioDAO;
    //protected $tableroDAO;


    public function __construct(UsuarioDAO $usuarioDAO)
    {
        $this->usuarioDAO = $usuarioDAO;
        //$this->tableroDAO = $tableroDAO;
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
        //dd($usuario);

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

    public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        //$request->validate([
        //    'nombre' => 'required|string|unique:usuarios,nombre',
        //    'password' => 'required|string|min:6',
        //]);

        $usuario = new Usuario();
        $usuario->setNombre($request->input('nombre'));
        $usuario->setPassword($request->input('password'));
        $usuario->setRolId(1);

        if ($this->usuarioDAO->save($usuario)) {
            return redirect('/')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
        } else {
            return back()->with(error("Error al registrar"));
            return back()->withErrors(['register_error' => 'Error al registrar el usuario.']);
        }


    }

    public function index(Request $request)
    {
        $usuarioId = $request->session()->get('usuario_id');

    // Obtener el usuario (puedes usar UsuarioDAO aquí)
    $usuario = $this->usuarioDAO->findById($usuarioId);

    // Obtener los tableros directamente desde el modelo
    $tableros = Tablero::where('usuario_id', $usuarioId)->get();

    return view('home', compact('tableros', 'usuario'));
    }

}
