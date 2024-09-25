<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valores de $_SERVER</title>
</head>
<body>
    <h1>Valores de $_SERVER</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nombre de la Variable</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre el array $_SERVER
            foreach ($_SERVER as $variable => $valor) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($variable) . "</td>";
                echo "<td>" . htmlspecialchars($valor) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
