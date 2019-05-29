<?php
	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);
	
	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	$r0 = $conn->prepare("SELECT cod FROM carro WHERE cliente_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r0->bind_param("i", $idUsuarioSesion);
	//Ejecutamos la consulta
	$r0->execute();
	//Resultado de todos los atributos de la BBDD
	$r0->bind_result($cod);
	if($r0){
		/* obtener los valores */
	    while ($r0->fetch()) {
	        $idCarro = $cod;
	    }
	}
	$r0->close();
?>