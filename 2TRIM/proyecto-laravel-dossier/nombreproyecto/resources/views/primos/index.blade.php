<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Números Primos</title>
</head>
<body>
    <h1>Cálculo de Números Primos</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="color: red;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/calcular" method="POST">
        @csrf
        <label for="cantidad">Introduce la cantidad de números primos:</label>
        <input type="number" id="cantidad" name="cantidad" required>
        <button type="submit">Calcular</button>
    </form>
</body>
</html>
