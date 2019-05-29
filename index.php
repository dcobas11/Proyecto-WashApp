<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Lavandería Online</title>
  	<script type="text/javascript" src="javascript/index_accordion.js"></script> 
</head>
<body>
<!-- Header Navigation -->
<header>
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
		<?php
		include("blocks/navbar-brand.php");
		?>
	  	<div class="collapse navbar-collapse" id="navbarNav">
		  	<ul class="navbar-nav justify-content-center d-flex flex-fill">
		    	<li class="nav-item active">
		      		<a class="nav-link nav-menu" href="#slide_home">Home</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link nav-menu" href="#boxes">Servicio</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link nav-menu" href="#banner">Sobre nosotros</a>
		   		</li>
		   		<li class="nav-item">
		      		<a class="nav-link nav-menu" href="#options">Opciones</a>
		   		</li>
		   		<li class="nav-item">
		      		<a class="nav-link nav-menu" href="#contact">Contacto</a>
		   		</li>
		   		<li class="nav-item">
		      		<a class="nav-link nav-menu" href="shop.php">Tienda</a>
		   		</li>
		  	</ul>
		  	<?php
		  	session_start();
		  	include("blocks/navbar-clientInfo.php");
		  	?>
		</div>
	</nav>
</header>
<!-- Home Background -->
<section id="slide_home">
	<div class="overlay">
		<div class="container">
			<div class="banner-content">
				<h1>Bienvenido a <span>Wash</span>App</h1>
				<p>Hoy estás de suerte, sal ahí fuera. ¡Nosotros lavamos la ropa por ti!</p>
				<a href="#boxes" class="btn-banner">Más información</a>
			</div>
		</div>
	</div>
</section>
<!-- Cajas Servicio -->
<section id="boxes">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>Servicio</h2>
				<div class="line"></div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="service-box">
					<div class="div_image_box text-center">
		            	<img class="" src="media/computer.png">
		          	</div>
		          	<div class="box-text text-center">
		          		<h5>Pedido</h5>
		          		<p>Lo único que tienes que hacer es decirnos el tipo de ropa y cantidad que quieres lavar.</p>
		          	</div>
		        </div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="service-box">
					<div class="div_image_box text-center">
		            	<img class="" src="media/car.png">
		          	</div>
		          	<div class="box-text text-center">
		          		<h5>Recogida</h5>
		          		<p>Uno de nuestros trabajadores irá a por tu ropa y la recibiras de vuelta en menos de 48h.</p>
		          	</div>
	          	</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12">
				<div class="service-box">
					<div class="div_image_box text-center">
		            	<img class="" src="media/t-shirt.png">
		          	</div>
		          	<div class="box-text text-center">
		          		<h5>Entrega</h5>
		          		<p>Recibes de vuelta tu ropa limpia y reluciente sin apenas moverte. Tu tiempo es muy importante.</p>
		          	</div>
	          	</div>
			</div>
		</div>
	</div>
</section>
<!-- Banner Sobre Nosotros -->
<section id="banner">
	<div class="overlay-banner">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<div class="banner2-content">
						<h2>Sobre nosotros</h2>
						<div class="line2"></div>
						<p>WashApp es una empresa que nace en Barcelona con el objetivo de digitalizar el lavado de todo tipo de prenda.</p>
						<p>Nuestro principal objetivo es ofrecer a los usuarios poder hacer una comanda de manera fácil. Lo único que tienes que hacer es prepararla y dejarla lista para que uno de nuestros trabajadores pase a buscarla y en un máximo de 48 horas la tendrás de vuelta. Puedes dedicar tu tiempo a hacer cosas mas divertidas que preocuparte por hacer la colada.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Opciones -->
