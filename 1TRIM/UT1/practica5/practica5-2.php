<?php
// Crear un array
$mivar = [];

// Introducir datos
array_push($mivar, "uno");

// Asignación a otras variables
$arr1 = $mivar; // Asignación por valor
$arr2 = &$mivar; // Asignación por referencia

// Modificar la posición cero de esas variables
$arr1[0] = "una variación"; // Cambia solo arr1
$arr2[0] = "variando array2"; // Cambia mivar y arr2

// Mostrar el contenido
echo "Contenido de mivar[0]: " . $mivar[0] . "\n";
echo "Contenido de arr1[0]: " . $arr1[0] . "\n";
?>