<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function login(Request $request)
    {
        $request->session()->put('nick', $request->input('nick'));
        return redirect('/home');
    }

    public function showHome(Request $request)
    {
        if (!$request->session()->has('nick')) {
            return redirect('/');
        }

        $nick = $request->session()->get('nick');
        return view('home', ['nick' => $nick]);
    }

    public function createFile(Request $request)
    {
        // Redirigir al editor y pasarle el nombre del fichero
        return redirect('/editor')->with('file_name', $request->input('file_name'));
    }

    public function showEditor(Request $request)
    {
        $fileName = $request->session()->get('file_name', ''); // Obtener el nombre del fichero si existe
        return view('editor', ['contenido' => '', 'file_name' => $fileName]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('nick');
        return redirect('/');
    }

    public function storeFile(Request $request)
    {
        $contenido = $request->input('contenido');
        $fileName = $request->input('file_name');
        $fileType = $request->input('file_type'); // Si decides incluir tipo

        // Obtener los archivos actuales de la sesión o inicializarlos si no existen
        $files = session('files', []);

        // Agregar el nuevo archivo a la sesión
        $files[] = [
            'name' => $fileName,
            'content' => $contenido,
            'private' => $fileType === 'private', // Ajusta esto según tu lógica
            'created_at' => now(),
        ];

        // Almacenar los archivos actualizados en la sesión
        $request->session()->put('files', $files);

        return redirect('/home'); // Redirigir al Home después de guardar el archivo
    }

    public function redirectEditor(Request $request)
    {
        // Guardar el tipo de archivo en la sesión
        $request->session()->put('file_type', $request->input('file_type'));

        // Redirigir al editor
        return redirect('/editor');
    }
}

