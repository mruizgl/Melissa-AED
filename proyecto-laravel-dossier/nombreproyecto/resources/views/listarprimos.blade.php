<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Tiempo desde 1970:</h2>

    @for ($i = 0; $i < 3; $i++)
        <p>Iteración {{ $i + 1 }}: Segundos desde 1970: {{ time() }}</p>
        @php sleep(1); @endphp
    @endfor


    <h2>Numeros primos:</h2>
    <p>Son las {{ date('H:i')}} del día {{date('d/m')}} </p>
    @foreach ($coleccion as $primo)
    <p> primo: {{$primo}} </p>
    @endforeach
</body>
</html>
