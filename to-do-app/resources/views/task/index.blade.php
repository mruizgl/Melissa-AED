<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicación To-Do</title>
</head>
<body>
    <form action="{{ url('/') }}" method="post">
        @csrf <!-- identifica que es un formulario propio de la aplicacion, importante TOKEN-->
        <input type="text" name="task" id="task">
        <input type="submit" value="Agregar tarea">

    </form>
    <br/>
    <table border="1">
        <tr>
            <td> Nombre de la tarea </td>
            <td> Acción </td>
        </tr>

        @foreach ($tasks as $task)
        <tr>
            <td> {{ $task->task}} </td>
            <td>
                <form action="{{ route('task.destroy', $task->id) }}" method="post">
                    @csrf <!-- permityo la recepcion de los datos -->
                    @method('DELETE')
                    <input type="submit" value="x">
                </form>
            </td>
        </tr>
        @endforeach

    </table>

</body>
</html>
