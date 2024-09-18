<?php
$array = [];
$array[2] = "mensaje";
var_dump($array); // Imprime el estado del array después de la primera asignación

$array[7] = "lalala!";
var_dump($array); // Imprime el estado del array después de la segunda asignación

$array[] = "yepa yepa!!";
var_dump($array); // Imprime el estado del array después de la tercera asignación
?>