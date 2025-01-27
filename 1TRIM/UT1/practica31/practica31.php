
<?php
function modify(array &$arr): void { // Pasar el array por referencia
    $arr[] = 4; // Agrega 4 al array original
}

$a = [1]; // Inicializa el array
modify($a); // Llama a la función
print_r($a); // Imprime el contenido del array
?>
