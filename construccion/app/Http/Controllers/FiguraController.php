<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DAO\TableroDAO;
use App\DAO\FiguraDAO;
use App\Contracts\ICrud;
use App\Contracts\FiguraContract;

class FiguraController extends Controller
{
    private $figuraDAO;


    public function __construct(FiguraDAO $figuraDAO)
    {
        $this->figuraDAO = $figuraDAO;
    }


    //T
    public function create()
    {
        return view('figuras.create');
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
    
    public function edit($id)
    {
        $tablero = DB::table('tableros')->where('id', $id)->first();
        $figuras = DB::table('figuras')->get();
        $figurasEnTablero = DB::table('figuras_tableros')->where('tablero_id', $id)->get();

        return view('edit_tablero', compact('tablero', 'figuras', 'figurasEnTablero'));
    }

    public function addFigure(Request $request)
    {
        $request->validate([
            'figura_id' => 'required|integer',
            'tablero_id' => 'required|integer',
            'posicion' => 'required|integer',
        ]);

        $figuraExistente = DB::table('figuras_tableros')
            ->where('tablero_id', $request->tablero_id)
            ->where('posicion', $request->posicion)
            ->first();

        if ($figuraExistente) {
            DB::table('figuras_tableros')->where('id', $figuraExistente->id)->update([
                'figura_id' => $request->figura_id,
            ]);
        } else {
            DB::table('figuras_tableros')->insert([
                'figura_id' => $request->figura_id,
                'tablero_id' => $request->tablero_id,
                'posicion' => $request->posicion,
            ]);
        }

        return redirect()->back()->with('success', 'Figura guardada correctamente');
    }

    

    public function showBoard($id)
    {
        $tablero = DB::table('tableros')->where('id', $id)->first();
        
        $figuras = DB::table('figuras')->get();
    
        $figurasEnTablero = DB::table('figuras_tableros')
            ->join('figuras', 'figuras_tableros.figura_id', '=', 'figuras.id')
            ->where('tablero_id', $id)
            ->orderBy('posicion')
            ->select('figuras_tableros.posicion', 'figuras.imagen', 'figuras.tipo_imagen')
            ->get();
    
        return view('tableros.edit', compact('tablero', 'figurasEnTablero', 'figuras'));
    }

    //
    public function createFigura()
    {
        $figuras = $this->figuraDAO->findAll();
        return view('figuras.create', compact('figuras'));
    }

    public function storeFigura(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación
        ]);
    
        // Lee el contenido del archivo
        $imageContent = file_get_contents($request->file('imagen')->getRealPath());
        $imageType = $request->file('imagen')->getClientOriginalExtension(); // Tipo de imagen
    
        // Guarda la imagen en la base de datos como BLOB
        $this->figuraDAO->save([
            FiguraContract::COL_IMAGEN => $imageContent, // Aquí guardas el contenido de la imagen
            FiguraContract::COL_TIPO_IMAGEN => $imageType, // Guarda el tipo de imagen
        ]);
    
        return redirect()->route('figuras.create')->with('success', 'Imagen subida exitosamente.');
    }

    public function destroy($id)
    {
        $this->figuraDAO->delete($id);
        return redirect()->route('figuras.create')->with('success', 'Imagen eliminada exitosamente.');
    }



   
}
