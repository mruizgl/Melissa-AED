<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tablero</title>
</head>
<body>

<h3>Seleccionar figura</h3>

<div>
    @foreach ($figuras as $figura)
        <label>
            <input type="radio" name="figura_id" value="{{ $figura->id }}">
            <img src="data:{{ $figura->tipo_imagen }};base64,{{ base64_encode($figura->imagen) }}" alt="Figura" width="50">
        </label>
    @endforeach
</div>



</body>
</html>
