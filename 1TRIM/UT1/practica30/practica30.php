<?php
function modify(int &$a): void { // Parámetro pasado por referencia
    $a = 3; // Modifica la variable original
}

$a = 2; // Inicializa la variable
modify($a); // Llama a la función que modifica $a
print_r($a); // Imprime el valor de $a
?>
