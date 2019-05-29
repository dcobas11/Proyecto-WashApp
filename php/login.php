<?php

include "dbConnection.php";

if (isset($_POST['usuario']) && isset($_POST['pass'])){

	$user = trim($_POST['usuario']);
	$pass = trim($_POST['pass']);

	$userLogin = false;
	$cartExists = false;
	
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
	//Si el usuario es trabajador
	} else if (strpos($user, 'washapp@') !== false) {
		//Comprobación si el usuario existe
		$rdo = $conn->prepare("SELECT * FROM trabajador WHERE user = ?");
		//Ligamos el parámetro ? con el atributo (variable)
		$rdo->bind_param("s", $user);
		//Ejecutamos la consulta
		$rdo->execute();
		//Resultado de todos los atributos de la BBDD
		$rdo->bind_result($id, $n, $user, $pwd, $tlf, $dni, $ss);
		if($rdo){
			if($rdo->fetch()){
				//Si hemos llegado hasta aqui, el usuario existe, se mirará también la contraseña hasheada
				if(password_verify($pass, $pwd)) {
					//Se crea la sesión
					$_SESSION["employee"] = $user;
					
					$employee_id = $id;
					$_SESSION["ide"] = $employee_id;
					echo "Ok employee";
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
					//Se guarda el id del usuario en sesion
					$_SESSION["id"] = $id;

					$userLogin = true;
				} else {
					echo "Error pwd";
				}
			} else {
				echo "Error usuario";
			}
		}
		$rdo->close();
	}

	//Se mira si el usuario tiene un carro asignado
	if ($userLogin){
		$r1 = $conn->prepare("SELECT * FROM carro WHERE cliente_id = ?");
		//Ligamos el parámetro ? con el atributo (variable) que nos interesa
		$r1->bind_param("i", $id);
		//Ejecutamos la consulta
		$r1->execute();
		//Resultado de todos los atributos de la BBDD
		$r1->bind_result($id, $cid);
		if($r1){
			if($r1->fetch()){
				$cartExists = true;
				echo "1";
			}
		}
		$r1->close();
	}

	if ($userLogin && $cartExists == false){
		$idUsuario = $_SESSION["id"];
		$sql = "INSERT INTO `carro` (`cod`, `cliente_id`) VALUES (NULL, '$idUsuario');";
		if ($conn->query($sql) === TRUE) {
    		echo "1";
		} 
	}
} else {
	echo "Error";
}
$conn->close();
?>