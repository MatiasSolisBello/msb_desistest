<?php
require 'database.php';

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    $query = "SELECT codigo FROM producto WHERE codigo = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    echo ($result->num_rows > 0) ? true : false;
    $stmt->close();
}

$connection->close();
?>