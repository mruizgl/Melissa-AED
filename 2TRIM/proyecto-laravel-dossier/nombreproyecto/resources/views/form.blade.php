<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar Palabras</title>
</head>
<body>

    <h2>Ingresar Palabras</h2>
    <form action="{{ route('palabras.process') }}" method="POST">
        @csrf
        <label for="palabras">Ingresa palabras separadas por comas:</label><br>
        <textarea name="palabras" id="palabras" rows="4" cols="50"></textarea><br><br>
        <button type="submit">Enviar</button>
    </form>

</body>
</html>
