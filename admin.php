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
  	<script type="text/javascript" src="javascript/admin.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
	<nav class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
		<?php
		include("blocks/navbar-brandDark.php");
		?>
		<?php
		include("blocks/navbar-adminContent.php");
		?>
	</nav>
</header>
<!-- Tabla Precios -->
<div class="container cont">
	<div class="form-group">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4">
				<button type="button" class="btn btn-dark btn-block btn-alta" data-toggle="modal" data-target="#altaModal">Alta trabajador</button>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-8">
				<div class="input-group">
					<span class="input-group-text">Buscar producto</span>
					<input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Nombre">
				</div>
			</div>
		</div>
	</div>
	<table id="mytable" class="table table-striped table-dark">
		<tr class="table-active">
			<th>ID</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Editar</th>
		</tr>
		<tbody id="data"> 
			<!-- Aqui van los datos .js -->
		</tbody>
	</table>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editarPrecio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-pen"></i> Editar precio</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body px-4">
	        <div class="wrapper">
			    <form id="myformEdit" method="post">
			    	<div class="form-row mb-2">
			    		<div class="form-group col-12 mb-2">
			    			<label class="control-label">Nombre</label>
			    			<input type="text" id="nombre" name="nombre" required="required" readonly class="form-control" placeholder="Nombre">
			    		</div>
			    		<div class="form-group col-12 mb-2">
			    			<label class="control-label">Precio</label>
			    			<input type="text" id="precio" name="precio" required="required" class="form-control" placeholder="Nuevo precio">
			    		</div>
			    	</div>
					<input type="hidden" name="id" id="id">
					<span id="edit-result"></span>
				</form>
	 		</div>
		   </div>
	     <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	        <button type="submit" class="btn btn-primary" id="precioEditado">Aceptar</button>
	      </div>
	    </div>
	</div>
</div>
<!-- Alta Modal -->
<div class="modal fade" id="altaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alta nuevos empleados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="admin-form" method="post">
		 	<div class="form-group input-group">
		    	<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-user"></i> </span>
				</div>
		    	<input name="nombre" type="text" class="form-control" placeholder="Nombre" required>
		  	</div>
		  	<div class="form-group input-group">
		    	<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-user-circle"></i> </span>
				</div>
		    	<input name="usuario" type="email" class="form-control" placeholder="Usuario" required>
		 	</div>
		   	<div class="form-group input-group">
		   		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
				</div>
		    	<input name="pass" type="password" class="form-control" placeholder="Contraseña" required>
		  	</div>
		  	<div class="form-group input-group">
		  		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-phone"></i> </span>
				</div>
			    <input name="numero" type="text" class="form-control" placeholder="Número" required>
			</div>
		   	<div class="form-group input-group">
			    <div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-id-card"></i> </span>
				</div>
			    <input name="card" type="text" class="form-control" placeholder="DNI / NIE" required>
		 	</div>
		  	<div class="form-group input-group">
		  		<div class="input-group-prepend">
			    	<span class="input-group-text"> <i class="fa fa-id-card-alt"></i> </span>
				</div>
			    <input name="ss" type="text" class="form-control" placeholder="Seguridad Social" required>
		  	</div>
		    <span id="alta-result"></span>
		</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn btn-primary" id="admin-btn" value="Enviar" required>
      </div>
    </div>
  </div>
</div>

</body>
</html>