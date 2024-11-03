<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tablero</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <header class="header">
        <h1>Crear Tablero</h1>
    </header>

    <main class="main-container">
        <form method="POST" action="{{ url('/tableros') }}" class="form-container">
            @csrf
            <label for="nombre" class="form-label">Nombre del Tablero:</label>
            <input type="text" id="nombre" name="nombre" class="form-input" required>

            <button type="submit" class="form-button">Crear Tablero</button>
        </form>

        @if ($errors->any())
            <div class="error-container">
                <strong>Error:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <nav class="nav-links">
            <a href="{{ url('/home') }}" class="link">Volver a Mis Tableros</a>
            <a href="{{ url('/logout') }}" class="link no-style">Cerrar Sesión</a>
        </nav>
    </main>
</body>
</html>
