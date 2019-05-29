<?php

include "dbConnection.php";
session_start();

if (isset($_POST['acept_id'])){

	$acept_id = $_POST["acept_id"];
	$worker_id = ($_SESSION["ide"]);	
	$status = 2;
	
	$r1 = $conn->prepare("UPDATE comanda SET status = ? WHERE id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("si", $status, $acept_id);
	//Ejecutamos la consulta
	if($r1->execute()){
		echo "nice1";
	}
	$r1->close();

	$r2 = $conn->prepare("UPDATE comanda SET trabajador_id = ? WHERE id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r2->bind_param("si", $worker_id, $acept_id);
	//Ejecutamos la consulta
	if($r2->execute()){
		echo "nice2";
	}
	$r2->close();

}elseif(isset($_POST['deCa_id'])){

	$entr_id = $_POST["deCa_id"];
	$status = 3;

	$r1 = $conn->prepare("UPDATE comanda SET status = ? WHERE id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("si", $status, $entr_id);
	//Ejecutamos la consulta
	if($r1->execute()){
		echo "nice3";
	}
	$r1->close();
	
}elseif(isset($_POST['entr_id'])){

	$entr_id = $_POST["entr_id"];
	$status = 4;

	$r1 = $conn->prepare("UPDATE comanda SET status = ? WHERE id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("si", $status, $entr_id);
	//Ejecutamos la consulta
	if($r1->execute()){
		echo "nice4";
	}
	$r1->close();
}else {
	echo "Error, en el envio";
}
$conn->close();
?>
