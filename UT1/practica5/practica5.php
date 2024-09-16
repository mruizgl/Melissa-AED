<?php
$foo = 5; // Asigna el valor 'Bob' a $foo
$bar = &$foo; // Referencia $foo vía $bar.
$bar = 6; // Modifica $bar...
echo $foo; // $foo también se modifica.
echo $bar;
?>