<?php
for ($i = 0; $i < 10; $i++) {
    // Usar "variable de variables" para asignar valores a $dato0, $dato1, ..., $dato9
    ${"dato" . $i} = $i;
}

echo "<br> $dato3 "; 
echo "<br> $dato8 "; 
?>