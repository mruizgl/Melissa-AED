<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
    <meta name="author" content="Melissa Ruiz">
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="text-center mt-5">Iniciar Sesión</h1>
        <form method="POST" action="{{ url('/login') }}" class="bg-white p-4 rounded shadow mt-3">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>

            @if ($errors->has('login_error'))
                <div class="alert alert-danger mt-3">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <p class="text-center mt-3">
                <a href="{{ url('/register') }}">Regístrate</a>
            </p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
