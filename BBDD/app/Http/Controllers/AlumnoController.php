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


    public function guardar(Request $request)
    {
        $request->validate([
            'pais' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'equivalenteeuro' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Guardar la moneda
                $moneda = Moneda::create([
                    'pais' => $request->pais,
                    'nombre' => $request->nombre,
                ]);

                // Validar si el equivalente es numérico antes de guardar
                if (!is_numeric($request->equivalenteeuro)) {
                    throw new \Exception('El equivalente al euro debe ser un número');
                }

                // Guardar el histórico
                Historico::create([
                    'moneda_id' => $moneda->id,
                    'equivalenteeuro' => $request->equivalenteeuro,
                    'fecha' => $request->fecha,
                ]);
            });

            return redirect()->back()->with('success', 'Moneda e histórico guardados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function buscarMatriculas()
    {
        // Buscar matrículas para alumnos que incluyen "Ana" en su nombre y hechas después de 2020
        $resultados = DB::table('matriculas')
            ->join('alumnos', 'matriculas.dni', '=', 'alumnos.dni')
            ->where('alumnos.nombre', 'LIKE', '%Ana%') // Buscamos "Ana" en el nombre
            ->where('matriculas.year', '>', 2020) // Año mayor que 2020
            ->select('matriculas.*', 'alumnos.nombre as alumno_nombre', 'alumnos.dni as alumno_dni')
            ->get();

        // Mostrar los resultados (por ejemplo, en formato JSON)
        return response()->json($resultados);
    }
    public function crearObjetos()
    {
        DB::transaction(function () {
            // Crear el alumno Elvira
            $alumnoId = DB::table('alumnos')->insertGetId([
                'nombre' => 'Elvira',
                'apellidos' => 'Lindo',
                'dni' => '35792468Q',
                'created_at' => now(),
                'updated_at' => now(),
                'fecha_nacimiento' => date('Y-m-d H:i:s', 821234400000 / 1000), // Convertir el timestamp de milisegundos a segundos
            ]);

            // Crear la matrícula para Elvira en el año 2024
            $matriculaId = DB::table('matriculas')->insertGetId([
                'dni' => '35792468Q',
                'year' => 2024,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Obtener los IDs de las asignaturas PRO y LND
            $asignaturas = DB::table('asignaturas')
                ->whereIn('nombre', ['PRO', 'LND'])
                ->pluck('id');

            // Insertar en la tabla intermedia asignatura_matricula
            foreach ($asignaturas as $asignaturaId) {
                DB::table('asignatura_matricula')->insert([
                    'idasignatura' => $asignaturaId,
                    'idmatricula' => $matriculaId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        return "Objetos creados con éxito.";
    }
    use App\Http\Controllers\AlumnoController;

    




   


}
