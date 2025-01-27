<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar CSV</title>
</head>
<body>
    <h1>Contenido del Archivo CSV</h1>

    @if ($contenido && count($contenido) > 0)
        <table>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
            @foreach ($contenido as $row)
                <tr>
                    <td>{{ $row[0] }}</td>
                    <td>{{ $row[1] }}</td>
                    <td>
                        <!-- Botón para eliminar el archivo CSV -->
                        <form action="{{ route('archivos.borrar', $row[0]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este archivo?');">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No hay datos en el archivo CSV.</p>
    @endif

    <a href="{{ route('csv.create') }}">Regresar</a>
</body>
</html>
