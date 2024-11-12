<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Moneda;
use App\Models\Historico;
use Carbon\Carbon;


class AlumnoController extends Controller
{
    public function show($id)
    {
        // Habilita el registro de consultas
        DB::connection()->enableQueryLog();

        // Realiza la consulta de búsqueda del alumno con el ID proporcionado
        $alumno = Alumno::find($id);

        // Obtiene la última consulta ejecutada
        $lastQuery = DB::getQueryLog();

        // Muestra la consulta en pantalla
        dd($lastQuery);

        // Retorna la vista con los datos del alumno
        return view('alumno.show', ['alumno' => $alumno]);
    }

    public function listar()
    {
        // Recuperar todos los alumnos de la base de datos
        $alumnos = Alumno::all();

        // Iterar sobre la colección de alumnos y mostrar sus atributos
        foreach ($alumnos as $alumno) {
            // Mostrar el alumno en formato de texto
            echo '<br>' . $alumno->nombre . ' ' . $alumno->apellidos . ' - Edad: ' . $alumno->edad;

            // Mostrar los atributos del alumno como un array (opcional)
            // var_dump($alumno->attributesToArray());
        }
    }

    public function crearHistoricoDolar()
    {
        // Obtener la moneda 'Dólar' de la base de datos
        $dolar = Moneda::where('nombre', 'Dólar')->first();

        // Verificar si se encontró la moneda 'Dólar'
        if ($dolar) {
            // Obtener el tipo de cambio actual del dólar a euro (simulamos que es 1.10)
            $tipoCambioActual = 1.10; // Esto debe ser recuperado dinámicamente si tienes esta información
            
            // Calcular el nuevo tipo de cambio restando dos céntimos
            $nuevoTipoCambio = $tipoCambioActual - 0.02;

            // Crear un nuevo objeto 'Historico' con la fecha de pasado mañana y el nuevo tipo de cambio
            $historicoNuevo = new Historico();
            $historicoNuevo->fecha = Carbon::now()->addDays(2)->toDateString(); // Fecha de pasado mañana
            $historicoNuevo->equivalenteeuro = $nuevoTipoCambio; // Tipo de cambio ajustado
            $historicoNuevo->moneda_id = $dolar->id; // Asociar con la moneda dólar

            // Guardar el histórico asociado a la moneda dólar
            $dolar->historicos()->save($historicoNuevo);

            // Mostrar el histórico generado
            echo "Histórico generado: " . json_encode($historicoNuevo, JSON_UNESCAPED_UNICODE);
        } else {
            echo "Moneda Dólar no encontrada.";
        }
    }

    public function practica17()
    {
        // 1. Crear la moneda con create()
        Moneda::create([
            'nombre' => 'dólar',
            'pais' => 'Australia',
        ]);

        // 2. Buscar la moneda por país
        $moneda = Moneda::where('pais', 'Australia')->first();

        // 3. Mostrar el resultado de la búsqueda
        echo "Moneda creada: " . json_encode($moneda, JSON_UNESCAPED_UNICODE) . "<br>";

        // 4. Modificar el campo 'pais' a mayúsculas
        $moneda->pais = 'AUSTRALIA';

        // 5. Guardar los cambios usando save()
        $moneda->save();

        // 6. Mostrar el resultado después de modificar
        echo "Moneda modificada: " . json_encode($moneda, JSON_UNESCAPED_UNICODE) . "<br>";
    }

   


}
