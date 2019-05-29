<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>Login</title>
  	<script type="text/javascript" src="javascript/login.js"></script> 
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
<!-- Login -->
<article class="card-body mx-auto">
	<h4 class="card-title mt-3 text-center">Accede a tu cuenta</h4>
	<p class="text-center">Estás a un paso de poder hacer tu pedido.</p>
	<form id="login-form" method="post">
	    <div class="form-group input-group">
			<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-user-circle"></i> </span>
			 </div>
	        <input name="usuario" class="form-control" placeholder="Usuario" type="text" required>
	    </div> <!-- form-group// -->
	    <div class="form-group input-group">
	    	<div class="input-group-prepend">
			    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
			</div>
	        <input name="pass" class="form-control" placeholder="Contraseña" type="password" required>
	    </div> <!-- form-group// -->
	    <div class="form-group">
	        <input type="submit" class="btn btn-primary btn-block" id="login-btn" value="Enviar" required>
	    </div> <!-- form-group// -->      
	    <span id="login-result"></span>
	    <p class="text-center">¿No tienes cuenta? <a href="index_register.php">Registrarse</a> </p>                                                                 
	</form>
</article>
<!-- Footer -->
<?php
	include("blocks/footer.php");
?>
</body>
</html>