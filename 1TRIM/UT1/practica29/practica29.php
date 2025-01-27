<?php
function modify(int $a): void {
    $a = 3; // Esta asignación solo afecta la variable local $a dentro de la función.
}

$a = 2; // Variable global
modify($a); // Llamada a la función con el valor de $a
print_r($a); // Imprime el valor de $a
?>
