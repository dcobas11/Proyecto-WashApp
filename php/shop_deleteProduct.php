<?php

include "dbConnection.php";

if (isset($_POST['id'])){

	$idProducto = trim($_POST['id']);

	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	include "shop_getCartId.php";

	$sql = "DELETE FROM carrodetalle WHERE carro_id = ? and prod_id = ?";
	$rdo = $conn->prepare($sql);
	$rdo->bind_param("ii", $idCarro, $idProducto);
	if ($rdo->execute()) {
	    echo "1";
	} else {
		echo "Error";
	}
} else {
	echo "Error ID";
}
$conn->close();
?>