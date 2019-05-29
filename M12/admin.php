<?php
include("blocks/session-admin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Admin</title>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  	<script type="text/javascript" src="javascript/admin_chart.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
	<?php
	include("blocks/navbar-employees.php");
	?>
</header>
<!-- Chart -->
<div class="container cont">
	<div class="row">
		<div class="col-10">
			<canvas id="myChart"></canvas>
		</div>
	</div>
</div>
</body>
</html>