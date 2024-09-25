<?php
// Crear el array con los valores iniciales
$array = [7, 2, 8, 1, 9, 4];

// Mostrar el array original
echo "Array original:\n";
print_r($array);

// Búsqueda del valor 4 antes de ordenar
$valor_a_buscar = 4;
$indice = array_search($valor_a_buscar, $array);
echo "Resultado de array_search() para el valor $valor_a_buscar antes de ordenar: ";
if ($indice !== false) {
    echo "El valor '$valor_a_buscar' se encuentra en la posición: $indice.\n";
} else {
    echo "El valor '$valor_a_buscar' NO se encuentra en el array.\n";
}

// Función de comparación para usort
function cmp($a, $b) {
    return $a <=> $b; // Usar el operador nave espacial
}

// Ordenar el array utilizando usort
usort($array, "cmp");

// Mostrar el array después de ordenar
echo "\nArray después de ordenar:\n";
print_r($array);

// Repetir búsqueda del valor 4 después de ordenar
$indice = array_search($valor_a_buscar, $array);
echo "Resultado de array_search() para el valor $valor_a_buscar después de ordenar: ";
if ($indice !== false) {
    echo "El valor '$valor_a_buscar' se encuentra en la posición: $indice.\n";
} else {
    echo "El valor '$valor_a_buscar' NO se encuentra en el array.\n";
}
?>
