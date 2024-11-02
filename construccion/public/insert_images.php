<?php
$mysqli = new mysqli("localhost", "root", "admin", "construcciones");

// Verifica la conexión
if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

// Ruta de la carpeta de imágenes
$imageDir = 'images/'; // Ajusta la ruta si es necesario
$files = scandir($imageDir);

// Filtrar solo archivos PNG
$images = array_filter($files, function($file) {
    return preg_match('/\.png$/', $file);
});

// Preparar la sentencia
$stmt = $mysqli->prepare("INSERT INTO figuras (imagen, tipo_imagen) VALUES (?, ?)");
$stmt->bind_param("bs", $imageData, $tipo_imagen);

foreach ($images as $image) {
    // Leer la imagen
    $imagePath = $imageDir . $image;
    $imageData = file_get_contents($imagePath);
    $tipo_imagen = 'image/png';

    // Ejecutar la inserción
    if (!$stmt->execute()) {
        echo "Error insertando la imagen $image: " . $stmt->error . "\n";
    } else {
        echo "Imagen $image insertada correctamente.\n";
    }
}

// Cerrar la sentencia y la conexión
$stmt->close();
$mysqli->close();
?>
