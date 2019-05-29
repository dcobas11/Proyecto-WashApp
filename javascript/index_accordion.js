$(document).ready(function(){
	//Cambio el icono del acorden al hacer onClick
	$('#btn-plus').click(function(){
		//busca la <i> para cambiarle la clase
    	$(this).find('i').toggleClass('fa fa-plus-square').toggleClass('fa fa-minus-square');
	});
	//Cambio el icono del acorden al hacer onClick
	$('#btn-plus2').click(function(){
		//busca la <i> para cambiarle la clase
    	$(this).find('i').toggleClass('fa fa-plus-square').toggleClass('fa fa-minus-square');
	});

	productos();
});

function productos(){
	/*recoger productos*/ 
	$.ajax({
		url: 'php/index_accordion_productos.php',
		method: 'GET',
		success: function(productos){	
			var prod = JSON.parse(productos);
			/*recorremos todos los productos y creamos su respectivo "div" en el html referenciando por id*/
			prod.forEach(function(producto) {
			/*html Template*/ 
			if(producto.tipo==1){
				$('#collapseOneA').append(`
					<div class="card-price">
					${producto.nombre}
					<span class="float-right">${producto.precio} €</span>						 
					</div>`);
			}else if (producto.tipo==2){
				$('#collapseOneB').append(`
					<div class="card-price">
					${producto.nombre}
					<span class="float-right">${producto.precio} €</span>							 
					</div>`);	
			}else if (producto.tipo==3){
				$('#collapseOneC').append(`
					<div class="card-price">
					${producto.nombre}						 
					<span class="float-right">${producto.precio} €</span>							 
					</div>`);
			}else if (producto.tipo==4){
				$('#collapseOneD').append(`
					<div class="card-price">
					${producto.nombre}						 
					<span class="float-right">${producto.precio} €</span>							 
					</div>`);
			}
			else if(producto.tipo==5){
				$('#collapseTwo').append(`
					<div class="card-price">
					${producto.nombre}						 
					<span class="float-right">${producto.precio} €</span>							 
					</div>`);
			} 
			else {
		  		console.log(producto.id, producto.nombre);
		  	}
			})
		}
	});
}
