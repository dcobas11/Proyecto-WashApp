<?php

include "dbConnection.php";

if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['precio'])){

	$id = $_POST["id"];
	//$nombre = trim($_POST['nombre']);
	$precio = trim($_POST['precio']);

	$updateOK = false;
	$precioNull = false;

	if($precio == "" || $precio == "0"){
		$precioNull = true;
	}

	$r1 = $conn->prepare("UPDATE producto SET precio = ? WHERE id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("si", $precio, $id);
	//Ejecutamos la consulta
	if($r1->execute()){
		$updateOK = true;
	}
	$r1->close();

	if ($precioNull){
		echo "error precio";
	} else if ($updateOK && $precioNull == false){
		echo "actualizado";
	}

} else {
	echo "Error, no existen todos los atributos";
}
$conn->close();
?>