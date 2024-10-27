<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Directorio</title>
</head>
<body>
    <h1>Crear un Nuevo Directorio</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('directorio.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre del Directorio:</label>
        <input type="text" id="nombre" name="nombre" required>

        <button type="submit">Crear Directorio</button>
    </form>
</body>
</html>
