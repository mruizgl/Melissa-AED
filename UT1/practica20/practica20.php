<?php
$arr = ["1", "2", "3", "4"];
$va = array_pop($arr); // Extrae el último elemento del array
echo "el array ahora queda: <br>";
print_r($arr); // Muestra el estado actual del array
echo "<br>el valor extraido es: " . $va;
?>