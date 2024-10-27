<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Archivos</title>
</head>
<body>
    <h1>Lista de Archivos</h1>

    <table>
        <tr>
            <th>Nombre del Archivo</th>
            <th>Acciones</th> 
        </tr>
        @foreach ($archivos as $archivo)
            <tr>
                <td>{{ basename($archivo) }}</td> 
                <td>
                    <form action="{{ route('archivos.borrar', basename($archivo)) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">Eliminar</button>
                    </form>
                    <a href="{{ route('archivos.descargar', basename($archivo)) }}">Descargar</a>
                </td>
            </tr>
        @endforeach
    </table>

</body>
</html>
