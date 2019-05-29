<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>Registro</title>
  	<script type="text/javascript" src="javascript/register.js"></script> 
</head>
<body>
<!-- Header Navigation -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light">
		<?php
		include("blocks/navbar-brand.php");
		?>
	</nav>
</header>
<!-- Register -->
<article class="card-body mx-auto">
	<h4 class="card-title mt-3 text-center">Crear cuenta</h4>
	<p class="text-center">Empieza a usar WashApp con tu cuenta gratis.</p>
	<form id="register-form" method="post">
		<div class="form-group input-group">
			<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
			</div>
	        <input name="nombre" class="form-control" placeholder="Nombre" type="text" pattern="^[a-zA-Z ]{3,50}$" minlength="3" maxlength="50" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
			<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-user-circle"></i> </span>
			</div>
	        <input name="usuario" class="form-control" placeholder="Usuario" type="text" pattern="^[a-zA-Z0-9]{1,15}$" maxlength="15" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
			</div>
	        <input name="email" class="form-control" placeholder="Email" type="email" pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,5}$" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
			</div>
	    	<input name="numero" class="form-control" placeholder="Número" type="text" pattern="^[0-9]{9,13}$" minlength="9" maxlength="13" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
			</div>
			<select name="tipo" class="form-control" required>
				<option selected="">Tipo</option>
				<option>Particular</option>
				<option>Empresa</option>
			</select>
		</div> <!-- form-group end.// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
	        <input name="pass" class="form-control" placeholder="Contraseña" type="password" pattern="^[a-zA-Z0-9]{8,}$" minlength="8" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
	        <input name="pass2" class="form-control" placeholder="Repite contraseña" type="password" pattern="^[a-zA-Z0-9]{8,}$" minlength="8" required>
	    </div> <!-- form-group// -->                                      
	    <div class="form-group">
	        <input type="submit" class="btn btn-primary btn-block" id="register-btn" value="Enviar" required>
	    </div> <!-- form-group// -->    
	    <span id="register-result"></span>  
	    <p class="text-center">¿Tienes una cuenta? <a href="index_login.php">Log In</a> </p>                                                                 
	</form>
</article>
</body>
</html>