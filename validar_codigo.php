<?php
require 'database.php';

if (isset($_POST['codigo'])) {
    $codigo = intval($_POST['codigo']);
    $query = "SELECT codigo FROM producto WHERE codigo = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "true";
    }
}

$stmt->close();
$connection->close();
?>