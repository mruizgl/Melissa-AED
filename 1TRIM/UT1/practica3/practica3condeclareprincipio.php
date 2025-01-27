<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Práctica</title>
</head>
<body>
<?php
function sum(int $a, int $b): int {
    return $a + $b;
}

echo "<p> La suma de uno más dos es: ";
$resultado = sum(1, 2);
print sum(1, 2);
echo "</p>";
?>
</body>
</html>
<?php
declare(strict_types=1);
?>
