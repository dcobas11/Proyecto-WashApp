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
  	<script type="text/javascript" src="javascript/admin_altas.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
	<?php
	include("blocks/navbar-employees.php");
	?>
</header>
<!-- Insert Trabajador -->
<div class="container">
		<form id="admin-form" method="post">
			<h4 align="center">Alta nuevos empleados</h4>
		 	<div class="form-group input-group">
		    	<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-user"></i> </span>
				</div>
		    	<input name="nombre" type="text" class="form-control" placeholder="Nombre" pattern="^[a-zA-Z ]{3,50}$" minlength="3" maxlength="50" required>
		  	</div>
		  	<div class="form-group input-group">
		    	<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-user-circle"></i> </span>
				</div>
		    	<input name="usuario" type="email" class="form-control" placeholder="Usuario" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,5}$" required>
		 	</div>
		   	<div class="form-group input-group">
		   		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
		    	<input name="pass" type="password" class="form-control" placeholder="Contraseña" pattern="^[a-zA-Z0-9]{8,}$" minlength="8" required>
		  	</div>
		  	<div class="form-group input-group">
		  		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
				</div>
			    <input name="numero" type="text" class="form-control" placeholder="Número" pattern="^[0-9]{9,13}$" minlength="9" maxlength="13" required>
			</div>
		   	<div class="form-group input-group">
			    <div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
				</div>
			    <input name="card" type="text" class="form-control" placeholder="DNI / NIE" pattern="((([X-Z])|([LM])){1}([-]?)((\d){7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]))" required>
		 	</div>
		  	<div class="form-group input-group">
		  		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-id-card-alt"></i> </span>
				</div>
			    <input name="ss" type="text" class="form-control" placeholder="Seguridad Social" required>
		  	</div>
		  	<div class="form-group">
		        <input type="submit" class="btn btn-primary" id="admin-btn" value="Enviar" required>
		    </div>
		    <span id="alta-result"></span>
		</form>
	</div>
</body>
</html>