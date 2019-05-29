<?php
include "dbConnection.php";
	
	$data = array();
	for ($i = 1; $i < 5; $i++){

		$aux = (string)$i;

		$aux=mysqli_query($conn, "select dia_recogida, franja, count(franja) as contFranja from comanda where franja='$aux' group by dia_recogida");
		
		while ($row = mysqli_fetch_assoc($aux)){
			$data[] = $row;
		}
	}
	// Devuelve codificado en json toda la fila
	echo json_encode($data);
$conn->close();
?>