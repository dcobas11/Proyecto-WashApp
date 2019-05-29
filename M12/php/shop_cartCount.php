<?php

include "dbConnection.php";

session_start();
$idUsuarioSesion = ($_SESSION["id"]);

$result=mysqli_query($conn, "select count(*) from carro where cliente_id='$idUsuarioSesion'");

$data = array();
while ($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
}
// Devuelve codificado en json toda la fila
echo json_encode($data);

$conn->close();
?>