<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->session()->put('nick', $request->input('nick'));
        return redirect()->action([FileController::class, 'crearListarCarpetaUsuario']);
    }

    public function showHome(Request $request)
    {
        if (!$request->session()->has('nick')) {
            return redirect('/');
        }

        $nick = $request->session()->get('nick');
        return view('home', ['nick' => $nick]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('nick');
        return redirect('/');
    }
}
