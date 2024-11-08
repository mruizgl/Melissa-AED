<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Alumno</title>
</head>
<body>
    <h1>Información del Alumno</h1>

    <p><strong>Nombre:</strong> {{ $alumno->nombre }}</p>
    <p><strong>Apellidos:</strong> {{ $alumno->apellidos }}</p>
    <p><strong>Edad:</strong> {{ $alumno->edad }}</p>
</body>
</html>
