$(document).ready(function(){
	cartlist();
	dropCart();
	printDiasDentroDelModal()
	setHorario()
	setDireccion();
	getDireccion();
	getHorario();
	realizarPago();
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
			//Variable donde se guardará el precio total de los productos
			var precioProductosTotal = 0; 
			//valor html para dropdown cart
			var html = "";

			for (var i = 0; i < data.length; i++){
				var id = data[i].prod_id;
				var nombre = data[i].nombre;
				var precio = data[i].precio;
				var cantidad = data[i].cantidad;
				//Precio multiplicado por la cantidad que se enviará al servidor php
				var precioSum = precio*cantidad
				precioProductosTotal += precioSum;

				html += "<div class='col-6'>"+nombre+"</div>";
				html += "<div class='col-2'>"+precio+" €</div>";
				html += "<div class='col-2'>"+cantidad+"</div>";
				html += "<div class='col-2'>"+precioSum+" € <i class='fas fa-times' id='"+id+"'></i></div>";
			}
				//se pone el resulado del documento con todos los datos
				$('.row-content').html(html);
				$('.cart-total').html("<b>Total: "+precioProductosTotal.toFixed(2) +" €</b>");

				//Planchado opcional
				$('#add-planchado').click(function () {
					if ($('#add-planchado').is(":checked")){
						var data = "1";
						$.ajax({
							url: 'php/pago_planchado.php',
							method: 'POST',
							data: { data : data },
						});
						var plusPlanchado = parseFloat(precioProductosTotal) + (0.10*parseFloat(precioProductosTotal));
						$('.cart-total').html("<b>Total: "+plusPlanchado.toFixed(2) +" €</b>");
					} else {
						var data = "0";
						$.ajax({
							url: 'php/pago_planchado.php',
							method: 'POST',
							data: { data : data },
						});
						$('.cart-total').html("<b>Total: "+precioProductosTotal.toFixed(2) +" €</b>");
					}
				});
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
						$('.bdge').html(num);
					}
				},
			});
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}

function dropCart(){
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

function setDireccion(){
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
					const Toast = Swal.mixin({
					  	toast: true,
					  	position: 'top-end',
					  	showConfirmButton: false,
					  	timer: 3000
					});
					Toast.fire({
					  	type: 'success',
					  	title: 'Dirección guardada'
					})
					setTimeout(function(){
						$('#address-modal').modal('toggle');
						location.reload();
					}, 1000);
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
}

function getDireccion(){
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
				} else if ($('.schedule-box').html().length === 171 ) {
					Swal.fire({
						type: 'warning',	
						title: "¡Atención!",
						text: "Escoge un horario de recogida.",
						icon: "success",
						button: "Aceptar",
					});
				} else {
					$("#payModal").modal("show");
				}
			});
		}
	});
}

