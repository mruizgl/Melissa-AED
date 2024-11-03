<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Figura</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    @php
        use App\Contracts\FiguraContract;
    @endphp

    <h1>Subir Imagen de Figura</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form action="{{ route('figuras.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="imagen">Selecciona una imagen:</label>
            <input type="file" name="imagen" id="imagen" required>
        </div>
        <button type="submit">Subir Imagen</button>
    </form>

    <h2>Imágenes Subidas</h2>
    <div class="image-gallery">
        @foreach($figuras as $figura)
            <div class="image-item">
                <img src="{{ asset('images/' . $figura[FiguraContract::COL_IMAGEN]) }}" alt="Imagen de Figura" />
                <form action="{{ route('figuras.destroy', $figura[FiguraContract::COL_ID]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar Imagen</button>
                </form>
            </div>
        @endforeach
    </div>

    <a href="{{ url('/') }}">Volver al inicio</a>

    <style>
        .image-gallery {
            display: flex;
            flex-wrap: wrap;
        }
        .image-item {
            margin: 10px;
            text-align: center;
        }
        .image-item img {
            max-width: 150px;
            height: auto;
            display: block;
        }
    </style>
</body>
</html>
