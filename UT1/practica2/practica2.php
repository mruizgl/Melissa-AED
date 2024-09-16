<?php
$un_bool = TRUE; // un valor booleano
$un_str = "foo"; // una cadena de caracteres
$un_str2 = 'foo'; // una cadena de caracteres
$un_int = 12; // un número entero

// Imprimir el tipo de las variables
echo gettype($un_bool) . "\n"; // imprime: boolean
echo gettype($un_str) . "\n";  // imprime: string

// Si este valor es un entero, incrementarlo en cuatro
if (is_int($un_int)) {
 $un_int += 4;
}

// Concatenar $un_str con $un_int
$resultado_str_int = $un_str . $un_int; // Concatenación de string y entero

// Mostrar el resultado de la concatenación
echo "Resultado de concatenar \$un_str con \$un_int: $resultado_str_int\n";

// Concatenar $un_str con $un_str2
$resultado_str_str = $un_str . $un_str2; // Concatenación de dos strings

// Mostrar el resultado de la concatenación
echo "Resultado de concatenar \$un_str con \$un_str2: $resultado_str_str\n";
?>
