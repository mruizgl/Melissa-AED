<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tablero</title>
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">

</head>
<body>
    <header>
        <h1>Editar Tablero</h1>
        <nav>
            <a href="{{ url('/home') }}">Volver</a>
        </nav>
    </header>

    <h2>Tablero: {{ $tablero->nombre }}</h2>
    
    <form action="{{ url('tableros/add-figure') }}" method="POST">
        @csrf
        <input type="hidden" name="tablero_id" value="{{ $tablero->id }}">
        <input type="hidden" id="selected_cell" name="posicion" value="">

        <div class="tablero">
            @for ($row = 0; $row < 4; $row++)
                @for ($col = 0; $col < 7; $col++)
                    <div class="casilla" onclick="selectCell(this, '{{ $row * 7 + $col }}')">
                        @php
                            $figura = $figurasEnTablero->where('posicion', $row * 7 + $col)->first();
                        @endphp
                        @if($figura)
                            <img src="data:image/png;base64,{{ base64_encode($figura->imagen) }}" alt="{{ $figura->tipo_imagen }}">
                        @endif
                    </div>
                @endfor
            @endfor
        </div>

        <h3>Selecciona una Figura:</h3>
        <div class="figura-selection">
            @foreach ($figuras as $figura)
                <label class="figura-button">
                    <input type="radio" name="figura_id" value="{{ $figura->id }}" required>
                    <img src="data:image/png;base64,{{ base64_encode($figura->imagen) }}" alt="{{ $figura->tipo_imagen }}" style="max-width:50px; max-height:50px;">
                </label>
            @endforeach
        </div>

        <button type="submit">Guardar</button>
    </form>

    <script>
        function selectCell(cell, position) {
            const previousSelected = document.querySelector('.casilla.selected');
            if (previousSelected) {
                previousSelected.classList.remove('selected');
            }
            cell.classList.add('selected');
            document.getElementById('selected_cell').value = position; 
        }
    </script>
</body>
</html>
