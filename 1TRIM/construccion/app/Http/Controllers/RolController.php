<?php

use App\DAO\RolDAO;
use App\Models\Rol;

/**
 * Controlador del Rol de la aplicacion
 * @author Melissa Ruiz
 */
class RolController extends Controller
{
    protected $rolDAO;

    public function __construct()
    {
        $this->rolDAO = new RolDAO();
    }

    public function mostrarRol($id)
    {
        $rol = $this->rolDAO->findById($id);
        if ($rol) {
            echo "ID: " . $rol->getId() . ", Nombre: " . $rol->getNombre();
        } else {
            echo "Rol no encontrado.";
        }
    }

    public function crearRol($nombre)
    {
        $rol = new Rol();
        $rol->setNombre($nombre);

        if ($this->rolDAO->save($rol)) {
            echo "Rol creado exitosamente.";
        } else {
            echo "Error al crear el rol.";
        }
    }

    //
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
        $usuario = $this->usuarioDAO->findById($usuarioId);
        $tableros = Tablero::where('usuario_id', $usuarioId)->get();
        
        $isAdmin = $usuario->getRolId() === 2;
    
        return view('home', compact('tableros', 'usuario', 'isAdmin'));
    }

    public function indexRol()
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

