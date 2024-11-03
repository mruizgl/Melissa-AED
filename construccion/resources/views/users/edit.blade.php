<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="{{ route('users.update', $usuario->getId()) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ $usuario->getNombre() }}" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="{{ route('users.index') }}">Volver a la lista de usuarios</a>
</body>
</html>
