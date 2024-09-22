<?php
$array = ["a","a","a","a","a"];
$j=count($array);
foreach( $array as $key => $val){
$j--;
$array[$j] .= $j;
echo "<br>";
var_dump($array);
echo "<br> $key => $val"; //esta línea no tiene el efecto deseado
echo "<br> $key => $array[$key]"; // aquí sí
echo "<br>";
}
?>

<?php
$arr = array(1, 2, 3, 4);
foreach ($arr as &$val) {
$val = $val * 2;
}
foreach ($arr as $key => $val) {
echo "{$key} => {$val} <br>";
print_r($arr);
echo "<br><br>";
}
?>