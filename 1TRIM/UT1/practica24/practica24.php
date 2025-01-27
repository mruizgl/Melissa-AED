<?php
// Definición del array original
$array = array('azul', 'rojo', 'verde', 'amarillo', 'blanco');

// Mostrar el array original
echo "Array original:\n";
print_r($array);

// Eliminar elementos en las posiciones 2 y 3
unset($array[2]); // Elimina 'verde'
unset($array[3]); // Elimina 'amarillo'

// Mostrar el array después de eliminar elementos
echo "\nArray después de unset:\n";
print_r($array);

// Limpiar los índices del array
$array = array_values($array);
echo "\nArray después de usar array_values():\n";
print_r($array);

// Usar in_array() para verificar si un valor está en el array
$search_value = 'rojo';
if (in_array($search_value, $array)) {
    echo "\nEl valor '$search_value' se encuentra en el array.\n";
} else {
    echo "\nEl valor '$search_value' NO se encuentra en el array.\n";
}

// Usar array_search() para encontrar la clave de un valor en el array
$search_value = 'blanco';
$search_index = array_search($search_value, $array);
if ($search_index !== false) {
    echo "El valor '$search_value' se encuentra en la posición $search_index.\n";
} else {
    echo "El valor '$search_value' NO se encuentra en el array.\n";
}
?>
