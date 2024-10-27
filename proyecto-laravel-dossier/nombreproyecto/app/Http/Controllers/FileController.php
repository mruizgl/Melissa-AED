<?php

namespace App\Http\Controllers;

use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function create()
    {
        return view('create_csv');
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        // Nombre del archivo CSV
        $filename = 'usuarios.csv';

        // Crear o abrir el archivo CSV en modo de añadir
        $handle = fopen(storage_path("app/$filename"), 'a');

        // Escribir la línea de datos como un array
        fputcsv($handle, [$request->name, $request->email]);

        // Cerrar el archivo
        fclose($handle);

        return redirect()->route('csv.create')->with('success', 'Archivo CSV creado correctamente.');
    }

    private function leerCsv($nombrefichero)
    {
        $contenido = [];
        
        // Leer el archivo CSV
        if (($open = fopen(storage_path("app/$nombrefichero"), "r")) !== FALSE) {
            while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                $contenido[] = $data; // Cada fila se convierte en un array
            }
            fclose($open);
            return $contenido;
        }
        
        return null;
    }

    // Método para leer el archivo CSV
    public function listarArchivos()
    {
        // Verificar si la carpeta existe y listar los archivos
        if (Storage::exists('practica19')) {
            $archivos = Storage::files('practica19');
        } else {
            $archivos = []; // Si no existen archivos, se asigna un array vacío
        }

        return view('lista_archivos', compact('archivos'));
    }

    // Método para descargar un archivo
    public function descargar($nombre)
    {
        // Descarga el archivo especificado
        return response()->download(storage_path("app/practica19/$nombre"));
    }

    public function borrar($nombre)
    {
    $ruta = storage_path("app/practica19/$nombre");

    if (file_exists($ruta)) {
        unlink($ruta); // Elimina el archivo
        return redirect()->back()->with('success', 'Archivo eliminado correctamente.');
    }

    return redirect()->back()->with('error', 'Archivo no encontrado.');
    }   

    
}
