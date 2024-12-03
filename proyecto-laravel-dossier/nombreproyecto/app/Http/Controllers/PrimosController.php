<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimosController extends Controller
{
    public function index()
    {
        return view('primos.index');
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
            return view('primos.resultado', compact('primos', 'cantidad'));
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
