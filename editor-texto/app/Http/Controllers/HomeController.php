<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function login(Request $request)
    {
        $request->session()->put('nick', $request->input('nick'));
        $nick = $request->session()->get('nick');

        $privados = Storage::files("private/" . $nick);
        $compartidos = Storage::files("shared");

        $privados = is_array($privados) ? $privados : [];
        $compartidos = is_array($compartidos) ? $compartidos : [];

        return view('home', compact('privados', 'compartidos', 'nick'));
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
