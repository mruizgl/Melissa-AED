<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PruebaController extends Controller
{
    public function saludar() {
        $array = [];
        for ($i = 0; $i < 10; $i++) {
            $array[] = rand(1, 100);

        }
        return view('numerosaleatorios', compact('array'));  // Enviamos el array a la vista numerosaleatorios.blade.php)
    }

    public function procesarform(Request $request) {

        echo "hola llega a procesar form ";
        //die();
        $cantidadaleatorios = $request->input('cantidadaleatorios')??null;
        $nummenor = $request->input('nummenor')??null;
        $nummayor = $request->input('nummayor')??null;

        //procesan ustedes

        return view('verresultados', [
            'cantidadaleatorios' => $cantidadaleatorios,
            'nummenor' => $nummenor,
            'nummayor' => $nummayor


        ]);
    }

    public function subir(Request $request){
        $file = $request->myfile;
        echo 'File Name: '.$file->getClientOriginalName(); //Display File Name
        echo '<br>';
        echo 'File Extension: '.$file->getClientOriginalExtension(); //Display File Extension
        echo '<br>';
        echo 'File Real Path: '.$file->getRealPath(); //Display File Real Path
        echo '<br>';
        echo 'File Size: '.$file->getSize(); //Display File Size
        echo '<br>';
        echo 'File Mime Type: '.$file->getMimeType().'<br>'; //Display File Mime Type
        $nombrefichero = $file->getClientOriginalName();
        $path = $file->storeAs("/", $nombrefichero);
        echo $path;
    }

    public function primos()
    {
    $coleccion = collect([1,2,3,5,7,11,13,17,19]);
    return view('listarprimos',compact('coleccion'));
    }

    public function mostrarNumerosAleatorios() {
        $array = [];
        for ($i = 0; $i < 10; $i++) {
            $array[] = rand(1, 100);

        }
        return view('numerosaleatorios', compact('array'));
    }

    public function showForm()
    {
        return view('form');
    }

    public function processForm(Request $request)
    {
        $input = $request->input('palabras');

        $palabras = explode(',', $input);
        $palabras = array_map('trim', $palabras);
        $palabras = array_map('strtoupper', $palabras);


        return view('lista', compact('palabras'));
    }


    public function store(Request $request)
    {
        // Validar los campos, permitiendo valores vacíos
        $data = $request->only(['nombre', 'edad', 'gustos']);

        // Obtener los datos actuales de la sesión
        $usuario = session('usuario', [
            'nombre' => '',
            'edad' => '',
            'gustos' => '',
        ]);

        // Mantener los valores anteriores si los campos están vacíos
        $usuario['nombre'] = $data['nombre'] ?: $usuario['nombre'];
        $usuario['edad'] = $data['edad'] ?: $usuario['edad'];
        $usuario['gustos'] = $data['gustos'] ?: $usuario['gustos'];

        // Almacenar los datos actualizados en la sesión
        session(['usuario' => $usuario]);

        // Redirigir de nuevo a la página de usuario
        return redirect()->route('usuario.index');
    }

    public function showCSV()
    {
        // Leer el contenido del archivo CSV
        $path = 'usuarios.csv';
        $file = Storage::get($path);
        
        // Convertir el contenido en un array de líneas
        $lines = explode("\n", trim($file));
        $data = [];
        
        // Procesar cada línea para extraer el nombre y el correo
        foreach ($lines as $line) {
            $data[] = str_getcsv($line);
        }
        
        // Pasar los datos a la vista
        return view('csv.show', compact('data'));
    }

    public function index()
    {
        return view('primos');
    }

    // Maneja la lógica para calcular los números primos
    public function calcular(Request $request)
    {
        $cantidad = $request->input('cantidad');

        // Validar entrada
        if (!is_numeric($cantidad) || $cantidad <= 0) {
            return back()->withErrors(['cantidad' => 'Por favor, introduce un número válido mayor que 0.']);
        }

        try {
            $primos = $this->generarPrimos($cantidad);
            return view('resultado', compact('primos', 'cantidad'));
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Ocurrió un error al calcular los números primos.']);
        }
    }

    // Lógica para calcular números primos
    private function generarPrimos($cantidad)
    {
        $primos = [];
        $numero = 2;

        while (count($primos) < $cantidad) {
            if ($this->esPrimo($numero)) {
                $primos[] = $numero;
            }
            $numero++;
        }

        return $primos;
    }

    // Verifica si un número es primo
    private function esPrimo($num)
    {
        if ($num < 2) return false;
        if ($num === 2) return true;
        if ($num % 2 === 0) return false;
        $limite = sqrt($num);
        for ($i = 3; $i <= $limite; $i += 2) {
            if ($num % $i === 0) return false;
        }
        return true;
    }

    

}
