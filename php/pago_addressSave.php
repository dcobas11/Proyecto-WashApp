<?php

include "dbConnection.php";

if (isset($_POST['nombre']) && isset($_POST['direccion']) && isset($_POST['ciudad']) && isset($_POST['codigopostal']) && isset($_POST['numero'])){

	session_start();
	$idUsuarioSesion = ($_SESSION["id"]);
	$nombre = trim($_POST['nombre']);
	$direccion = trim($_POST['direccion']);
	$ciudad = "Barcelona";
	$codigopostal = trim($_POST['codigopostal']);
	$numero = trim($_POST['numero']);

	$faltaCampo = false;
	$codigopostalOK = false;

	if($nombre == "" || $direccion == "" || $codigopostal == "" || $numero == "" ){
		$faltaCampo = true;
	}

	if(preg_match("/^[0-9]{5,5}$/", $codigopostal)){
		$codigopostalOK = true;
	}

	if ($faltaCampo){
		echo "error";
	} else if ($codigopostalOK == false){
		echo "error cp";
	} else if ($codigopostalOK && $faltaCampo == false){
		$r1 = $conn->prepare("UPDATE cliente SET name = ?, telf = ?, city = ?, address = ?, cp = ? WHERE id = ?");
		//Ligamos el parámetro ? con el atributo (variable) que nos interesa
		$r1->bind_param("ssssss", $nombre, $numero, $ciudad, $direccion, $codigopostal, $idUsuarioSesion);
		//Ejecutamos la consulta
		if($r1->execute()){
			echo "actualizado";
		}
		$r1->close();
	}

} else {
	echo "Error, no existen todos los atributos";
}
$conn->close();
?>