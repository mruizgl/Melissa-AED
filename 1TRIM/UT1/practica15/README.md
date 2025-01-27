## Ejemplo de Arrays en PHP

### Código PHP con Corchetes

```php
<?php
$array = [];
$array[2] = "mensaje";
var_dump($array); // Imprime el estado del array después de la primera asignación

$array[7] = "lalala!";
var_dump($array); // Imprime el estado del array después de la segunda asignación

$array[] = "yepa yepa!!";
var_dump($array); // Imprime el estado del array después de la tercera asignación
?>
Explicación
Primera Asignación:

$array[2] = "mensaje";
Aquí se define un elemento en la posición 2 del array. Las posiciones 0 y 1 no se definen, por lo que el array tendrá los índices 2 y el valor "mensaje".
Resultado:


array(1) {
    [2] =>
    string(7) "mensaje"
}
Segunda Asignación:

$array[7] = "lalala!";
Se añade un elemento en la posición 7 del array. Las posiciones entre 2 y 7 no se definen, por lo que quedan vacías.
Resultado:


array(2) {
    [2] =>
    string(7) "mensaje"
    [7] =>
    string(7) "lalala!"
}
Tercera Asignación:

$array[] = "yepa yepa!!";
Aquí se añade un nuevo elemento al array en la siguiente posición disponible. Dado que las posiciones entre 2 y 7 están vacías, el próximo índice será 8.
Resultado:


array(3) {
    [2] =>
    string(7) "mensaje"
    [7] =>
    string(7) "lalala!"
    [8] =>
    string(10) "yepa yepa!!"
}
Código PHP con array()

<?php
$array = array();
$array[2] = "mensaje";
var_dump($array); // Imprime el estado del array después de la primera asignación

$array[7] = "lalala!";
var_dump($array); // Imprime el estado del array después de la segunda asignación

$array[] = "yepa yepa!!";
var_dump($array); // Imprime el estado del array después de la tercera asignación
?>
Diferencias en la Salida
No habrá diferencias en la salida al utilizar array() en lugar de los corchetes [] para definir el array. Ambos métodos son equivalentes en PHP 5.4 y versiones posteriores.

La salida será la misma en ambos casos, mostrando el mismo comportamiento para las asignaciones y los índices no definidos entre los índices que se han asignado.

Capturas de Pantalla
Para capturas de pantalla, ejecuta cada script en tu entorno PHP y toma capturas de la salida generada por var_dump($array) después de cada asignación para observar el comportamiento descrito.