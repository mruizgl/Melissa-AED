<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de lógica del juego
$message = include 'game_logic.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Adivinar el Número</title>
</head>
<body>
    <h1>Juego de Adivinar el Número</h1>
    <form method="post">
        <label for="guess">Adivina un número del 1 al 10:</label>
        <input type="number" name="guess" id="guess" min="1" max="10" required>
        <button type="submit">Adivinar</button>
    </form>
    <p><?php echo $message; ?></p>
    <h2>Historial de Intentos:</h2>
    <pre><?php echo file_get_contents('attempts.txt'); ?></pre>
</body>
</html>