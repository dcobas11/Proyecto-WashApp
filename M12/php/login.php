<?php

include "dbConnection.php";

if (isset($_POST['usuario']) && isset($_POST['pass'])){

	$user = trim($_POST['usuario']);
	$pass = trim($_POST['pass']);

	session_start();

	//Se comprueba el tipo de usuario que hace login
	//Si el usuario es administrador
	if (strpos($user, 'admin@') !== false) {
		//Comprobación si el usuario existe
		$rdo = $conn->prepare("SELECT * FROM washapp WHERE user = ?");
		//Ligamos el parámetro ? con el atributo (variable)
		$rdo->bind_param("s", $user);
		//Ejecutamos la consulta
		$rdo->execute();
		//Resultado de todos los atributos de la BBDD
		$rdo->bind_result($id, $user, $pwd);
		if($rdo){
			if($rdo->fetch()){
				//Si hemos llegado hasta aqui, el usuario existe, se mirará también la contraseña hasheada
				if(password_verify($pass, $pwd)) {
					//Se crea la sesión
					$_SESSION["admin"] = $user;
					echo "Ok admin";
				} else {
					echo "Error pwd";
				}
			} else {
				echo "Error usuario";
			}
		}
		$rdo->close();
	} else {
		//Comprobación si el usuario existe
		$rdo = $conn->prepare("SELECT * FROM cliente WHERE user = ?");
		//Ligamos el parámetro ? con el atributo (variable)
		$rdo->bind_param("s", $user);
		//Ejecutamos la consulta
		$rdo->execute();
		//Resultado de todos los atributos de la BBDD
		$rdo->bind_result($id, $n, $user, $mail, $t, $typ, $pwd, $city, $address, $cp);
		if($rdo){
			if($rdo->fetch()){
				//Si hemos llegado hasta aqui, el usuario existe, se mirará también la contraseña hasheada
				if(password_verify($pass, $pwd)) {
					//Se crea la sesión
					$_SESSION["user"] = $user;

					$idUsuarioSesion = $id;
					$_SESSION["id"] = $idUsuarioSesion;
					echo "1";
				} else {
					echo "Error pwd";
				}
			} else {
				echo "Error usuario";
			}
		}
		$rdo->close();
	}
} else {
	echo "Error";
}
$conn->close();
?>