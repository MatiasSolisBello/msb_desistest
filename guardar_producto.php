<?php
include('database.php');

if($_POST['codigo']) {
    echo 'Data received!', $_POST['material'];
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $bodega = $_POST['bodega'];
    $sucursal = $_POST['sucursal'];
    $moneda = $_POST['moneda'];
    $precio = $_POST['precio'];
    $materiales = $_POST['material'];
    $descripcion = $_POST['descripcion'];

    echo $materiales;

    $query = "INSERT INTO producto (codigo, nombre, bodega_id, sucursal_id, moneda_id, precio, material_producto, descripcion) 
        VALUES ('$codigo', '$nombre', '$bodega', '$sucursal', '$moneda', '$precio', '$materiales', '$descripcion')";

    $result = mysqli_query($connection, $query);
    
    

    echo 'Task Added Successfully';  
}else{
    echo 'No data';
}
?>