// Mostrar lista con JQuery
$(document).ready(function(){
	listadoProductos();
	altaEmpleado();

	//Busqueda directa por input
	$('#busqueda').keyup(function(){
		//Guarda el valor del input en una variable cuando se "suelta" la tecla
		var texto = $(this).val();
		//Borro todo el tbody que esta por defecto, con todos los datos select *	
		$('#data').html("");
		$.ajax({
			url: "php/admin_buscar.php",
			method: "POST",
			data: {buscar:texto},
			success: function(response){
				var data = JSON.parse(response);
				//valor html para tbody
				var html = "";

				for (var i = 0; i < data.length; i++){
					var nombre = data[i].nombre;
					var precio = data[i].precio;
					var id = data[i].id;
					html += "<tr id='"+id+"'>";
						html += "<td>" + id + "</td>";
						html += "<td>" + nombre + "</td>";
						html += "<td>" + precio + " €</td>";
						html += "<td><i class='fas fa-edit' id='"+id+"'></i></td>";
					html += "</tr>";
				}
				//se pone el resulado del documento con todos los datos
				$('#data').html(html);
			}
		});
	});

	//Editar 
	$(document).on('click', '.fa-edit', function(){
		//Se recoge el id del botón al hacer click
		var id = this.id;
		$.ajax({
			url: 'php/admin_edit.php',
			method: 'POST',
			data: {id:id},
			success: function(response){
				var data = JSON.parse(response);
				for (var i = 0; i < data.length; i++){
					$('#id').val(data[i].id);
					$('#nombre').val(data[i].nombre);
					$('#precio').val(data[i].precio);
					$("#editarPrecio").modal("show");
				}
			}
		});
	});

	//boton de aceptar del modal
	$('#precioEditado').click(function(){
		//se recoge el valor de los inputs editados
		var data = $("#myformEdit").serialize();
		$.ajax({
			url: 'php/admin_editSave.php',
			method: 'POST',
			data: data,
			cache: "false",
			success: function(response){
				if (response=="actualizado"){
					$('#edit-result').html("");
					Swal.fire({
						type: 'success',	
						title: ":)",
						text: "El precio ha sido actualizado correctamente.",
						icon: "success",
						button: "Aceptar",
					}).then(function(){
						$('#editarPrecio').modal('toggle');
						location.reload();
					});
				} else if (response=="error precio") {
					$('#edit-result').html("<div class='alert alert-warning' role='alert'>Introduce el <b>precio.</b></div>");
		  		} else {
					console.log(response);
		  		}
			}
		});
	});
});

function listadoProductos(){
	$.ajax({
		url: 'php/shop_list.php',
		type: 'GET',
		//que quiero que pase si todo va bien se ejecuta la funcion y saldra la respuesta del servidor
		success: function(response){
			var data = JSON.parse(response);
			//console.log(data);
			if (data.Error) {
				console.log("No hay ningun producto");
			} else {
				//valor html para tbody
				var html = "";

				for (var i = 0; i < data.length; i++){
					var nombre = data[i].nombre;
					var precio = data[i].precio;
					var id = data[i].id;
					html += "<tr id='"+id+"'>";
						html += "<td>" + id + "</td>";
						html += "<td>" + nombre + "</td>";
						html += "<td>" + precio + " €</td>";
						html += "<td><i class='fas fa-edit' id='"+id+"'></i></td>";
					html += "</tr>";
				}
				//se pone el resulado del documento con todos los datos
				$('#data').html(html);
			}
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}

function altaEmpleado(){
	//Boton click dentro del modal
	$("#admin-btn").click(function() {
		//cuando se hace submit, mejor que click para que pase la validación html5 de required
		var data = $("#admin-form").serialize();
		//$.ajax(url, [ parámetros ]);
		$.ajax({
			url: 'php/admin_altas_trabajador.php',
			method: 'POST',
			data: data,
			cache: "false",
			beforeSend: function(){
	  			$('#admin-btn').val("Añadiendo...");
	  		},
			success: function(response){
				$('#admin-btn').val("Enviar");
				//Si el servidor responde con un 1 es que todo ha ido bien
				if (response=="1"){
					$('#alta-result').html("");
					Swal.fire({
						type: 'success',	
						title: "¡Alta ok!",
						text: "El trabajador ha sido dado de alta correctamente.",
						icon: "success",
						button: "Aceptar",
					}).then(function(){
						window.location = location.href;
					});
				//Control de errores
				} else if (response=="Error"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'>Rellena los campos correctamente.</div>");
				} else if (response=="Error user"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'><b>Error usuario,</b> formato email incorrecto.</div>");
				} else if (response=="Error pass"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'><b>Error contraseña,</b> mínimo 8 carácteres.</div>");
				} else if (response=="Error numero"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'><b>Número</b> incorrecto.</div>");
				} else if (response=="Error dni"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'><b>DNI/NIE</b> incorrecto.</div>");
				} else if (response=="Error numSS"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'><b>Número SS.</b> incorrecto.</div>");
				} else if (response=="Usuario existe"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'>El <b>usuario</b> que has ingresado ya está dado de alta.</div>");
				} else if (response=="Dni existe"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'>El <b>dni/nie</b> que has ingresado ya está dado de alta.</div>");
				} else if (response=="SS existe"){
					$('#alta-result').html("<div class='alert alert-warning' role='alert'>El <b>número de ss.</b> que has ingresado ya está dado de alta.</div>");
		  		} else {
		  			console.log(response);
		  		}
			},
			error: function(){
				Swal.fire({
					type: 'error',
					title: 'Oops...',
					text: 'Se ha producido un error',
				})
			}
		});
	});
}