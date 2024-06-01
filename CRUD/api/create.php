<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $title = $_POST["title"];
    $description = $_POST["descripcion"];
    
    // Preparar la consulta
    $stmt = $conn->prepare("INSERT INTO articulos_crud (articulo, descripcion, creado) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $description);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Artículo creado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
}
