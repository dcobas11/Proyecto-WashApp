<?php

include "dbConnection.php";

if (isset($_POST['nombre']) && isset($_POST['usuario']) && isset($_POST['email']) && isset($_POST['numero'])
	&& isset($_POST['tipo']) && isset($_POST['pass']) && isset($_POST['pass2'])){

	$nombre = trim($_POST['nombre']);
	$usuario = trim($_POST['usuario']);
	$email = trim($_POST['email']);
	$numero = trim($_POST['numero']);
	$tipo = trim($_POST['tipo']);
	$pass = trim($_POST['pass']);
	$pass2 = trim($_POST['pass2']);

	$existeUsuario = false;
	$existeEmail = false;
	$tipoNull = false;


	/***************** COMPROBACIÓN USUARIO / EMAIL YA EXISTEN *********************/
	$r1 = $conn->prepare("SELECT * FROM cliente WHERE user = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("s", $usuario);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($id, $n, $user, $mail, $t, $typ, $pwd, $city, $address, $cp);
	if($r1){
		if($r1->fetch()){
			if($user == $usuario){
				$existeUsuario = true;
			}
		}
	}
	$r1->close();

	$r2 = $conn->prepare("SELECT * FROM cliente WHERE email = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r2->bind_param("s", $email);
	//Ejecutamos la consulta
	$r2->execute();
	//Resultado de todos los atributos de la BBDD
	$r2->bind_result($id, $n, $user, $mail, $t, $typ, $pwd, $city, $address, $cp);
	if($r2){
		if($r2->fetch()){
			if($mail == $email){
				$existeEmail = true;
			}
		}
	}
	$r2->close();

	//Comprobación tipo no es null
	if ($tipo == "Tipo"){
		$tipoNull = true;
	}

	//Respuesta del servidor
	if($existeUsuario){
		echo "Usuario existe";
	} else if ($existeEmail){
		echo "Email existe";
	} else if ($tipoNull){
		echo "Tipo null";
	} else if($existeUsuario == false && $existeEmail == false){
		//Si la contraseña coincide se hace el insert del usuario
		if ($pass == $pass2){
			//Se hashea la contraseña
			$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
			$sql = "INSERT INTO cliente (name, user, email, telf, type, password) VALUES (?,?,?,?,?,?)";
			$rdo = $conn->prepare($sql);
			$rdo->bind_param("ssssss", $nombre, $usuario, $email, $numero, $tipo, $hashed_password);
			if ($rdo->execute()) {
			    echo "1";
			} else {
			    echo "Error al insertar los datos";
			}
		} else {
			echo "Error password";
		}
	}
} else {
	echo "Error, no existen todos los atributos";
}
$conn->close();
?>