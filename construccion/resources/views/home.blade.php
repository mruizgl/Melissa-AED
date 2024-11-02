<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tableros</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>

    <main>
        <h2>Mis Tableros</h2>

        @if($tableros->isEmpty())
            <p>No tienes tableros creados. ¡Crea uno!</p>
        @else
            <ul>
                @foreach($tableros as $tablero)
            <li>
                <strong>{{ $tablero['nombre'] }}</strong><br> 
                <em>{{ date('d/m/Y H:i:s', $tablero['fecha']) }}</em>
                <br>
                <a href="{{ url('/tableros/' . $tablero['id']) }}">Ver Tablero</a>
            </li>
        @endforeach
            </ul>
        @endif
        <div>
            <a href="{{ url('/tableros/create') }}">Crear Tablero</a>
            
        </div>
        <div>
            <a href="{{ url('/') }}">Cerrar Sesión</a>
        </div>
    </main>
</body>
</html>
