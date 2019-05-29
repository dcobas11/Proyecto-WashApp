<?php

include "dbConnection.php";
session_start();

$email = ($_SESSION["employee"]);
$id = $_SESSION["ide"];
$data = array();

//$rs = mysqli_query($conn, "select * from comanda where trabajador_id = '" . $rs_w['id'] . "'");
$rs = mysqli_query($conn, "select * from cliente, comanda where cliente.id = comanda.cliente_id and status='1' ORDER BY dia_recogida, franja");
while($row = mysqli_fetch_assoc($rs)){
 	$data[] = $row;
}

// Devuelve codificado en json toda la fila
echo json_encode($data);

$conn->close();
?>
