<?php

include "dbConnection.php";

if (isset($_POST['id'])){

	$id = trim($_POST['id']);

	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);

	$sql = "DELETE FROM carro WHERE id = ? and cliente_id = ?";
	$rdo = $conn->prepare($sql);
	$rdo->bind_param("ii", $id, $idUsuarioSesion);
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