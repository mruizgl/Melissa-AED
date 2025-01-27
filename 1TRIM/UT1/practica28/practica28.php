<?php
function sumar($a, $b, $print): float
{
    $suma = $a + $b;
    if ($print) {
        echo "resultado suma: $suma <br>";
    }
    return $suma;
}

// Llamadas a la función
$sum1 = sumar(1, 2, false); // Sin imprimir
$sum2 = sumar(4, 5, true);  // Con imprimir

echo "las operaciones para sum1 y sum2 dan: $sum1 , $sum2";
?>
