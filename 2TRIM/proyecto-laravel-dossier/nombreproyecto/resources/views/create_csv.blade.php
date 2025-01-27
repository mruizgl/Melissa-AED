<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear CSV</title>
</head>
<body>
    <h1>Crear Archivo CSV</h1>
    <form action="{{ route('csv.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required>
        
        <label for="email">Correo:</label>
        <input type="email" name="email" id="email" required>

        <button type="submit">Crear CSV</button>
    </form>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif
</body>
</html>
