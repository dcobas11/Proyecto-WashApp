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
    <nav class="navbar navbar-expand bg-light navbar-light fixed-top">
		<?php
		include("blocks/navbar-brand.php");
		?>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<?php
			  	include("blocks/navbar-clientInfo.php");
			  	?>
	        	<ul class="navbar-nav ml-auto">
		            <li class="nav-item dropdown dropCart">
		                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                	<i class="fas fa-shopping-cart"></i><span class="bdge">0</span>
		                </a>
		                <div class="dropdown-menu dropMenu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
				        	<div class="container mini-cart">
						  		<div class="shopping-cart">
						    		<div class="shopping-cart-header">
						      			<i class="fa fa-shopping-cart cart-icon"></i><span class="bdge">0</span>
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
	    	</ul>
	    </div>
	</nav>
</header>
<!-- Listado Productos -->
<div class="container cont-padd">
	<!-- Return to Top -->
	<a href="javascript:" id="return-to-top">
		<i class="fas fa-chevron-up"></i>
	</a>

	<div class="row">
		<ul class="filters text-center">
            <li class="active" data-filter="*"><a href="#!">Todo</a></li>
            <li data-filter=".cat1"><a href="#!">Superior</a></li>
            <li data-filter=".cat2"><a href="#!">Inferior</a></li>
            <li data-filter=".cat3"><a href="#!">Accesorios</a></li>
            <li data-filter=".cat4"><a href="#!">Hogar</a></li>
            <li data-filter=".cat5"><a href="#!">Packs</a></li>
        </ul>
	</div>

	<div class="products">
		<div class="row products_list grid">
			<!-- shop_list.js content -->
		</div>
	</div>
</div>
<!-- Footer -->
<?php
	include("blocks/footer.php");
?>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.waitforimages/1.5.0/jquery.waitforimages.min.js"></script>
</body>
</html>
<script type="text/javascript">
	// ===== Scroll to Top ==== 
$(window).scroll(function() {
	//Si se hace scroll mas de 50px
    if ($(this).scrollTop() >= 50) {        
        $('#return-to-top').fadeIn(200);    
    } else {
        $('#return-to-top').fadeOut(200);   
    }
});
$('#return-to-top').click(function() {     
    $('body,html').animate({
        scrollTop : 0                      
    }, 500);
});
</script>
<style type="text/css">

ul.filters{
    display: block;
    width: 100%;
    margin: 0;
    padding: 30px 0;
}

ul.filters > li{
    list-style: none;
    display: inline-block;
}

ul.filters > li > a{
    display: block;
    color: #434e5e;
    text-decoration: none;
    padding: 5px 20px;
}

ul.filters > li > a:hover{
    background-color: #e6e9ed;
}

ul.filters > li.active > a{
    color: #fff;
    background-color: #28bea8;
}

#return-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.7);
    width: 50px;
    height: 50px;
    display: block;
    text-decoration: none;
    -webkit-border-radius: 35px;
    -moz-border-radius: 35px;
    border-radius: 35px;
    display: none;
    -webkit-transition: all 0.3s linear;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top i {
    color: #fff;
    margin: 0;
    position: relative;
    left: 16px;
    top: 13px;
    font-size: 19px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
#return-to-top:hover {
    background: rgba(0, 0, 0, 0.9);
}
#return-to-top:hover i {
    color: #fff;
    top: 5px;
}

.products_list .item{
    min-height: 450px;
}

.products_list .item h3{
    min-height: 70px;
}
</style>