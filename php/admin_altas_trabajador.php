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
	$faltaCampo = false;
	$nSSOK = false;
	$numeroOK = false;
	$dniOK = false;
	$passOK = false;
	$emailOK = false;

	if($nombre == "" || $usuario == "" || $pass == "" || $numero == "" || $dni == "" || $ss == "" ){
		$faltaCampo = true;
	}

	//Verificar email 
	if(preg_match("/[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,5}$/", $usuario)){
		$emailOK = true;
	}

	//Verificar contraseña 
	if(preg_match("/^[a-zA-Z0-9]{8,}$/", $pass)){
		$passOK = true;
	}

	//Verificar numero 
	if(preg_match("/^[0-9]{9,13}$/", $numero)){
		$numeroOK = true;
	}

	//Verificar formato DNI NIE
	if(preg_match("/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i", $dni) || preg_match("/^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i", $dni)){
 		$dniOK = true;
	} 

	//Verificar numero SS
	if(preg_match("/^[0-9]{12,}$/", $ss)){
		$nSSOK = true;
	}

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
	if($faltaCampo){
		echo "Error";
	} else if ($emailOK == false){
		echo "Error user";	
	} else if ($passOK == false){
		echo "Error pass";	
	} else if ($numeroOK == false){
		echo "Error numero";	
	} else if ($dniOK == false){
		echo "Error dni";	
	} else if ($nSSOK == false){
		echo "Error numSS";	
	} else if($existeUsuario){
		echo "Usuario existe";
	} else if ($existeDni){
		echo "Dni existe";
	} else if ($existeSS){
		echo "SS existe";
	} else if($nSSOK && $emailOK && $passOK && $numeroOK && $dniOK && $existeUsuario == false && $existeDni == false && $existeSS == false && $faltaCampo == false){
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