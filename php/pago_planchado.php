<?php

include "dbConnection.php";

if(isset($_POST["data"])){

	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);
	$planchado = trim($_POST['data']);

	/******************* COMPROBACIÓN id comanda no pagada del cliente *****************/
	include "pago_getComandaId.php";

	if ($pedidoPendienteDePago){
		$sql = "UPDATE comanda SET planchado = ? WHERE id = ?";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("ii", $planchado, $idComanda);
		if($rdo->execute()){
			echo "2";
		} else {
		    echo "Error al actualizar los datos";
		}
	} else if ($pedidoPendienteDePago == false) {
		$sql = "INSERT INTO comanda (cliente_id, planchado) VALUES (?,?)";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("ii", $idUsuarioSesion, $planchado);
		if ($rdo->execute()) {
		    echo "1";
		} else {
		    echo "Error al insertar los datos";
		}
	}
	
}else{
	echo "error";
}
$conn->close();
?>