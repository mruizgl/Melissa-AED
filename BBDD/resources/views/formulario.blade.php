<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Moneda e Histórico</title>
</head>
<body>
    <h1>Guardar Moneda e Histórico</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul style="color: red;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('moneda.guardar') }}" method="POST">
        @csrf
        <label for="pais">País:</label>
        <input type="text" id="pais" name="pais" required>
        <br><br>

        <label for="nombre">Nombre de la moneda:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="equivalenteeuro">Equivalente al Euro:</label>
        <input type="text" id="equivalenteeuro" name="equivalenteeuro" required>
        <br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>
        <br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
