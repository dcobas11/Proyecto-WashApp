$(document).ready(function(){
	getOrderList();
});

function getOrderList(){
	$.ajax({
		url: 'php/cliente_getOrderList.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			if (data.Error) {
				console.log("No hay ningun producto");
			} else {
				var html = "";
				var estado;

				for (var i = 0; i < data.length; i++){
					var nPedido = data[i].id;
					var fecha = data[i].fecha;
					var planchado = data[i].planchado;
					//Variable donde se guardará el precio total de los productos
					var precioProductosTotal = 0; 
					//Enviar el id del pedido para recuperar productos, cantidad, precios, etc.
					$.ajax({	
						url: 'php/cliente_prodList.php',
						type: 'POST',
						data: { nPedido : nPedido },
						async: false,
						success: function(response){
							var data = JSON.parse(response);
							if (data.Error) {
								console.log("No hay ningun producto");
							} else {
								for (var i = 0; i < data.length; i++){
									var precio = data[i].precio;
									var cantidad = data[i].cantidad;
									//Precio multiplicado por la cantidad que se enviará al servidor php
									var precioSum = precio*cantidad
									//Planchado
									if(planchado == 1){
										precioProductosTotal += precioSum + (0.10*parseFloat(precioSum));
									} else if (planchado == 0){
										precioProductosTotal += precioSum;
									}
								}
							}
						},
					});
					if (data[i].status == 1){
						estado = "Pendiente"
						html += "<div id='"+nPedido+"' class='order-box shadow-sm p-3 mb-3 bg-white rounded klk'>";
							html += "<h6><b>Nº pedido:</b> "+nPedido+" <span class='estado'><button type='button' class='btn btn-warning btn-sm btn-estado'>"+estado+"</button></span></h6>";
							html += "<h6><b>Fecha:</b> "+fecha+"<b> Total: </b> <span class='total'> "+precioProductosTotal.toFixed(2)+" € </span></h6>";
						html += "</div>";
					}
					if (data[i].status == 2){
						estado = "Aceptado"
						html += "<div id='"+nPedido+"' class='order-box shadow-sm p-3 mb-3 bg-white rounded'>";
							html += "<h6><b>Nº pedido:</b> "+nPedido+" <span class='estado'><button type='button' class='btn btn-info btn-sm btn-estado'>"+estado+"</button></span></h6>";
							html += "<h6><b>Fecha:</b> "+fecha+"<b> Total: </b> <span class='total'> "+precioProductosTotal.toFixed(2)+" € </span></h6>";
						html += "</div>";
					}
					if (data[i].status == 3){
						estado = "En curso"
						html += "<div id='"+nPedido+"' class='order-box shadow-sm p-3 mb-3 bg-white rounded'>";
							html += "<h6><b>Nº pedido:</b> "+nPedido+" <span class='estado'><button type='button' class='btn btn-primary btn-sm btn-estado'>"+estado+"</button></span></h6>";
							html += "<h6><b>Fecha:</b> "+fecha+"<b> Total: </b> <span class='total'> "+precioProductosTotal.toFixed(2)+" € </span></h6>";
						html += "</div>";
					}
					if (data[i].status == 4){
						estado = "Entregado"
						html += "<div id='"+nPedido+"' class='order-box shadow-sm p-3 mb-3 bg-white rounded'>";
							html += "<h6><b>Nº pedido:</b> "+nPedido+" <span class='estado'><button type='button' class='btn btn-success btn-sm btn-estado'>"+estado+"</button></span></h6>";
							html += "<h6><b>Fecha:</b> "+fecha+"<b> Total: </b> <span class='total'> "+precioProductosTotal.toFixed(2)+" € </span></h6>";
						html += "</div>";
					}
				}
				//se pone el resulado del documento con todos los datos
				$('.info-order-box').html(html);
			}
			//Cuando se hace click en uno de los pedidos sale la infromación restante
			$('.order-box').click(function () {
				var id = this.id;
				$.ajax({	
					url: 'php/cliente_prodList.php',
					type: 'POST',
					data: { nPedido : id },
					success: function(response){
						var data = JSON.parse(response);
						if (data.Error) {
							console.log("No hay ningun producto");
						} else {
							var html = "";
							for (var i = 0; i < data.length; i++){
								var nombre = data[i].nombre;
								var precio = data[i].precio;
								var cantidad = data[i].cantidad;
								//Precio multiplicado por la cantidad que se enviará al servidor php
								var precioSum = precio*cantidad
								precioProductosTotal += precioSum;

								html += "<div class='row'>";
									html += "<div class='col-lg-4 col-md-12 col-sm-12'>"+nombre;
									html += "</div>";
									html += "<div class='col-lg-2 col-md-3 col-sm-3'><span class='badge badge-light badge-pill'>Ud: "+precio+" €</span>";
									html += "</div>";
									html += "<div class='col-lg-2 col-md-3 col-sm-3'><span class='badge badge-light badge-pill'>Cant: "+cantidad+"</span>";
									html += "</div>";
									html += "<div class='col-lg-3 col-md-6 col-sm-3'><span class='badge badge-secondary badge-pill'>Total: "+precioSum+" €</span>";
									html += "</div>";
								html += "</div>";
							}
							//alert(response);
							$('.products-box').html(html);
							//$('.pdf').html("<i id='print' class='fas fa-file-pdf'></i>");
						}
					},
				});
			});
		},
		error: function(){
			Swal.fire({
				type: 'error',
				title: 'Oops...',
			  	text: 'Se ha producido un error',
			})
		}
	});	
}