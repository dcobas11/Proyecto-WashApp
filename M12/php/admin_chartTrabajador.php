<?php

include "dbConnection.php";

$result=mysqli_query($conn, "select count(*) from trabajador");

$data = array();
while ($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
}
// Devuelve codificado en json toda la fila
echo json_encode($data);

$conn->close();
?>