<?php

include "dbConnection.php";

if (isset($_POST['nPedido'])) {

	$nPedido = trim($_POST['nPedido']);

	$data = array();
	$r1 = $conn->prepare("SELECT cd.prod_id, cd.cantidad, p.nombre, p.precio from comandadetalle cd INNER JOIN producto p on p.id = prod_id where cd.com_id = ?");
	//Ligamos el parámetro ? con el atributo (variable) que nos interesa
	$r1->bind_param("i", $nPedido);
	//Ejecutamos la consulta
	$r1->execute();
	//Resultado de todos los atributos de la BBDD
	$r1->bind_result($pid, $cant, $n, $p);
	$result = $r1->get_result();
	if($r1){
		/* obtener los valores */
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
	}
	$r1->close();
	// Devuelve codificado en json toda la fila
	echo json_encode($data);
} else {
    echo "Error número pedido";
}
$conn->close();