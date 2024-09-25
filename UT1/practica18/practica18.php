<?php
$array = ["a", "a", "a", "a", "a"];

$j = count($array);
foreach ($array as $key => $val) {
    $j--;
    $array[$j] .= $j;
    echo "<br>";
    var_dump($array);
    echo "<br> \$key => $val"; // Ahora muestra claramente que estamos usando la variable $key
    echo "<br> \$key => {$array[$key]}"; // Mostrando cuando estamos llamando a $array[$key]
    echo "<br>";
}
?>