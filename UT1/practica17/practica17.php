<?php
$array = [];
for ($i = 0; $i < 5; $i++) {
    $array[] = "a" . $i;
}

$j = count($array);
foreach ($array as $key => $val) {
    $j--;
    unset($array[$j]); // Elimina el elemento en la posición $j
    echo "<br>";
    var_dump($array); // Muestra el estado actual del array
    echo "<br> $key => $val ";
    echo "<br>";
}
?>
