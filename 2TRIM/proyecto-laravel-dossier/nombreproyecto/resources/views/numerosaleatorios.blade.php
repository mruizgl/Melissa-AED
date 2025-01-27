<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="antialiased">
    <h2>Números menores a 50:</h2>
    @foreach ($array as $dato)
        @if ($dato < 50)
            <p>Dato par: {{ $dato }}</p>
        @endif
    @endforeach

    <h2>Números mayores a 50:</h2>
    @foreach ($array as $dato)
        @if ($dato > 50)
            <p>Dato impar: {{ $dato }}</p>
        @endif
    @endforeach

</body>
</html>
