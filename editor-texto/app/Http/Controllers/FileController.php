<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function createFile(Request $request)
    {
        $request->session()->put('file_name', $request->input('file_name'));
        $request->session()->put('file_type', $request->input('file_type'));

        return redirect('/editor');
    }


    public function showEditor(Request $request)
    {
        $fileName = $request->session()->get('file_name', '');
        $usuario = $request->session()->get('nick');
        $filePath = "/$usuario/$fileName.txt";

        $contenido = Storage::exists($filePath) ? Storage::get($filePath) : '';

        return view('editor', [
            'contenido' => $contenido,
            'file_name' => $fileName,
        ]);
    }

    public function storeFile(Request $request)
    {
        $this->comprobarUser();

        $contenido = $request->input('contenido');
        $fileName = $request->session()->get('file_name');
        $fileType = $request->input('file_type');
        $usuario = $request->session()->get('nick');

        $filePathName = $fileName . '_' . $usuario . '.txt';

        if ($fileType === 'private') {
            $directory = "/private/" . $usuario;
        } else {
            $directory = "/shared";
        }

        Storage::makeDirectory($directory, 0755, true);

        $filePath = $directory . "/" . $filePathName;

        Storage::put($filePath, $contenido);

        return redirect('/home')->with('success', 'Archivo guardado correctamente.');
    }


    public function crearListarCarpetaUsuario(Request $request)
    {
        $this->comprobarUser();

        $usuario = $request->session()->get('nick');

        $privados = Storage::files("private/" . $usuario);
        $compartidos = Storage::files("shared");

        $privados = is_array($privados) ? $privados : [];
        $compartidos = is_array($compartidos) ? $compartidos : [];

        return view('home', compact('privados', 'compartidos', 'usuario'));
    }



    public function comprobarUser()
    {
        if (!session()->has('nick')) {
            return redirect()->route('login')->send();
        }
    }
}
