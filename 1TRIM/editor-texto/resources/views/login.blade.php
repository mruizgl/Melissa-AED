<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <div>Login:</div>
    <form action="/login" method="post"> 
        @csrf
        <input type="text" name="nick" placeholder="usuario" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
