<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Imágenes de la practica de ejemplo: </p>
    <p>Token CSRF: {{ csrf_token() }}</p>
    <img src="{{ asset('img/imagen1.jpeg') }}" alt="Imagen 1" style="width: 200px; height: 200px; object-fit: cover;">
    <img src="{{ asset('img/imagen2.jpg') }}" alt="Imagen 2" style="width: 200px; height: 200px; object-fit: cover;">
    <img src="{{ asset('img/imagen3.jpeg') }}" alt="Imagen 3" style="width: 200px; height: 200px; object-fit: cover;">
    <img src="{{ asset('img/imagen4.jpeg') }}" alt="Imagen 4" style="width: 200px; height: 200px; object-fit: cover;">
    <img src="{{ asset('img/imagen5.jpg') }}" alt="Imagen 5" style="width: 200px; height: 200px; object-fit: cover;">
</body>
</html>