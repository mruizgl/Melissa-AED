<?php
// Número a descomponer
$numero = 3102;

// Convertir el número a cadena para poder recorrer cada dígito
$numero_str = (string) $numero;

// Inicializar la variable para almacenar el resultado de la descomposición
$descomposicion = "";

// Obtener la longitud del número
$longitud = strlen($numero_str);

// Recorrer cada dígito del número
for ($i = 0; $i < $longitud; $i++) {
    // Obtener el dígito actual
    $digito = $numero_str[$i];
    
    // Calcular la potencia de 10 correspondiente a la posición
    $potencia = ($longitud - 1) - $i;
    $valor = 10 ** $potencia;
    
    // Concatenar el resultado en el formato requerido
    $descomposicion .= $digito . " * " . $valor;
    
    // Añadir el signo '+' si no es el último dígito
    if ($i < $longitud - 1) {
        $descomposicion .= " + ";
    }
}

// Mostrar la descomposición
echo $descomposicion;
?>