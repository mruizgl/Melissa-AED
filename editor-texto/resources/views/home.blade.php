<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Bienvenido, {{ $nick }}</h1>
    <h2>Tus Ficheros Privados</h2>
    <ul>
        @if(session('files'))
            @foreach(session('files') as $file)
                <li>
                    {{ $file['name'] }}
                    ({{ $file['private'] ? 'Privado' : 'Compartido' }})
                </li>
            @endforeach
        @else
            <li>No tienes ficheros guardados.</li>
        @endif
    </ul>

    <h2>Crear Nuevo Fichero</h2>
    <form action="/redirect-editor" method="POST">
        @csrf
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
