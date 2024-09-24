<?php
session_start();

// Generar un número aleatorio si no existe uno en la sesión
if (!isset($_SESSION['number'])) {
    $_SESSION['number'] = rand(1, 10);
}

// Manejar la entrada del usuario
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['guess'])) {
        $guess = intval($_POST['guess']);
        $number = $_SESSION['number'];

        // Guardar el intento en un archivo
        file_put_contents('attempts.txt', "Intento: $guess\n", FILE_APPEND);

        // Comprobar si el intento es correcto
        if ($guess < $number) {
            $message = "El número es mayor que $guess.";
        } elseif ($guess > $number) {
            $message = "El número es menor que $guess.";
        } else {
            $message = "¡Correcto! El número era $number. Reiniciando el juego.";
            // Reiniciar el juego
            unset($_SESSION['number']);
        }
    } else {
        $message = "Por favor, ingresa un número.";
    }
}

return $message; // Devolvemos el mensaje para usarlo en el archivo principal