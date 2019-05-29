<?php

include "dbConnection.php";
session_start();

//VARIABLES DE SESSION
$user = ($_SESSION["employee"]);
$id = $_SESSION["ide"];
$data = array();

//CONSULTAS COMANDAS ACEPTADAS O EN RUTA
$rs = mysqli_query($conn, "select * from cliente, comanda where cliente.id = comanda.cliente_id and comanda.trabajador_id = '" . $id . "' and (status='2' or status='3') ORDER BY dia_recogida, franja");
while($row = mysqli_fetch_assoc($rs)){
 	$data[] = $row;
}

//Devuelve codificado en json toda la fila
echo json_encode($data);

$conn->close();
?>
