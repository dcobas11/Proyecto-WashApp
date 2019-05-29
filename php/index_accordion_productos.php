<?php

include "dbConnection.php";
include "producto.php";

/* sentencia preparada */
if ($sentencia = $conn->prepare("SELECT id, nombre, precio, tipo FROM producto")) {
    $sentencia->execute();

    /* vincular variables a la sentencia preparada */
    $sentencia->bind_result($id, $nombre, $precio, $tipo);

    
    $productos = [];

    /* obtener valores */
    while ($sentencia->fetch()) {
        /*crear producto*/
        $producto = new Producto();
        $producto->id = $id;
        $producto->nombre = $nombre;
        $producto->precio = $precio;
        $producto->tipo = $tipo;
        array_push($productos, $producto);
    }
    
    /*return($productos);*/
    echo json_encode($productos);

    /* cerrar la sentencia */
    $sentencia->close();
}
/* cerrar la conexión */
$conn->close();
?>