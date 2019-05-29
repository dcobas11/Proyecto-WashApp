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
	<script type="text/javascript" src="javascript/admin_menu.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
	<?php
	include("blocks/navbar-employees.php");
	?>
</header>
<!-- Tabla Precios -->
<div class="container cont">
	<h4 align="center">Listado de precios</h4>
	<div class="form-group">
		<div class="input-group">
			<span class="input-group-text">Buscar</span>
			<input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Nombre">
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
</body>
</html>