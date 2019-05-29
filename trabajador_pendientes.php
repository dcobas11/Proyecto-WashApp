<?php
include("blocks/session-employee.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Admin</title>
  	<script type="text/javascript" src="javascript/workerIndex.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
		<?php
		include("blocks/navbar-brandDark.php");
		?>
		<?php
		include("blocks/navbar-employeeContent.php");
		?>
	</nav>
</header>
<div class="container cont">
	<table id="mytable" class="table table-striped table-dark">
		<tr class="table-active">
			<th>Nº Pedido</th>
			<th>Nombre</th>
			<th>Dia Recogida</th>
			<th>Franja</th>
			<th>Dia Entrega</th>
			<th>Franja</th>
			<th>Dirección</th>
			<th>Telefono</th>
			<th></th>
		</tr>
		<tbody id="pendiente"> 
			<!-- Aqui van los datos .js -->
		</tbody>
	</table>
</div>


</body>
</html>