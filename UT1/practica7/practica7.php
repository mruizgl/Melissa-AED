<?php
// Asignar valor a la variable
$variable = null;
var_dump($variable); // Esto mostrará: NULL

// Eliminar la variable usando unset
unset($variable);
var_dump($variable); // Esto dará un mensaje de error: "Undefined variable: variable"
?>