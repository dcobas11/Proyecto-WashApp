<?php

include "dbConnection.php";

$result=mysqli_query($conn, "select * from producto");

$data = array();
while ($row = mysqli_fetch_assoc($result)){
	$data[] = $row;
}
// Devuelve codificado en json toda la fila
echo json_encode($data);

$conn->close();
?>