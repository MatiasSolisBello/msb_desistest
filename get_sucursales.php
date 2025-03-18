<?php
require 'database.php';

if (isset($_POST['bodega_id'])) {
    $bodega_id = intval($_POST['bodega_id']);
    $query = "SELECT id, nombre FROM sucursal WHERE bodega_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $bodega_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $sucursales = [];
    while ($row = $result->fetch_assoc()) {
        $sucursales[] = $row;
    }

    echo json_encode($sucursales);
}

$stmt->close();
$connection->close();
?>
