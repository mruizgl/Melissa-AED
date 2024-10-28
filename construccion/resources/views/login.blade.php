<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="POST" action="{{ url('/login') }}">
        @csrf
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Iniciar Sesión</button>
    </form>

    <p><a href="{{ url('/register') }}">Regístrate</a></p>

  
</body>
</html>
