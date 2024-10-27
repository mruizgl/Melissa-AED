<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @foreach ($colores as $col)
    <p>{($col)} </p>'
    @endforeach

    <form action="addcolor.php" method="post">
        @csrf
        <label for="color">Introduce un color</label>
        <input type="text" id="color" name="color">
        <button type="submit"> enviar </button>
    </form>
</body>
</html>
