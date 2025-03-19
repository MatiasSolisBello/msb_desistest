<?php
require 'database.php';

if (isset($_POST['codigo'])) {
    $codigo = intval($_POST['codigo']);
    $query = "SELECT codigo FROM producto WHERE codigo = ?";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        echo true;
    }else{
        echo false;
    }
}

$connection->close();
?>