<?php

include "dbConnection.php";

session_start();
$idUsuarioSesion = ($_SESSION["id"]);

$sql = "DELETE carro WHERE cliente_id='$idUsuarioSesion'");

if($conn->query($sql) === TRUE){
	echo "1";
} else {
	echo "Error";
}

$conn->close();
?>