<?php
include 'db_config.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$sql = "SELECT id, articulo, descripcion FROM articulos_crud LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$total_result = $conn->query("SELECT COUNT(id) AS total FROM articulos_crud");
$total = $total_result->fetch_assoc()['total'];

$response = [
    'total' => $total,
    'data' => $data
];

echo json_encode($response);

$conn->close();

