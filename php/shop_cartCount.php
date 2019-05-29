<?php

include "dbConnection.php";

	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	include "shop_getCartId.php";

	$result=mysqli_query($conn, "select count(*) from carrodetalle where carro_id='$idCarro'");

	$data = array();
	while ($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	// Devuelve codificado en json toda la fila
	echo json_encode($data);

$conn->close();
?>