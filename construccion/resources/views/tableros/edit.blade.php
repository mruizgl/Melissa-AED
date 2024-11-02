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
    <div class="tablero">
        @for ($row = 0; $row < 4; $row++) <!-- Cambiado para filas -->
            @for ($col = 0; $col < 7; $col++) <!-- Cambiado para columnas -->
                <div class="casilla" onclick="selectCell(this)" data-row="{{ $row }}" data-col="{{ $col }}">
                    @php
                        $figura = $figurasEnTablero->where('posicion', $row * 7 + $col)->first();
                    @endphp
                    @if($figura)
                        <div class="figure">
                            <img src="data:image/png;base64,{{ base64_encode($figura->imagen) }}" alt="{{ $figura->tipo_imagen }}">
                        </div>
                    @endif
                </div>
            @endfor
        @endfor
    </div>

    <!-- Sección para seleccionar figuras -->
    <h3>Selecciona una Figura:</h3>
    <div class="figura-selection">
        @foreach ($figuras as $figura)
            <div class="figura-button" onclick="addFigure('{{ $figura->tipo_imagen }}', 'data:image/png;base64,{{ base64_encode($figura->imagen) }}', this)">
                <img src="data:image/png;base64,{{ base64_encode($figura->imagen) }}" alt="{{ $figura->tipo_imagen }}">
            </div>
        @endforeach
    </div>

    <script>
        let selectedCell = null;

        function selectCell(cell) {
            if (selectedCell) {
                selectedCell.style.border = "1px solid #ddd"; 
            }
            selectedCell = cell;
            selectedCell.style.border = "2px solid blue"; 
        }

        function addFigure(figureType, figureSrc) {
            if (!selectedCell) {
                alert('Por favor, selecciona una celda en el tablero.');
                return;
            }
            const img = document.createElement('img');
            img.src = figureSrc; 
            img.alt = figureType; 
            selectedCell.innerHTML = ''; // Limpia la celda
            selectedCell.appendChild(img); // Añade la imagen
            alert(`Figura ${figureType} añadida en la celda (${selectedCell.dataset.row}, ${selectedCell.dataset.col}).`);
            selectedCell.style.border = "1px solid #ddd"; 
            selectedCell = null;
        }
    </script>
</body>
</html>
