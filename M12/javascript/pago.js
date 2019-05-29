$(document).ready(function(){
	cartlist();
	drop();

	//Dirección del usuario
	$.ajax({
		url: 'php/pago_address.php',
		method: 'POST',
		success: function(response){
			var html = "";
			var nombre;
			var direccion;
			var ciudad;
			var cp;
			var telf;
			var data = JSON.parse(response);
			for (var i = 0; i < data.length; i++){
				nombre = data[i].name;
				direccion = data[i].address;
				ciudad = data[i].city;
				cp = data[i].cp;
				telf = data[i].telf;

				html += "<p><i class='fas fa-user-circle fs'></i><b> "+nombre+"</b></p>";
				html += "<p><i class='fas fa-home fs'></i>"+ciudad+" "+direccion+" "+cp+"</p>";
				html += "<p><i class='fas fa-phone-square fs'></i> "+telf+"</p>";
			}
			$('.address-box').html(html);

			//PAGO DEL USUARIO
			$('.btn-payment').click(function () {
				if (nombre == "" || direccion == "" || ciudad == "" || cp == "" || telf == ""){
					Swal.fire({
						type: 'warning',	
						title: "¡Atención!",
						text: "Dirección incompleta.",
						icon: "success",
						button: "Aceptar",
					});
				} else {
					$("#payModal").modal("show");
				}
			});

			//Boton final de pago del modal 
			$("#voy_a_pagar").click(function() {
		    	//se recoge el valor de los inputs introducidos
				var data = $("#cardPaymentForm").serialize();
				//$.ajax(url, [ parámetros ]);
				$.ajax({
					url: 'php/pago_final.php',
					method: 'POST',
					data: data,
					cache: "false",
					success: function(response){
						//Si el servidor responde con un 1 es que todo ha ido bien
						if (response=="1"){
							$('#card-result').html("");
							let timerInterval
							Swal.fire({
							  title: 'Procesando pago...',
							  timer: 1000,
							  onBeforeOpen: () => {
							    Swal.showLoading()							   
							  },
							  onClose: () => {
							    clearInterval(timerInterval)
							  }
							}).then((result) => {
							  if (
							    // Read more about handling dismissals
							    result.dismiss === Swal.DismissReason.timer
							  ) {
							    console.log('I was closed by the timer')
							  }
							})
						} else if (response=="error") {
							$('#card-result').html("<div class='alert alert-warning' role='alert'>Rellena todos los campos.</div>");
						} else if (response=="error card") {
							$('#card-result').html("<div class='alert alert-warning' role='alert'><b>Error,</b> número de tarjeta incorrecto.</div>");
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
	});

	$('.add-address').click(function () {
		$.ajax({
			url: 'php/pago_address.php',
			method: 'POST',
			success: function(response){
				var data = JSON.parse(response);
				for (var i = 0; i < data.length; i++){
					var nombre = data[i].name;
					var direccion = data[i].address;
					var ciudad = data[i].city;
					var cp = data[i].cp;
					var telf = data[i].telf;
					$('#nombre').val(nombre);
					$('#direccion').val(direccion);
					$('#ciudad').val(ciudad);
					$('#codigopostal').val(cp);
					$('#numero').val(telf);
					$("#address-modal").modal("show");
				}
			}
		});
	});

	//boton de aceptar del modal
	$('#btn-add-address').click(function(){
		//se recoge el valor de los inputs editados
		var data = $("#addressEditForm").serialize();
		$.ajax({
			url: 'php/pago_addressSave.php',
			method: 'POST',
			data: data,
			cache: "false",
			success: function(response){
				if (response=="actualizado"){
					$('#address-result').html("");
					Swal.fire({
						type: 'success',	
						title: ":)",
						text: "Dirección guardada correctamente.",
						icon: "success",
						button: "Aceptar",
					}).then(function(){
						$('#address-modal').modal('toggle');
						location.reload();
					});
				} else if (response=="error") {
					$('#address-result').html("<div class='alert alert-warning' role='alert'>Rellena todos los campos.</div>");
				} else if (response=="error cp") {
					$('#address-result').html("<div class='alert alert-warning' role='alert'><b>Codigo postal</b> inválido.</div>");
		  		} else {
					console.log(response);
		  		}		
			}
		});
	});

	$('.add-schedule').click(function () {
		alert("HOLA");
	});
});

function cartlist(){
	//LISTADO CARRITO
	$.ajax({
		url: 'php/shop_cartlist.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			if (data.Error) {
				console.log("No hay ningun producto");
			} else {
			//valor html para dropdown cart
			var html = "";

			for (var i = 0; i < data.length; i++){
				var id = data[i].id;
				var nombre = data[i].nombre;
				var precio = data[i].precio;
				var cantidad = data[i].cantidad;
				html += "<div class='col-6'>"+nombre+"</div>";
				html += "<div class='col-2'>"+precio/cantidad+" €</div>";
				html += "<div class='col-2'>"+cantidad+"</div>";
				html += "<div class='col-2'>"+precio+" € <i class='fas fa-times' id='"+id+"'></i></div>";
			}
				//se pone el resulado del documento con todos los datos
				$('.row-content').html(html);
			}

			//Eliminar producto
			$(".fa-times").click(function() {
				var id = this.id;
				$.ajax({
					url: 'php/shop_deleteProduct.php',
					type: 'POST',
					data: { id: id },
					success: function(response){
						if (response=="1"){
							location.reload();
						} else {
							console.log(response);
						}
					}
				});
			});

			//Contador productos que contiene el carrito
			$.ajax({	
				url: 'php/shop_cartCount.php',
				type: 'GET',
				success: function(response){
					var data = JSON.parse(response);
					//console.log(Object.values(data[0]));
					var num = Object.values(data[0]);
					if (data.Error) {
						console.log("No hay productos");
					} else {
						//Si no hay nada en el carrito vuelve a la tienda
						if (num == 0){
							$(location).attr('href', 'shop.php')
						}
						$('.badge').html(num);
					}

					//Suma del precio total de todos los productos del carrito
					$.ajax({	
						url: 'php/shop_cartSum.php',
						type: 'GET',
						success: function(response){
							var data = JSON.parse(response);
							var precioTotal = Object.values(data[0]);

							$('.cart-total').html("<b>Total: "+precioTotal +" €</b>");
							//Planchado opcional
							$('#add-planchado').click(function () {
								if ($('#add-planchado').is(":checked")){
									var plusPlanchado = parseInt(precioTotal) + (0.10*parseInt(precioTotal));
									$('.cart-total').html("<b>Total: "+plusPlanchado +" €</b>");
								} else {
									$('.cart-total').html("<b>Total: "+precioTotal +" €</b>");
								}
							});
						},
					});
				},
			});
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}

function drop(){
	$("#vaciarCarrito").click(function() {
		$.ajax({
			url: 'php/pago_vaciarCarrito.php',
			type: 'POST',
			success: function(response){
				if (response=="1"){
					console.log(response);
				} else {
					console.log(response);
				}
			}
		});
	});
}

function ValidarTJ(numero_tarjeta) {
	var cadena = numero_tarjeta.toString();
	var longitud = cadena.length;
	var cifra = null;
	var cifra_cad=null;
	var suma=0;
	for (var i=0; i < longitud; i+=2){
	   	cifra = parseInt(cadena.charAt(i))*2;
	   	if (cifra > 9){ 
	    	cifra_cad = cifra.toString();
	    	cifra = parseInt(cifra_cad.charAt(0)) + 
			parseInt(cifra_cad.charAt(1));
	   	}
	  	suma+=cifra;
	}
	for (var i=1; i < longitud; i+=2){
	  	suma += parseInt(cadena.charAt(i));
	}
	if ((suma % 10) == 0){ 
		return true; 
	} else {
	  	return false; 
	}
}