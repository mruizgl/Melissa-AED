<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Números Primos</title>
</head>
<body>
    <h1>Resultados</h1>
    <p>Se calcularon los primeros {{ $cantidad }} números primos:</p>
    <div style="max-height: 400px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
        {{ implode(', ', $primos) }}
    </div>
    <a href="/">Volver</a>
</body>
</html>
