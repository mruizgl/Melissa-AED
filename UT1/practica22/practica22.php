<?php
// Primer bucle: Agregar números del 1 al 10 al array usando array_unshift
$array = [];

for ($i = 1; $i <= 10; $i++) {
    array_unshift($array, $i); // Agregar número al principio del array
    echo "Contenido del array en la iteración $i: ";
    print_r($array); // Mostrar contenido del array
}

echo "\n";

// Segundo bucle: Ejecutar array_shift() de 1 a 5
for ($j = 1; $j <= 5; $j++) {
    array_shift($array); // Eliminar el primer elemento del array
    echo "Contenido del array después de la iteración $j: ";
    print_r($array); // Mostrar contenido del array
}
?>
