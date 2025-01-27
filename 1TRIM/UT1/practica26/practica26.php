<?php
// Función de comparación utilizando el operador nave espacial
function cmp($a, $b) {
    return $a <=> $b; // Retorna -1, 0 o 1
}

// Array de números
$a = array(3, 2, 5, 6, 1);

// Ordenar el array utilizando la función de comparación
usort($a, "cmp");

// Mostrar el array ordenado
foreach ($a as $valor) {
    echo "$valor, ";
}
?>
