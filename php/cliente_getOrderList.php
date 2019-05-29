<?php

include "dbConnection.php";

session_start();
if(isset($_SESSION["user"])){
	$idUsuarioSesion = ($_SESSION["id"]);

	//Pedidos del cliente ya pagados
	$result=mysqli_query($conn, "select id, fecha, planchado, status from comanda where cliente_id = '$idUsuarioSesion' and card_type !='' order by id DESC");

	$data = array();
	while ($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	// Devuelve codificado en json toda la fila
	echo json_encode($data);
}else{
	echo "error sesión";
}

$conn->close();
?>