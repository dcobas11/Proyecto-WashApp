<?php
include("blocks/sessionToUserLogin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Payment</title>
	<script type="text/javascript" src="javascript/pago.js"></script> 
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
	<div class="container cont">
		<table id="tableDays">

		</table>
		<div class="row">
			<div class="col-12">
	    		<i class="fa fa-shopping-cart cart-icon"></i><span class="badge">0</span>
	   		</div>
	   	</div>
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12">
				<div class="cart-box">
					<div class="shopping-cart-header">
					    <div class="row row-info">
					    	<div class="col-6">
					    		Producto
					    	</div>
					    	<div class="col-2">
					    		Precio
					    	</div>
					    	<div class="col-2">
					    		Cantidad
					    	</div>
					    	<div class="col-2">
					    		Total
					    	</div>
					    </div>
					</div>
					<div class="shopping-cart-content">
						<div class="row row-content">
					    	
					    </div>
					</div>
					<div class="divider"></div>
					<div class="shopping-cart-footer">
						<div class="row text-center">
							<div class="col-12">
								<a href="shop.php" class="btn-cart">Volver a tienda</a>
								<a href="" class="btn-cart" id="vaciarCarrito">Vaciar cesta</a>
					    	</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-12">
				<div class="cart-box">
					<div class="row">
						<div class="col-12">
							<div class="cart-frase">
								Uno de nuestros trabajadores de WashApp irá a por la ropa a la hora acordada.
							</div>
						</div>
						<div class="col-12">
							<div class="form-check cart-planchado">
							    <input type="checkbox" class="form-check-input" name="checkbox-planchado" id="add-planchado">
							    <label class="form-check-label" for="add-planchado">Contratar planchado</label>
							    <span class="planchado">El precio del planchado es del 10% del total de los productos.</span>
							</div>
						</div>
						<div class="col-12">
							<div class="cart-total">
					        	
					      	</div>
						</div>
						<div class="col-12">
							<a href="#" class="btn-payment">Realizar pago</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-6">
				<div class="address-box">

				</div>
				<div class="add-address">
					<i class="fas fa-plus"></i> Añadir/modificar dirección
				</div>
			</div>
			<div class="col-6">
				<div class="schedule-box">
					<p>Horario</p>
					<p>fecha recogida</p>
					<p>fecha vuelta</p>
				</div>
				<div class="add-schedule">
					<i class="fas fa-plus"></i> Escoger horario recogida/entrega
				</div>
			</div>
		</div>
    </div>
    <!-- Address Modal -->
	<div class="modal fade" id="address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  		<div class="modal-dialog" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
        			<h5 class="modal-title" id="exampleModalLabel">Dirección recogida/entrega</h5>
        			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          				<span aria-hidden="true">&times;</span>
        			</button>
      			</div>
      			<div class="modal-body">
      				<div class="wrapper">
						<form id="addressEditForm" method="post">
					    	<div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
								</div>
						        <input name="nombre" id="nombre" class="form-control" placeholder="Nombre completo" type="text" pattern="^[a-zA-Z ]{3,50}$" minlength="3" maxlength="50" required>
						    </div> <!-- form-group// -->

						    <div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i> </span>
								</div>
						        <input name="direccion" id="direccion" class="form-control" placeholder="Dirección" type="text" required>
						    </div> <!-- form-group// -->

						    <div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-building"></i> </span>
								</div>
						        <input name="ciudad" id="ciudad" class="form-control" placeholder="Barcelona" value="Barcelona" type="text" readonly required>
						    </div> <!-- form-group// -->

						    <div class="form-group input-group">
								<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fas fa-map-signs"></i> </span>
								</div>
						        <input name="codigopostal" id="codigopostal" class="form-control" placeholder="Codigo Postal" type="text" required>
						    </div> <!-- form-group// -->
						    
						    <div class="form-group input-group">
						    	<div class="input-group-prepend">
								    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
								</div>
						    	<input name="numero" id="numero" class="form-control" placeholder="Número" type="text" pattern="^[0-9]{9,13}$" minlength="9" maxlength="13" required>
						    </div> <!-- form-group// -->
						    <span id="address-result"></span>
			   			</form>
			  		</div>
      			</div>
      			<div class="modal-footer">
        			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        			<button type="submit" class="btn btn-primary" id="btn-add-address">Enviar</button>
      			</div>
    		</div>
  		</div>
	</div>
	<!-- Payment Modal -->
	<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	    <div class="modal-dialog" role="document">
		    <div class="modal-content">
		    	<div class="modal-header">
		        	<h5 class="modal-title" id="exampleModalLabel"><strong>PAYMENT</strong></h5>
					<div class="cards">
						<i class="fab fa-cc-visa fa-2x" aria-hidden="true"></i>
						<i class="fab fa-cc-mastercard fa-2x" aria-hidden="true"></i>
						<i class="fab fa-cc-discover fa-2x" aria-hidden="true"></i>
						<i class="fab fa-cc-amex fa-2x" aria-hidden="true"></i>
					</div>
		      	</div>
		      	<div class="modal-body">
			        <div class="wrapper">
					    <form id="cardPaymentForm" method="post">
						    <div class="form-group">
						      	<label for="cardNumber"><strong>CARD NUMBER</strong></label>
						      	<div class="input-group">
						        	<input type="text" class="form-control border-right-0" name="cardNumber" id="cardNumber" data-mask="0000 0000 0000 0000" placeholder="Card Number">
							       	<div class="input-group-prepend">
						        		<span class="input-group-text rounded-right" id="cardNumber"><i class="fa fa-credit-card"></i></span>
						        	</div>
						        </div>
							</div>
							<div class="row">
								<div class="col-md-8 col-12">
						  			<div class="form-group">
								    	<label for="cardExpirationDate"><strong>EXPIRATION DATE</strong></label>
								    	<input type="text" class="form-control" name="cardExpirationDate" id="cardExpirationDate" data-mask="00 / 00" placeholder="MM / YY">
									</div>
						  		</div>
							  	<div class="col-md-4 col-12">
							  		<div class="form-group">
									    <label for="cardCvcCode"><strong>CVC CODE</strong></label>
									    <input type="text" class="form-control" name="cardCvcCode" id="cardCvcCode" data-mask="000" placeholder="CVC">
									</div>
							  	</div>
						  	</div>
						  	<div class="form-group">
						    	<label for="cardOwner"><strong>CARD OWNER</strong></label>
						    	<input type="text" class="form-control" name="cardOwner" id="cardOwner" placeholder="Card Owner Names">
						  	</div>
						  	<span id="card-result"></span>
						</form>
		  			</div>
		    	</div>
			    <div class="modal-footer">
			    	<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
			        <button type="button" class="btn btn-primary" id="voy_a_pagar">Pagar</button>
			    </div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php
		include("blocks/footer.php");
	?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
</body>
</html>

<script type="text/javascript">
	//Creacion fecha de hoy
var d1 = new Date();
//Se guarda en variable el dia que es (Lunes, Martes...)
var diaHoy = d1.toLocaleString("es", { weekday: 'long'});
//Si el dia de hoy es jueves, el tercer dia será lunes
if (diaHoy === "jueves"){
  //Guardo el dia en numero
  var diaN = d1.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  //Se crea la segunda fecha
  var d2 = new Date();
  d2.setDate(d1.getDate()+1);
  var dia2 = d2.toLocaleString("es", { weekday: 'long'});
  var diaN2 = d2.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();

  //Se crea la tercera fecha
  var d3 = new Date();
  d3.setDate(d2.getDate()+3);
  var dia3 = d3.toLocaleString("es", { weekday: 'long'});
  var diaN3 = d3.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  var html = "";
  html += "<table>";
 	html += "<tr>";
  		html += "<th>"+diaHoy+" "+diaN+"</th>";
  		html += "<th>"+dia2+" "+diaN2+"</th>";
  		html += "<th>"+dia3+" "+diaN3+"</th>";
 	html += "</tr>";
 	html += "<tr>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td franja='3' dia='"+diaN+"'>16:00 - 20:00</td>";
 	html += "</tr>" ;
  html += "</table>";

  $('#tableDays').html(html);

//Si el dia de hoy es viernes, los siguientes 2 pasarán a lunes y martes
} else if (diaHoy === "viernes"){
  //Guardo el dia en numero
  var diaN = d1.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  //Se crea la segunda fecha
  var d2 = new Date();
  d2.setDate(d1.getDate()+3);
  var dia2 = d2.toLocaleString("es", { weekday: 'long'});
  var diaN2 = d2.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();

  //Se crea la tercera fecha
  var d3 = new Date();
  d3.setDate(d2.getDate()+1);
  var dia3 = d3.toLocaleString("es", { weekday: 'long'});
  var diaN3 = d3.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  var html = "";
  html += "<table>";
 	html += "<tr>";
  		html += "<th>"+diaHoy+" "+diaN+"</th>";
  		html += "<th>"+dia2+" "+diaN2+"</th>";
  		html += "<th>"+dia3+" "+diaN3+"</th>";
 	html += "</tr>";
 	html += "<tr>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td franja='3' dia='"+diaN+"'>16:00 - 20:00</td>";
 	html += "</tr>" ;
  html += "</table>";

  $('#tableDays').html(html);

//Si el dia de hoy es sábado, este mismo dia pasará a lunes 
} else if (diaHoy === "sábado"){
  d1.setDate(d1.getDate()+2);
  
  var diaHoy = d1.toLocaleString("es", { weekday: 'long'});
  var diaN = d1.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  var d2 = new Date();
  d2.setDate(d1.getDate()+1);
  var dia2 = d2.toLocaleString("es", { weekday: 'long'});
  var diaN2 = d2.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();

var d3 = new Date();
d3.setDate(d2.getDate()+1);
var dia3 = d3.toLocaleString("es", { weekday: 'long'});
var diaN3 = d3.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
var html = "";
  html += "<table>";
 	html += "<tr>";
  		html += "<th>"+diaHoy+" "+diaN+"</th>";
  		html += "<th>"+dia2+" "+diaN2+"</th>";
  		html += "<th>"+dia3+" "+diaN3+"</th>";
 	html += "</tr>";
 	html += "<tr>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td franja='3' dia='"+diaN+"'>16:00 - 20:00</td>";
 	html += "</tr>" ;
  html += "</table>";

  $('#tableDays').html(html);

//Si el dia de hoy es domingo, este mismo dia pasará a lunes 
} else if (diaHoy === "domingo"){
  d1.setDate(d1.getDate()+1);
  
  var diaHoy = d1.toLocaleString("es", { weekday: 'long'});
  var diaN = d1.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  var d2 = new Date();
  d2.setDate(d1.getDate()+1);
  var dia2 = d2.toLocaleString("es", { weekday: 'long'});
  var diaN2 = d2.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();

var d3 = new Date();
d3.setDate(d2.getDate()+1);
var dia3 = d3.toLocaleString("es", { weekday: 'long'});
var diaN3 = d3.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
var html = "";
  html += "<table>";
 	html += "<tr>";
  		html += "<th>"+diaHoy+" "+diaN+"</th>";
  		html += "<th>"+dia2+" "+diaN2+"</th>";
  		html += "<th>"+dia3+" "+diaN3+"</th>";
 	html += "</tr>";
 	html += "<tr>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td franja='3' dia='"+diaN+"'>16:00 - 20:00</td>";
 	html += "</tr>" ;
  html += "</table>";

  $('#tableDays').html(html);
//Sino al dia 2 y al dia 3 se le suma solo 1 dia
} else {
  var diaHoy = d1.toLocaleString("es", { weekday: 'long'});
  var diaN = d1.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
  var d2 = new Date();
  d2.setDate(d1.getDate()+1);
  var dia2 = d2.toLocaleString("es", { weekday: 'long'});
  var diaN2 = d2.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();

var d3 = new Date();
d3.setDate(d2.getDate()+1);
var dia3 = d3.toLocaleString("es", { weekday: 'long'});
var diaN3 = d3.getDate()+"/"+d1.getMonth()+"/"+d1.getFullYear();
  
var html = "";
  html += "<table>";
 	html += "<tr>";
  		html += "<th>"+diaHoy+" "+diaN+"</th>";
  		html += "<th>"+dia2+" "+diaN2+"</th>";
  		html += "<th>"+dia3+" "+diaN3+"</th>";
 	html += "</tr>";
 	html += "<tr>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 		html += "<td>8:00 - 12:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 		html += "<td>12:00 - 16:00</td>";
 	html += "</tr>" ;
 	html += "<tr>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td>16:00 - 20:00</td>";
 		html += "<td franja='3' dia='"+diaN+"'>16:00 - 20:00</td>";
 	html += "</tr>" ;
  html += "</table>";

  $('#tableDays').html(html);
}
</script>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
  border: 1px solid black;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
  background-color: #4CAF50;
  color: white;
}
td{
	cursor: pointer;
}
</style>