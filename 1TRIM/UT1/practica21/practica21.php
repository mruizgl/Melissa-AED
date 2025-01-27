<?php
// Primer bucle: Agregar números del 1 al 10 al array
$array = [];

for ($i = 1; $i <= 10; $i++) {
    $array[] = $i; // Agregar número al array
    echo "Contenido del array en la iteración $i: ";
    print_r($array); // Mostrar contenido del array
}

echo "\n";

// Segundo bucle: Ejecutar array_pop() de 1 a 5
for ($j = 1; $j <= 5; $j++) {
    array_pop($array); // Eliminar el último elemento del array
    echo "Contenido del array después de la iteración $j: ";
    print_r($array); // Mostrar contenido del array
}
?>
