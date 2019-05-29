<?php

include "dbConnection.php";

if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad'])){

	$idProducto = trim($_POST['id']);
	$nombre = trim($_POST['nombre']);
	$precio = trim($_POST['precio']);
	$cantidad = trim($_POST['cantidad']);

	$existeProducto = false;

	/************** COMPROBACIÓN codigo de carro del cliente ***************/
	include "shop_getCartId.php";

	/***************** COMPROBACIÓN PRODUCTO YA EXISTE *********************/
	$r1 = $conn->prepare("SELECT * FROM carrodetalle WHERE carro_id = ? and prod_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("ii", $idCarro, $idProducto);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($cID, $pID, $cant);
	if($r1){
		if($r1->fetch()){
			if($cID == $idCarro && $pID == $idProducto){
				$existeProducto = true;
			}
		}
	}
	$r1->close();

	//Si el producto ya esta en el carrito se hace un update, sino un insert
	if ($existeProducto){
		$sql = "UPDATE carrodetalle SET cantidad = cantidad + ? WHERE carro_id = ? and prod_id = ?";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("iii", $cantidad, $idCarro, $idProducto);
		if ($rdo->execute()) {
		    echo "2";
		} else {
			echo "Error al actualizar los datos";
		}
	} else if (!$existeProducto) {
		$sql = "INSERT INTO carrodetalle (carro_id, prod_id, cantidad) VALUES (?,?,?)";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("iii", $idCarro, $idProducto, $cantidad);
		if ($rdo->execute()) {
		    echo "1";
		} else {
			echo "Error al insertar los datos";
		}
	}

} else {
	echo "Error, no existen todos los atributos";
}
$conn->close();
?>