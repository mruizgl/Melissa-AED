<?php
// Rellenar un array con 10 números aleatorios entre 20 y 25
$array = [];
for ($i = 0; $i < 10; $i++) {
    $array[] = rand(20, 25); // Agregar un número aleatorio al array
}

// Mostrar el array completo
echo "Array completo:\n";
print_r($array);

// Usar array_search() para localizar el valor "22"
$valor_a_buscar = 22;
$indice = array_search($valor_a_buscar, $array);

// Mostrar el resultado de array_search()
if ($indice !== false) {
    echo "El valor '$valor_a_buscar' se encuentra en la posición: $indice.\n";
} else {
    echo "El valor '$valor_a_buscar' NO se encuentra en el array.\n";
}
?>
