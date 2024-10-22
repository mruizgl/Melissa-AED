<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Bienvenido, {{ $nick }}</h1>

    <h2>Tus Ficheros Privados</h2>
    <ul>
        @if (count($privados) > 0)
        @foreach ($privados as $file)
            <li>
                <a href="editor">{{ basename($file) }}</a>
            </li>
        @endforeach
    @else
        <li>No tienes ficheros privados guardados.</li>
    @endif
    </ul>

    <h2>Ficheros Compartidos</h2>
    <ul>
        @if (count($compartidos) > 0)
        @foreach ($compartidos as $file)
            <li>
                <a href="editor">{{ basename($file) }}</a>
            </li>
        @endforeach
    @else
        <li>No tienes ficheros privados guardados.</li>
    @endif
    </ul>

    <h2>Crear Nuevo Fichero</h2>
    <form action="{{ route('createFile') }}" method="POST">
        @csrf
        <label for="file_name">Nombre del Fichero:</label>
        <input type="text" name="file_name" required>

        <label for="file_type">Tipo:</label>
        <input type="radio" id="private" name="file_type" value="private" checked>
        <label for="private">Privado</label>
        <input type="radio" id="shared" name="file_type" value="shared">
        <label for="shared">Compartido</label>

        <button type="submit">Crear Fichero</button>
    </form>

    <a href="/logout">Cerrar Sesión</a>
</body>
</html>
