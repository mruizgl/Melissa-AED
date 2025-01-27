<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Palabras</title>
</head>
<body>

    <h2>Lista de Palabras en Mayúsculas</h2>
    <ul>
        @for ($i = 0; $i < count($palabras); $i++)
            <li>{{ $palabras[$i] }}</li>
        @endfor
    </ul>

</body>
</html>
