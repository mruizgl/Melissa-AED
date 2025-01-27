<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Figura</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <meta name="author" content="Melissa Ruiz">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .alert {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="file"] {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 5px;
            width: 100%;
            margin-bottom: 10px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        .image-item {
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
            padding: 10px;
            transition: transform 0.2s;
        }
        .image-item:hover {
            transform: scale(1.05);
        }
        .image-item img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            padding: 10px 15px;
            border: 1px solid #007bff;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s, border-color 0.3s;
        }
        .back-link:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    @php
        use App\Contracts\FiguraContract;
    @endphp

    <div class="container">
        <h1>Subir Imagen de Figura</h1>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <form action="{{ route('figuras.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="imagen">Selecciona una imagen:</label>
                <input type="file" name="imagen" id="imagen" required>
            </div>
            <button type="submit">Subir Imagen</button>
        </form>

        <h2 class="mt-5">Imágenes Subidas</h2>
        <div class="image-gallery">
            @foreach($figuras as $figura)
                <div class="image-item">
                    <img src="data:image/png;base64,{{ base64_encode($figura[FiguraContract::COL_IMAGEN]) }}" alt="Imagen de Figura" />
                    <form action="{{ route('figuras.destroy', $figura[FiguraContract::COL_ID]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta imagen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">Eliminar Imagen</button>
                    </form>
                </div>
            @endforeach
        </div>

        <a href="{{ url('/home') }}" class="back-link">Volver al inicio</a>
    </div>
</body>
</html>
