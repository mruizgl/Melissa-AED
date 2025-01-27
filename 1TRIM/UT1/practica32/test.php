<?php
$color = 'verde';
$fruta = 'manzana';
echo "Una $fruta $color"; // Intentará imprimir antes de incluir el archivo
require 'vars.php'; // Intentará incluir vars1.php, que no existe
echo "Una $fruta $color"; // Esta línea no se ejecutará si vars.php no se encuentra
?>
