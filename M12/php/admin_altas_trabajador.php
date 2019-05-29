<?php

include "dbConnection.php";

if (isset($_POST['nombre']) && isset($_POST['usuario']) && isset($_POST['pass']) && isset($_POST['numero'])
	&& isset($_POST['card']) && isset($_POST['ss'])){

	$nombre = trim($_POST['nombre']);
	$usuario = trim($_POST['usuario']);
	$pass = trim($_POST['pass']);
	$numero = trim($_POST['numero']);
	$dni = trim($_POST['card']);
	$ss = trim($_POST['ss']);

	$existeUsuario = false;
	$existeDni = false;
	$existeSS = false;


	/***************** COMPROBACIÓN USUARIO / EMAIL YA EXISTEN *********************/
	$r1 = $conn->prepare("SELECT * FROM trabajador WHERE user = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("s", $usuario);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($id, $n, $user, $pwd, $t, $doc, $nss);
	if($r1){
		if($r1->fetch()){
			if($user == $usuario){
				$existeUsuario = true;
			}
		}
	}
	$r1->close();

	/***************** COMPROBACIÓN DNI / NIE YA EXISTEN *********************/
	$r2 = $conn->prepare("SELECT * FROM trabajador WHERE dni = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r2->bind_param("s", $dni);
	//Ejecutamos la consulta
	$r2->execute();
	//Resultado de todos los atributos de la BBDD
	$r2->bind_result($id, $n, $user, $pwd, $t, $doc, $nss);
	if($r2){
		if($r2->fetch()){
			if($doc == $dni){
				$existeDni = true;
			}
		}
	}
	$r2->close();

	/***************** COMPROBACIÓN DNI / NIE YA EXISTEN *********************/
	$r3 = $conn->prepare("SELECT * FROM trabajador WHERE ss = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r3->bind_param("s", $ss);
	//Ejecutamos la consulta
	$r3->execute();
	//Resultado de todos los atributos de la BBDD
	$r3->bind_result($id, $n, $user, $pwd, $t, $doc, $nss);
	if($r3){
		if($r3->fetch()){
			if($nss == $ss){
				$existeSS = true;
			}
		}
	}
	$r3->close();

	//Respuesta del servidor
	if($existeUsuario){
		echo "Usuario existe";
	} else if ($existeDni){
		echo "Dni existe";
	} else if ($existeSS){
		echo "SS existe";
	} else if($existeUsuario == false && $existeDni == false && $existeSS == false){
		//Se hashea la contraseña
		$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO trabajador (nombre, user, password, telf, dni, ss) VALUES (?,?,?,?,?,?)";
		$rdo = $conn->prepare($sql);
		$rdo->bind_param("ssssss", $nombre, $usuario, $hashed_password, $numero, $dni, $ss);
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