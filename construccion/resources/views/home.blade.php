<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Tableros</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header>
        <h1>Mis Tableros</h1>
        <nav>
            <a href="{{ url('/tableros/create') }}">Crear Tablero</a>
            <a href="{{ url('/') }}">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <h2>Mis Tableros</h2>

        @if($tableros->isEmpty())
            <p>No tienes tableros creados. ¡Crea uno!</p>
        @else
            <ul>
                @foreach($tableros as $tablero)
                    <li>
                        <strong>{{ $tablero->getNombre() }}</strong><br>
                        <em>{{ date('d/m/Y H:i:s', $tablero->getFecha()) }}</em>
                        <br>
                        <a href="{{ url('/tableros/' . $tablero->getId()) }}">Ver Tablero</a>
                    </li>
                @endforeach
            </ul>
        @endif
    </main>
</body>
</html>
