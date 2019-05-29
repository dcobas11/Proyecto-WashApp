<?php

include "dbConnection.php";

if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['cantidad'])){

	$id = trim($_POST['id']);
	$nombre = trim($_POST['nombre']);
	$precio = trim($_POST['precio']);
	$cantidad = trim($_POST['cantidad']);

	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);
	
	$existeProducto = false;

	/***************** COMPROBACIÓN PRODUCTO YA EXISTE *********************/
	$r1 = $conn->prepare("SELECT * FROM carro WHERE id = ? and cliente_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("ii", $id, $idUsuarioSesion);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($cod, $cod2, $n, $p, $c, $cid);
	if($r1){
		if($r1->fetch()){
			if($cod2 == $id && $cid == $idUsuarioSesion){
				$existeProducto = true;
			}
		}
	}
	$r1->close();

	//Si el producto ya esta en el carrito se hace un update, sino un insert
	if ($existeProducto){
		$sql = "UPDATE carro SET precio = precio + ?, cantidad = cantidad + ? WHERE id = ?";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("dii", $precio, $cantidad, $id);
		if ($rdo->execute()) {
		    echo "2";
		} else {
			echo "Error al actualizar los datos";
		}
	} else if (!$existeProducto) {
		$sql = "INSERT INTO carro (id, nombre, precio, cantidad, cliente_id) VALUES (?,?,?,?,?)";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("isdii", $id, $nombre, $precio, $cantidad, $idUsuarioSesion);
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