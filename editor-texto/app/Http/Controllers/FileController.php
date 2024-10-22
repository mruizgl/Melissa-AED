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
        $usuario = $request->session()->get('usuario');

        // Asegúrate de que los valores de sesión estén presentes
        if (!$fileName || !$usuario) {
            dd('Valores de sesión no disponibles: ', $fileName, $usuario);
        }

        // Ruta del archivo
        $filePath = "private/{$usuario}/{$fileName}_{$usuario}.txt";

        // Verifica si el archivo existe y carga su contenido
        if (Storage::disk('local')->exists($filePath)) {
            $contenido = Storage::disk('local')->get($filePath);
        } else {
            dd('El archivo no existe en la ruta especificada: ' . $filePath);
        }

        // Retorna la vista con el contenido del archivo
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
        $usuario = $request->session()->get('usuario');

        $filePathName = $fileName . '_' . $usuario . '.txt';

        if ($fileType === 'private') {
            $directory = "/private/" . $usuario;
        } else {
            $directory = "/shared";
        }

        Storage::makeDirectory($directory, 0755, true);
        $filePath = $directory . "/" . $filePathName;
        Storage::put($filePath, $contenido);
        //dd($filePath, $contenido);
        return $this->crearListarCarpetaUsuario($request);
    }

    public function crearListarCarpetaUsuario(Request $request)
    {
        $this->comprobarUser();
        $usuario = $request->session()->get('usuario'); // Cambiado de 'nick' a 'usuario'

        // Listar archivos privados del usuario
        $privados = Storage::files("private/{$usuario}");
        // Listar archivos compartidos
        $compartidos = Storage::files("shared");

        // Manejar el caso donde no hay archivos
        $privados = is_array($privados) ? $privados : [];
        $compartidos = is_array($compartidos) ? $compartidos : [];

        return view('home', compact('privados', 'compartidos', 'usuario'));
    }

    public function edit($file)
    {
        $usuario = session('usuario'); // Cambiado de 'nick' a 'usuario'
        $filePath = "private/{$usuario}/{$file}";

        if (Storage::exists($filePath)) {
            $content = Storage::get($filePath);
            return view('editor', ['content' => $content, 'fileName' => $file]);
        } else {
            return redirect()->back()->with('error', 'Archivo no encontrado.');
        }
    }

    public function comprobarUser()
    {
        if (!session()->has('usuario')) { // Cambiado de 'nick' a 'usuario'
            return redirect()->route('login')->send();
        }
    }

    public function seleccionarArchivo(Request $request, $fileName)
    {
    $request->session()->put('file_name', $fileName); // Guardar el nombre del archivo en la sesión
    return redirect()->route('editor');  // Redirigir al editor
    }
}
