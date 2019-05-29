<?php	
	/******************* COMPROBACIÓN id comanda no pagada del cliente *****************/
	//Si el pago es nulo en la BBDD se hace un update si se vuelve a modificar la hora
	$pedidoPendienteDePago = false;
	$pagoNull = "";
	$r0 = $conn->prepare("SELECT id FROM comanda WHERE cliente_id = ? and card_type = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r0->bind_param("is", $idUsuarioSesion, $pagoNull);
	//Ejecutamos la consulta
	$r0->execute();
	//Resultado de todos los atributos de la BBDD
	$r0->bind_result($idComanda);
	if($r0){
		/* obtener los valores */
	    while ($r0->fetch()) {
			$pedidoPendienteDePago = true;
	    }
	}
	$r0->close();
?>