function printDiasDentroDelModal(){
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
	  
	 	printRecogida();
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
	  
	 	printRecogida();
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
	  
		printRecogida();
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
	  
		printRecogida();
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
	  
		printRecogida();
	}
	
	//TABLA
	function printRecogida(){
		var html = "";
		var input = "";
		html += "<tr class='table-info'>";
	 		html += "<th>"+diaHoy+" "+diaN+"</th>";
	  		html += "<th>"+dia2+" "+diaN2+"</th>";
	  		html += "<th>"+dia3+" "+diaN3+"</th>";
	 	html += "</tr>";
	 	html += "<tr>";
	 		html += "<td id='D1F1' class='free' data-franja='1' data-dia='"+diaN+"'>8:00 - 12:00</td>";
	 		html += "<td id='D2F1' class='free' data-franja='1' data-dia='"+diaN2+"'>8:00 - 12:00</td>";
	 		html += "<td id='D3F1' class='free' data-franja='1' data-dia='"+diaN3+"'>8:00 - 12:00</td>";
	 	html += "</tr>" ;
	 	html += "<tr>";
	 		html += "<td id='D1F2' class='free' data-franja='2' data-dia='"+diaN+"'>12:00 - 16:00</td>";
	 		html += "<td id='D2F2' class='free' data-franja='2' data-dia='"+diaN2+"'>12:00 - 16:00</td>";
	 		html += "<td id='D3F2' class='free' data-franja='2' data-dia='"+diaN3+"'>12:00 - 16:00</td>";
	 	html += "</tr>" ;
	 	html += "<tr>";
	 		html += "<td id='D1F3' class='free' data-franja='3' data-dia='"+diaN+"'>16:00 - 20:00</td>";
	 		html += "<td id='D2F3' class='free' data-franja='3' data-dia='"+diaN2+"'>16:00 - 20:00</td>";
	 		html += "<td id='D3F3' class='free' data-franja='3' data-dia='"+diaN3+"'>16:00 - 20:00</td>";
	 	html += "</tr>" ;

	 	input += "<div class='row'>";
		 	input += "<div class='col-6'>";
		 		input += "<input class='form-control' id='dia' name='dia' value='fecha' type='text' readonly required>";
		 	input += "</div>";
		 	input += "<div class='col-6'>";
		 		input += "<input class='form-control' id='franja' name='franja' value='franja' type='text' readonly required>";
			input += "</div>";
		input += "</div>";
		input += "<br><span id='recogida-result'></span>"
		
		$('#tableDays').html(html);
		$('#formRecogida').html(input);
	}

	//FRANJAS DISPONIBLES POR DIAS
	$.ajax({
		url: 'php/pago_diaCount.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			console.log(response);

			for (var i = 0; i < data.length; i++){
				var dia = data[i].dia_recogida;
				var franja = data[i].franja;
				var contFranja = data[i].contFranja;

				/*************************************************/
				/******************PRIMER DIA*********************/
				/*************************************************/
				if (dia == diaN && franja == 1 && contFranja >= 2){
					$("#D1F1").css('background-color', 'pink');
					$('#D1F1').removeClass('free');
    				$('#D1F1').addClass('taken');
				}
				if (dia == diaN && franja == 2 && contFranja >= 2){
					$("#D1F2").css('background-color', 'pink');
					$('#D1F2').removeClass('free');
    				$('#D1F2').addClass('taken');
				}
				if (dia == diaN && franja == 3 && contFranja >= 2){
					$("#D1F3").css('background-color', 'pink');
					$('#D1F3').removeClass('free');
    				$('#D1F3').addClass('taken');
				}
				/*************************************************/
				/******************SEGUNDO DIA********************/
				/*************************************************/
				if (dia == diaN2 && franja == 1 && contFranja >= 2){
					$("#D2F1").css('background-color', 'pink');
					$('#D2F1').removeClass('free');
    				$('#D2F1').addClass('taken');
				}
				if (dia == diaN2 && franja == 2 && contFranja >= 2){
					$("#D2F2").css('background-color', 'pink');
					$('#D2F2').removeClass('free');
    				$('#D2F2').addClass('taken');
				}
				if (dia == diaN2 && franja == 3 && contFranja >= 2){
					$("#D2F3").css('background-color', 'pink');
					$('#D2F3').removeClass('free');
    				$('#D2F3').addClass('taken');
				} 	
				/*************************************************/
				/*******************TERCER DIA********************/
				/*************************************************/
				if (dia == diaN3 && franja == 1 && contFranja >= 2){
					$("#D3F1").css('background-color', 'pink');
					$('#D3F1').removeClass('free');
    				$('#D3F1').addClass('taken');
				}
				if (dia == diaN3 && franja == 2 && contFranja >= 2){
					$("#D3F2").css('background-color', 'pink');
					$('#D3F2').removeClass('free');
    				$('#D3F2').addClass('taken');
				}
				if (dia == diaN3 && franja == 3 && contFranja >= 2){
					$("#D3F3").css('background-color', 'pink');
					$('#D3F3').removeClass('free');
    				$('#D3F3').addClass('taken');
				}
			}
		}
	});
}
function setHorario(){
	$('.add-schedule').click(function () {
		$("#horario-modal").modal("show");
	});

	///////////////////////////////////////////////
	$("#tableDays").on("click", "td", function() {
  		var dia = $(this).data("dia");
     	var franja = $(this).data("franja");
     	var hora = $(this).text();
     	var clase = $(this).attr('class');

     	if (clase == "free"){
     		$('#dia').val(dia);
      		$('#franja').val(hora);	
     	} else if (clase == "taken") {
     		$('#dia').val("fecha");
      		$('#franja').val("franja");	
     	}
  	});

  	//boton de aceptar del modal
	$('#btn-add-schedule').click(function(){
		//se recoge el valor de los inputs editados
		var data = $("#formRecogida").serialize();
		$.ajax({
			url: 'php/pago_addRecogida.php',
			method: 'POST',
			data: data,
			cache: "false",
			success: function(response){
				if (response=="1" || response=="2"){
					$('#recogida-result').html("");
					const Toast = Swal.mixin({
					  	toast: true,
					  	position: 'top-end',
					  	showConfirmButton: false,
					  	timer: 3000
					});
					Toast.fire({
					  	type: 'success',
					  	title: 'Horario reservado'
					})
					setTimeout(function(){
						$('#horario-modal').modal('toggle');
						location.reload();
					}, 1000);
				} else if (response=="error dia null") {
					$('#recogida-result').html("<div class='alert alert-warning' role='alert'>Franja no disponible.</div>");
		  		} else {
					console.log(response);
		  		}	
			}
		});
	});
}
function getHorario(){
	//Horario del usuario
	$.ajax({
		url: 'php/pago_getRecogida.php',
		method: 'POST',
		success: function(response){
			var html = "";
			var dia;
			var franja;
			var hora;
			var data = JSON.parse(response);
			for (var i = 0; i < data.length; i++){
				dia = data[i].dia_recogida;
				franja = data[i].franja;

				if (franja == 1){
					hora = "8:00 - 12:00";
				} else if (franja == 2) {
					hora = "12:00 - 16:00";
				} else if (franja == 3) {
					hora = "16:00 - 20:00";
				}
				html += "<p><i class='fas fa-thumbs-up fs'></i><b>Horario pactado</b></p>";
				html += "<p><i class='fas fa-calendar-check fs'></i>Fecha: "+dia+"</p>";
				html += "<p><i class='fas fa-clock'></i> Hora: "+hora+"</p>";
			}
			$('.schedule-box').html(html);
		}
	});
}
function realizarPago(){
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
						alert("FIN");
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