<?php

include "dbConnection.php";

if (isset($_POST['dia']) && isset($_POST['franja'])){

	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);
	$dia = trim($_POST['dia']);
	$franja = trim($_POST['franja']);

	//El dia de hoy
	$date = date('d/n/Y', time());

	if ($dia == "fecha" && $franja == "franja"){
		echo "error dia null";
	} else {
		if (substr($franja, 0, 2) == "8:"){
			$franja = 1;
		} else if (substr($franja, 0, 2) == "12"){
			$franja = 2;
		} else if (substr($franja, 0, 2) == "16"){
			$franja = 3;
		}

		/******************* COMPROBACIÓN id comanda no pagada del cliente *****************/
		include "pago_getComandaId.php";

		if ($pedidoPendienteDePago){
			$sql = "UPDATE comanda SET fecha = ?, dia_recogida = ?, franja = ? WHERE id = ?";
			$rdo = $conn->prepare($sql);
			$rdo->bind_param("ssii", $date, $dia, $franja, $idComanda);
			if($rdo->execute()){
				echo "2";
			} else {
			    echo "Error al actualizar los datos";
			}
		} else if ($pedidoPendienteDePago == false) {
			$sql = "INSERT INTO comanda (cliente_id, fecha, dia_recogida, franja) VALUES (?,?,?,?)";
			$rdo = $conn->prepare($sql);
			$rdo->bind_param("sssi", $idUsuarioSesion, $date, $dia, $franja);
			if ($rdo->execute()) {
			    echo "1";
			} else {
			    echo "Error al insertar los datos";
			}
		}
	}
} else {
	echo "Error, no existen todos los atributos";
}
$conn->close();
?>