<?php
// Inicializar variables
$numeros = [];
$impares = [];
$pares = [];

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la cadena de números
    $cadena = trim($_POST['numeros']);
    
    // Dividir la cadena en un array usando explode
    $numeros = explode(" ", $cadena);
    
    // Separar los números en impares y pares
    foreach ($numeros as $numero) {
        if (is_numeric($numero)) {
            if ($numero % 2 == 0) {
                $pares[] = (int)$numero; // Convertir a entero
            } else {
                $impares[] = (int)$numero; // Convertir a entero
            }
        }
    }

    // Ordenar los números impares y pares
    usort($impares, fn($a, $b) => $a - $b); // Ordenar impares
    usort($pares, fn($a, $b) => $a - $b); // Ordenar pares
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números Impares y Pares</title>
</head>
<body>
    <h1>Introducir Números</h1>
    <form method="post" action="">
        <label for="numeros">Introduce una cadena de números separados por espacios:</label><br>
        <input type="text" id="numeros" name="numeros" required>
        <button type="submit">Mostrar Números</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <h2>Números Impares:</h2>
        <ul>
            <?php foreach ($impares as $numero): ?>
                <li><?php echo $numero; ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Números Pares:</h2>
        <ul>
            <?php foreach ($pares as $numero): ?>
                <li><?php echo $numero; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
