<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $row)
                <!-- Saltar la primera fila si contiene los encabezados -->
                @if ($index == 0)
                    @continue
                @endif
                <tr>
                    <td>{{ $row[0] ?? 'Sin nombre' }}</td>
                    <td>{{ $row[1] ?? 'Sin correo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
