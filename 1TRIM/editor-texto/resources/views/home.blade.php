<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>
    <h1>Bienvenido, {{ $usuario }}</h1>

    <!-- Listado de archivos privados -->
    <h2>Tus Ficheros Privados</h2>
    <ul>
        @forelse ($privados as $file)
            <li><a href="{{ route('editFile', ['file' => basename($file)]) }}">{{ basename($file) }}</a></li>
        @empty
            <li>No tienes ficheros privados guardados.</li>
        @endforelse
    </ul>

    <!-- Listado de archivos compartidos -->
    <h2>Ficheros Compartidos</h2>
    <ul>
        @forelse ($compartidos as $file)
            <li><a href="{{ route('editFile', ['file' => basename($file)]) }}">{{ basename($file) }}</a></li>
        @empty
            <li>No hay archivos compartidos disponibles.</li>
        @endforelse
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
