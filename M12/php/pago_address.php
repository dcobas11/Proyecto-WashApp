<?php

include "dbConnection.php";

session_start();
if(isset($_SESSION["user"])){
	$idUsuarioSesion = ($_SESSION["id"]);

	$result=mysqli_query($conn, "select * from cliente where id = '$idUsuarioSesion'");

	$data = array();
	while ($row = mysqli_fetch_assoc($result)){
		$data[] = $row;
	}
	// Devuelve codificado en json toda la fila
	echo json_encode($data);
}else{
	echo "error sesión";
}

$conn->close();
?>