<section id="options">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>Opciones de lavado</h2>
				<p>Olvídate de hacer la colada</p>
				<div class="line"></div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="option-box">
					<h5><i class="fas fa-socks"></i> Pieza</h5>
					<p>Puedes escoger por categoria, parte superior e inferior. También otros tipos, como sabanas, manteles, etc.</p>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12">
				<div class="option-box">
					<h5><i class="fas fa-box"></i> Pack</h5>
					<p>Si eres empresa, vas a ahorrar muchísimo y si no también. Tenemos packs de 5, 10, 15 y 20 kg de ropa.</p>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="option-box">
					<h5><i class="fas fa-file-invoice-dollar "></i> Puedes consultar aquí nuestros precios</h5>
						<div id="accordion">
					        <div class="card">
					            <div class="card-header" id="headingOne">
					                <h5 class="mb-0 d-inline">
					                    <a role="button" id="btn-plus" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
					                	Piezas Individuales
					          		         <i class="fa fa-plus-square"></i>
					                    </a>
					                 </h5>
					            </div>
					            <div id="collapseOne" class="collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
					                <div class="card-content" id="child1">
					                    <div class="card">
					                        <div class="card-header">
					                            <a role="button" class="btn btn-link" data-toggle="collapse" 
					                     		data-target="#collapseOneA">Superior</a>
					                        </div>
					                        <div class="card-content collapse" data-parent="#child1" id="collapseOneA">
					                            
					                        </div>
					                    </div>
					                    <div class="card">
					                        <div class="card-header">
					                            <a role="button" class="btn btn-link" data-toggle="collapse" 
					                            data-target="#collapseOneB">Inferior</a>
					                        </div>
					                        <div class="card-content collapse" data-parent="#child1" id="collapseOneB">
					                            
					                        </div>
					                    </div>
					                    <div class="card">
					                        <div class="card-header">
					                            <a role="button" class="btn btn-link" data-toggle="collapse" 
					                            data-target="#collapseOneC">Accesorios</a>
					                        </div>
					                        <div class="card-content collapse" data-parent="#child1" id="collapseOneC">
					                            
					                        </div>
					                    </div>
					                    <div class="card">
					                        <div class="card-header">
					                            <a role="button" class="btn btn-link" data-toggle="collapse" 
					                            data-target="#collapseOneD">Hogar</a>
					                        </div>
					                        <div class="card-content collapse" data-parent="#child1" id="collapseOneD">
					                            
					                        </div>
					                    </div>
					                </div>
					            </div>
					        </div>
					        <div class="card">
					            <div class="card-header" id="headingOne">
					                <h5 class="mb-0 d-inline">
					                    <a role="button" id="btn-plus2" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
					                	Packs
					          		         <i class="fa fa-plus-square"></i>
					                    </a>
					                 </h5>
					            </div>
							<div id="collapseTwo" class="collapse hide card-content" aria-labelledby="headingOne" data-parent="#accordion">
				 			</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 text-center">
				<div class="option-box">
					<h5>Ambas opciones incluyen</h5>
					<p>Detergente/suavizante.</p>
					<p>Y si lo deseas, opcionalmente el planchado por un pequeño plus.</p>
					<a class="btn btn-secondary active" href="shop.php" role="button">Empezar</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Contacto -->
<section id="contact">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<h2>Contacto</h2>
				<div class="line"></div>
			</div>
			<div class="col-md-8">
            	<div class="well well-sm">
	                <form id="contact">
	                <div class="row">
	                    <div class="col-md-6">
	                    	<label for="name">Nombre</label>
	                    	<div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
								 </div>
						        <input name="" class="form-control" placeholder="Nombre" type="text">
						    </div>
						    <label for="name">Email</label>
						    <div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
								 </div>
						        <input name="" class="form-control" placeholder="Email" type="text">
						    </div>
	                        <div class="form-group">
	                            <label for="subject">Tema</label>
	                            <select id="subject" name="subject" class="form-control" required="required">
	                                <option value="na" selected="">Elige uno:</option>
	                                <option value="service">Felicitación</option>
	                                <option value="suggestions">Sugerencia</option>
	                                <option value="product">Queja</option>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            <label for="name">Mensaje</label>
	                            <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
	                                placeholder="Mensaje"></textarea>
	                        </div>
	                    </div>
	                    <div class="col-md-12">
	                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">Enviar</button>
	                    </div>
	                </div>
	                </form>
            	</div>
        	</div>
	        <div class="col-md-4">
	            <form id="contact">
	            <legend><i class="fas fa-globe-europe"></i> Nuestro local</legend>
	            <address>
	                <strong>WashApp SL.</strong><br>
	                Calle falsa 123<br>
	                Barcelona, 08020<br>
	                699 99 99 99
	            </address>
	            <address>
	                <strong>Email</strong><br>
	                <a href="mailto: washapp@washapp.com">washapp@washapp.com</a>
	            </address>
	            </form>
	        </div>
		</div>
	</div>
</section>
<!-- Footer -->
<?php
	include("blocks/footer.php");
?>
</body>
</html>