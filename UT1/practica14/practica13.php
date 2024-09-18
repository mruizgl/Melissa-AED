<?php
// Crear las variables dinámicas con valores correspondientes
for ($i = 0; $i < 10; $i++) {
    // Usar variable variable para definir la variable $dato$i
    ${"dato$i"} = $i;
}

// Mostrar los valores de cada variable
for ($i = 0; $i < 10; $i++) {
    // Acceder a cada variable dinámica usando variable variable
    echo ${"dato$i"} . '<br>';
}
?>