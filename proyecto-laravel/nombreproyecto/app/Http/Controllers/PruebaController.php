<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
