<?php

include "dbConnection.php";

session_start();
if(isset($_SESSION["user"])){
	$idUsuarioSesion = ($_SESSION["id"]);

	/******************* COMPROBACIÓN id comanda no pagada del cliente *****************/
	include "pago_getComandaId.php";

	if($pedidoPendienteDePago){
		$result=mysqli_query($conn, "select dia_recogida, franja from comanda where id = '$idComanda'");

		$data = array();
		while ($row = mysqli_fetch_assoc($result)){
			$data[] = $row;
		}
		// Devuelve codificado en json toda la fila
		echo json_encode($data);
	}
}else{
	echo "error sesión";
}

$conn->close();
?>