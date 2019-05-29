<?php
	if(isset($_SESSION["user"])){
?>
	<ul class="navbar-nav ml-auto">
		<li class="nav-item active dropdown">
		    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		        <span class='fas fa-user'></span> <?php echo $_SESSION["user"]; ?>
		    </a>
		    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
		        <a class="dropdown-item" href="cliente.php"><span class='fas fa-info-circle'></span> Pedidos</a>
		        <a class="dropdown-item" href="php/logout.php"><span class='fas fa-sign-out-alt'></span>  Logout </a>
		    </div>
		</li>
	</ul>
<?php
	} else {
?>
	<ul class="nav navbar-nav justify-content-md-center justify-content-start flex-nowrap">
		<li class="nav-item li-login">
		    <a class="btn btn-light btn-sm active login" href="index_login.php" role="button">ACCEDE</a>
		</li>
		<li class="nav-item">
		     <a class="btn btn-primary btn-sm active alta" href="index_register.php" role="button">DATE DE ALTA</a>
		</li>
	</ul>
<?php
	}
?>