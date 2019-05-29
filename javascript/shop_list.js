$(document).ready(function(){
	productos();
	cartlist();
});

function productos(){
	$.ajax({
		url: 'php/shop_list.php',
		type: 'GET',
		//que quiero que pase si todo va bien se ejecuta la funcion y saldra la respuesta del servidor
		success: function(response){
			var data = JSON.parse(response);
			if (data.Error) {
				console.log("No hay productos");
			} else {
				//valor html para la clase row porducts_list
				var html = "";
		
				for (var i = 0; i < data.length; i++){
					var nombre = data[i].nombre;
					var precio = data[i].precio;
					var id = data[i].id;
					//se pone el resulado del documento con todos los datos
					if (data[i].tipo == 1){
					html += '<div class="col-lg-4 col-md-6 col-sm-12 text-center item cat1">';
						html +=	'<div class="shadow-sm p-3 mb-5 bg-white rounded">';
							html += '<div class="div_image">';
								html +=	'<img src="media/'+id+'.jpg" class="img-fluid" alt="'+nombre+'"/>';
							html +=	'</div>';
							html +=	'<h3>'+nombre+'</h3>';
							html +=	'<p>'+precio+' €/u</p>';
							html += '<div class="quantity>';
								html += '<ul class="list-inline>';
									html += '<li class="list-inline-item">';
										html += '<i id="menos-'+id+'" class="fas fa-minus-square"></i>';
									html += '</li>';
									html += '<li class="list-inline-item">';
										html += '<div id="cant-'+id+'" style="font-size: 23px">1</div>'
									html += '</li>';
									html += '<li class="list-inline-item">'
										html += '<i id="plus-'+id+'" class="fas fa-plus-square"></i>';
									html += '</li>';
								html += '</ul>';
							html += '</div>';
							html += '<button type="button" id="add-'+id+'" data-nombre="'+nombre+'" data-precio="'+precio+'" class="btn btn-info btn-lg btn-block add-product">Añadir</button>'
						html +=	'</div>';
					html +=	'</div>';
					}
					if (data[i].tipo == 2){
					html += '<div class="col-lg-4 col-md-6 col-sm-12 text-center item cat2">';
						html +=	'<div class="shadow-sm p-3 mb-5 bg-white rounded">';
							html += '<div class="div_image">';
								html +=	'<img src="media/'+id+'.jpg" class="img-fluid" alt="'+nombre+'"/>';
							html +=	'</div>';
							html +=	'<h3>'+nombre+'</h3>';
							html +=	'<p>'+precio+' €/u</p>';
							html += '<div class="quantity>';
								html += '<ul class="list-inline>';
									html += '<li class="list-inline-item">';
										html += '<i id="menos-'+id+'" class="fas fa-minus-square"></i>';
									html += '</li>';
									html += '<li class="list-inline-item">';
										html += '<div id="cant-'+id+'" style="font-size: 23px">1</div>'
									html += '</li>';
									html += '<li class="list-inline-item">'
										html += '<i id="plus-'+id+'" class="fas fa-plus-square"></i>';
									html += '</li>';
								html += '</ul>';
							html += '</div>';
							html += '<button type="button" id="add-'+id+'" data-nombre="'+nombre+'" data-precio="'+precio+'" class="btn btn-info btn-lg btn-block add-product">Añadir</button>'
						html +=	'</div>';
					html +=	'</div>';
					}
					if (data[i].tipo == 3){
					html += '<div class="col-lg-4 col-md-6 col-sm-12 text-center item cat3">';
						html +=	'<div class="shadow-sm p-3 mb-5 bg-white rounded">';
							html += '<div class="div_image">';
								html +=	'<img src="media/'+id+'.jpg" class="img-fluid" alt="'+nombre+'"/>';
							html +=	'</div>';
							html +=	'<h3>'+nombre+'</h3>';
							html +=	'<p>'+precio+' €/u</p>';
							html += '<div class="quantity>';
								html += '<ul class="list-inline>';
									html += '<li class="list-inline-item">';
										html += '<i id="menos-'+id+'" class="fas fa-minus-square"></i>';
									html += '</li>';
									html += '<li class="list-inline-item">';
										html += '<div id="cant-'+id+'" style="font-size: 23px">1</div>'
									html += '</li>';
									html += '<li class="list-inline-item">'
										html += '<i id="plus-'+id+'" class="fas fa-plus-square"></i>';
									html += '</li>';
								html += '</ul>';
							html += '</div>';
							html += '<button type="button" id="add-'+id+'" data-nombre="'+nombre+'" data-precio="'+precio+'" class="btn btn-info btn-lg btn-block add-product">Añadir</button>'
						html +=	'</div>';
					html +=	'</div>';
					}
					if (data[i].tipo == 4){
					html += '<div class="col-lg-4 col-md-6 col-sm-12 text-center item cat4">';
						html +=	'<div class="shadow-sm p-3 mb-5 bg-white rounded">';
							html += '<div class="div_image">';
								html +=	'<img src="media/'+id+'.jpg" class="img-fluid" alt="'+nombre+'"/>';
							html +=	'</div>';
							html +=	'<h3>'+nombre+'</h3>';
							html +=	'<p>'+precio+' €/u</p>';
							html += '<div class="quantity>';
								html += '<ul class="list-inline>';
									html += '<li class="list-inline-item">';
										html += '<i id="menos-'+id+'" class="fas fa-minus-square"></i>';
									html += '</li>';
									html += '<li class="list-inline-item">';
										html += '<div id="cant-'+id+'" style="font-size: 23px">1</div>'
									html += '</li>';
									html += '<li class="list-inline-item">'
										html += '<i id="plus-'+id+'" class="fas fa-plus-square"></i>';
									html += '</li>';
								html += '</ul>';
							html += '</div>';
							html += '<button type="button" id="add-'+id+'" data-nombre="'+nombre+'" data-precio="'+precio+'" class="btn btn-info btn-lg btn-block add-product">Añadir</button>'
						html +=	'</div>';
					html +=	'</div>';
					}
					if (data[i].tipo == 5){
					html += '<div class="col-lg-6 col-md-6 col-sm-12 text-center item cat5">';
						html +=	'<div class="shadow-sm p-3 mb-5 bg-white rounded">';
							html += '<div class="div_image">';
								html +=	'<img src="media/'+id+'.jpg" class="img-fluid" alt="'+nombre+'"/>';
							html +=	'</div>';
							html +=	'<h3>'+nombre+'</h3>';
							html +=	'<p>'+precio+' €/u</p>';
							html += '<div class="quantity>';
								html += '<ul class="list-inline>';
									html += '<li class="list-inline-item">';
										html += '<i id="menos-'+id+'" class="fas fa-minus-square"></i>';
									html += '</li>';
									html += '<li class="list-inline-item">';
										html += '<div id="cant-'+id+'" style="font-size: 23px">1</div>'
									html += '</li>';
									html += '<li class="list-inline-item">'
										html += '<i id="plus-'+id+'" class="fas fa-plus-square"></i>';
									html += '</li>';
								html += '</ul>';
							html += '</div>';
							html += '<button type="button" id="add-'+id+'" data-nombre="'+nombre+'" data-precio="'+precio+'" class="btn btn-info btn-lg btn-block add-product">Añadir</button>'
						html +=	'</div>';
					html +=	'</div>';
					}
				}
				$('.products_list').html(html);

				//CAMBIO DE PRODUCTOS POR TIPO
				(function(){
				    'use strict';
				    var $products = $('.products');
				    $products.isotope({
				        itemSelector: '.item',
				        layoutMode: 'fitRows'
				    });
				    $('ul.filters > li').on('click', function(e){
				        e.preventDefault();
				        var filter = $(this).attr('data-filter');
				        $('ul.filters > li').removeClass('active');
				        $(this).addClass('active');
				        $products.isotope({filter: filter});
				    });
				})(jQuery);

				$(".fa-plus-square").click(function() {
					var cantidad;
					//recoge el id, solo el numero, del producto a partir de " - "
					var cod = this.id.substring(5,);
					//guardo en una variable auxiliar, concatenada la parte comun del id con el numero que es diferente para cada producto
					var auxCantidad = "#cant-" + cod;
					//guardo en la variable cantidad el numero que habrá en pantalla y se ira actualizando cuando se le de al " + "
					cantidad = $(auxCantidad).html();
					//se actualiza la información pasandolo a parseInt y sumandole 1 por cada click
					$(auxCantidad).html(parseInt(cantidad) + 1);
				});

				$(".fa-minus-square").click(function() {
					var cantidad;
					//recoge el id, solo el numero, del producto a partir de " - "
					var cod = this.id.substring(6,);
					//guardo en una variable auxiliar, concatenada la parte comun del id con el numero que es diferente para cada producto
					var auxCantidad = "#cant-" + cod;
					cantidad = $(auxCantidad).html();
					//si la cantidad en pantalla es mayor que 1 se podrá restar
					if (cantidad > 1){
						$(auxCantidad).html(parseInt(cantidad) - 1);
					}
				});

				$('.add-product').click(function () {
					var nombre = $(this).data('nombre');
					var precio = $(this).data('precio');
					var cod = this.id.substring(4,);
					var auxCantidad = "#cant-" + cod;
					var cantidad = $(auxCantidad).html();
					//Precio multiplicado por la cantidad que se enviará al servidor php
					var precioSum = precio*cantidad
					//CARRITO
					$.ajax({
						url: 'php/shop_cart.php',
						method: 'POST',
						data: { id: cod, nombre: nombre, precio: precioSum, cantidad: cantidad },
						success: function(response){
							if (response=="1" || response =="2"){
								cartlist();
					  		} else {
					  			console.log(response);
					  		}
						},
					});
					$(auxCantidad).html("1");
				});
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
}

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

				html += "<li class='clearfix'>";
					html += "<span class='item-name'>"+nombre+" <i class='fas fa-times' id='"+id+"'></i></span>";
					html += "<span class='item-price'>"+precioSum.toFixed(2)+" €</span>";
					html += "<span class='item-quantity'>Cantidad: "+cantidad+"</span>";
				html += "</li>";
			}
				//se pone el resulado del documento con todos los datos
				$('.shopping-cart-items').html(html);

				$('.total-price').html(precioProductosTotal +" €");
			}

			//Eliminar producto del dropdown de carrito
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
						//Solo se mostrará el botón de realizar pedido si hay algun producto en el carrito
						if (num == 0 ){
							$(".btn-payment").hide();
							$(".sad-cart").show();
						}
						if (num >= 1){
							$(".sad-cart").hide();
							$(".btn-payment").show();
						}
						$('.bdge').html(num);
					}
				},
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