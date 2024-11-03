<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>
<body>
    <h1>Lista de Usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->getNombre() }}</td>
                    <td>
                        <a href="{{ route('users.edit', $usuario->getId()) }}">Editar</a>
                        <form action="{{ route('users.destroy', $usuario->getId()) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('users.create') }}">Crear Usuario</a>
    

    <br>
    <a href="{{ url('/home') }}">Volver al inicio</a> 

</body>
</html>
