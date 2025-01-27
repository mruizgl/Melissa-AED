<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
</head>
<body>
    <h1>Información del Usuario</h1>

    <form action="{{ route('usuario.store') }}" method="POST">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario['nombre']) }}">
        
        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" value="{{ old('edad', $usuario['edad']) }}">
        
        <label for="gustos">Gustos:</label>
        <input type="text" id="gustos" name="gustos" value="{{ old('gustos', $usuario['gustos']) }}">
        
        <button type="submit">Guardar Información</button>
    </form>

    <h2>Datos Guardados:</h2>
    <p><strong>Nombre:</strong> {{ $usuario['nombre'] ?: 'No especificado' }}</p>
    <p><strong>Edad:</strong> {{ $usuario['edad'] ?: 'No especificado' }}</p>
    <p><strong>Gustos:</strong> {{ $usuario['gustos'] ?: 'No especificado' }}</p>
</body>
</html>
