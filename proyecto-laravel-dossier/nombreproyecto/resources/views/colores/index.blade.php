<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Colores</title>
</head>
<body>
    <h1>Lista de Colores</h1>

    <form action="{{ route('colores.store') }}" method="POST">
        @csrf
        <label for="color">Nombre del Color:</label>
        <input type="text" id="color" name="color" required>
        <button type="submit">Añadir Color</button>
    </form>

    <h2>Colores introducidos:</h2>
    <ul>
        @forelse ($colores as $color)
            <li>{{ $color }}</li>
        @empty
            <p>No has introducido colores aún.</p>
        @endforelse
    </ul>
</body>
</html>
