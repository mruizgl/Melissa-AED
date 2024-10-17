<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorControl extends Controller
{

    private $nombreficheroejemplo="ejemplo.txt";

    public function editorpost(Request $request){


        $contenido = $request->contenido;

        Storage::put($this->nombreficheroejemplo,$contenido);
        echo "se ha grabado en el fichero: ". $this->nombreficheroejemplo;
    }

    public function editorget(){

        $contenido = Storage::get($this->nombreficheroejemplo)??"$this->nombreficheroejemplo está vacío";


        return view('editor',compact('contenido'));



    }


}
