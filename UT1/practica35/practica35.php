<?php
// Inicializar variables
$numero = null;
$error = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el número ingresado
    $numero = $_POST['numero'];
    
    // Validar que el número sea un entero positivo
    if (filter_var($numero, FILTER_VALIDATE_INT) !== false && $numero > 0) {
        // Es un entero positivo
        $numero = intval($numero);
    } else {
        // Si no es válido, establecer un mensaje de error
        $error = "Por favor, introduce un número entero positivo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Multiplicar</title>
</head>
<body>
    <h1>Tabla de Multiplicar</h1>
    <form method="post" action="">
        <label for="numero">Introduce un número entero positivo:</label>
        <input type="number" id="numero" name="numero" required>
        <button type="submit">Mostrar Tabla</button>
    </form>

    <?php if ($error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php elseif ($numero !== null): ?>
        <h2>Tabla de multiplicar del <?php echo $numero; ?></h2>
        <table border="1">
            <tr>
                <th>Multiplicación</th>
                <th>Resultado</th>
            </tr>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <tr>
                    <td><?php echo "$numero x $i"; ?></td>
                    <td><?php echo $numero * $i; ?></td>
                </tr>
            <?php endfor; ?>
        </table>
    <?php endif; ?>
</body>
</html>
