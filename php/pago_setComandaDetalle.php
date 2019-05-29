<?php
include "dbConnection.php";

	$pagoFinalizado = false;

	//COMPROBACIÓN codigo de carro del cliente
	include "shop_getCartId.php";

	$data = array();
	//Select de todos los productos que tiene el carro id proveniente del usuario en sesion
	$r0 = $conn->prepare("SELECT prod_id, cantidad FROM carrodetalle WHERE carro_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r0->bind_param("i", $idCarro);
	//Ejecutamos la consulta
	$r0->execute();
	//Resultado de todos los atributos de la BBDD
	$r0->bind_result($p, $c);
	$result = $r0->get_result();
	if($r0){
		/* obtener los valores */
	    while ($row = $result->fetch_assoc()) {
	        $data[] = $row;
	    }
	}
	$r0->close();


	//COMPROBACIÓN codigo de comanda del cliente
	include "pago_getComandaId.php";

	
	//Se recorre el array de los productos de carrodetalle que se han guardado anteriormente
	foreach($data as $value){
   		$idProd = $value['prod_id'];
   		$cant = $value['cantidad'];

   		$sql = "INSERT INTO comandadetalle (com_id, prod_id, cantidad) VALUES (?,?,?)";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("iii", $idComanda, $idProd, $cant);
		if($rdo->execute()){
			$pagoFinalizado = true;
		} 
	}

	//Si todo ha ido bien y se ha efectuado el pago se borran los productos de carrodeatelle del cliente
	if($pagoFinalizado){
		$sql = "delete from carrodetalle where carro_id='$idCarro'";
		if($conn->query($sql) === TRUE){
			echo "1";
		} else {
			echo "Error";
		}
	}
$conn->close();
?>