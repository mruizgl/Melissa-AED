<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir CSV</title>
</head>
<body>
    <h1>Subir un Archivo CSV</h1>

    @if (session('data'))
    <h2>Contenido del Archivo CSV:</h2>
    <ul>
        @foreach (session('data') as $row)
            <li>{{ implode(', ', $row) }}</li>
        @endforeach
    </ul>
@endif
</body>
</html>
