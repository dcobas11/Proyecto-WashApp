<?php

include "dbConnection.php";

	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	include "shop_getCartId.php";

	$sql = "delete from carrodetalle where carro_id='$idCarro'";

	if($conn->query($sql) === TRUE){
		echo "1";
	} else {
		echo "Error";
	}

$conn->close();
?>