<?php

include "dbConnection.php";

	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	include "shop_getCartId.php";

	$r1 = $conn->prepare("SELECT carrodetalle.prod_id, carrodetalle.cantidad, producto.nombre, producto.precio from carrodetalle INNER JOIN producto on producto.id = prod_id where carrodetalle.carro_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("i", $idCarro);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($pid, $cant, $n, $p);
	if($r1){
		$results = array();
		    while ($r1->fetch()) {
		        $results[] = array(
		            "prod_id" => $pid,
		            "cantidad" => $cant,
		            "nombre" => $n,
		            "precio" => $p
		        );
		    }
	}
	$r1->close();

// Devuelve codificado en json toda la fila
echo json_encode($results);

$conn->close();
?>