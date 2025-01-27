<?php
// Inicializar una cadena vacía para almacenar el resultado
$resultado = "";

// Calcular las potencias del 2 desde 2^1 hasta 2^9
for ($i = 1; $i <= 9; $i++) {
    // Calcular 2 elevado a la potencia $i
    $potencia = 2 ** $i;

    // Concatenar el resultado a la cadena
    $resultado .= "2^$i = $potencia<br>";
}

// Mostrar el resultado final
echo $resultado;
?>