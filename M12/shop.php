<?php
include("blocks/sessionToUserLogin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Shop </title>
	<script type="text/javascript" src="javascript/shop_list.js"></script> 
</head>
<body>
<!-- Header Navigation -->
<header>
    <nav class="navbar navbar-expand-md bg-light navbar-light">
		<?php
		include("blocks/navbar-brand.php");
		?>

		<div class="collapse navbar-collapse" id="navbarNav">
        	<ul class="navbar-nav ml-auto">
	            <li class="nav-item dropdown">
	                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                	<i class="fas fa-shopping-cart"><span class="badge">0</span></i>
	                </a>

	                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
			        	<div class="container mini-cart">
					  		<div class="shopping-cart">
					    		<div class="shopping-cart-header">
					      			<i class="fa fa-shopping-cart cart-icon"></i><span class="badge">0</span>
					      			<div class="shopping-cart-total">
					        			<span class="lighter-text">Total:</span>
					        			<span class="total-price">0 €</span>
					      			</div>
					    		</div> <!--end shopping-cart-header -->
					    		<ul class="shopping-cart-items">
					      			<!-- valores desde shop_list.js -->
					    		</ul>
					    		<p class="sad-cart">Tu carrito esta vacío :(</p>
					    		<a href="pago.php" class="btn-payment">Realizar pedido</a>
						  	</div> <!--end shopping-cart -->
						</div> <!--end container -->
			        </div>
	            </li>
	        </ul>
	    </div>
		
	</nav>
</header>
<!-- Listado Productos -->
<div class="container">
	<div class="row">
		<!-- shop_list.js content -->
	</div>
</div>
</body>
</html>