<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $id = $_POST["id"];

    // Prepare statement
    $stmt = $conn->prepare("DELETE FROM articulos_crud WHERE id = ?");
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    // Bind the parameter correctly
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Articulo borrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and the connection
    $stmt->close();
    $conn->close();
}

