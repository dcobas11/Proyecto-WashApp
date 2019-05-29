<?php

include "dbConnection.php";
session_start();

$userW = ($_SESSION["employee"]);
$data = $userW;

echo json_encode($data);

$conn->close();
?>
