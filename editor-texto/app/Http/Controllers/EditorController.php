<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EditorController extends Controller

{
    public function editorpost(Request $request){


        $contenido = $request->contenido;

        Storage::put($this->$contenido);
        echo "se ha grabado en el fichero";
    }

    public function editorget(){

        //$contenido = Storage::get($this->nombreficheroejemplo)??"$this->nombreficheroejemplo está vacío";


        return view('editor',compact('contenido'));



    }


}


