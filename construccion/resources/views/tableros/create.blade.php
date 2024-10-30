<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tablero</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Agrega tu archivo CSS si lo tienes -->
</head>
<body>
    <header>
        <h1>Crear Tablero</h1>
        <nav>
            <a href="{{ url('/home') }}">Volver a Mis Tableros</a>
            <a href="{{ url('/logout') }}">Cerrar Sesión</a>
        </nav>
    </header>

    <main>
        <form method="POST" action="{{ url('/tableros') }}">
            @csrf
            <label for="nombre">Nombre del Tablero:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="contenido">Contenido (opcional):</label>
            <textarea id="contenido" name="contenido"></textarea>

            <button type="submit">Crear Tablero</button>
        </form>

        @if ($errors->any())
            <div>
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </main>
</body>
</html>
