// Mostrar lista con JQuery
$(document).ready(function(){
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