$(document).ready(function(){
	//Devuelve cont(*) de producto
    $.ajax({
		url: 'php/admin_chartProducto.php',
		type: 'GET',
		//que quiero que pase si todo va bien se ejecuta la funcion y saldra la respuesta del servidor
		success: function(response){
			var data = JSON.parse(response);
			//console.log(Object.values(data[0]));
			var num = Object.values(data[0]);
			if (data.Error) {
				console.log("No hay productos");
			} else {
				var productos = num;
				//Devuelve cont(*) de trabajador
				$.ajax({
					url: 'php/admin_chartTrabajador.php',
					type: 'GET',
					//que quiero que pase si todo va bien se ejecuta la funcion y saldra la respuesta del servidor
					success: function(response){
						var data = JSON.parse(response);
						//console.log(Object.values(data[0]));
						var num = Object.values(data[0]);
						if (data.Error) {
							console.log("No hay trabajadores");
						} else {
							var trabajadores = num;
							//Devuelve cont(*) de cliente
							$.ajax({
								url: 'php/admin_chartCliente.php',
								type: 'GET',
								//que quiero que pase si todo va bien se ejecuta la funcion y saldra la respuesta del servidor
								success: function(response){
									var data = JSON.parse(response);
									//console.log(Object.values(data[0]));
									var num = Object.values(data[0]);
									if (data.Error) {
										console.log("No hay trabajadores");
									} else {
										var clientes = num;
										//se actualizan los valores de las 3 peticiones de ajax al grafico char
										updateChar(productos, trabajadores, clientes);
										
									}
								},
							});
						}
					},
				});
			}
		},
	});

    //CHART
    let myChart = document.getElementById('myChart').getContext('2d');

    function updateChar(productos, trabajadores, clientes){
    	var nProductos = productos;
    	var nTrabajadores = trabajadores;
    	var nClientes = clientes;
    	//crear objeto
    	let barChart = new Chart(myChart, {
    		type: 'bar', //bar, horizontalBar, pie, line, doughnut, radar, polarArea
    		data: {
    			labels: ['Productos', 'Trabajadores', 'Clientes'],
    			datasets: [{
    				label: 'WashApp',
    				data: [
    					nProductos,
    					nTrabajadores,
    					nClientes
    				],
    				//backgroundColor: 'green'
    				backgroundColor: [
    					'#00CED1',
    					'#ADFF2F',
    					'#F08080'
    				],
    				borderWidth: 1,
    				borderColor: '#777',
    				hoverBorderWidth: 2,
    				hoverBorderColor: '#000'
    			}]
    		},
    		options: {
    			title: {
    				display: true,
    				text: 'Informe WashApp',
    				fontSize: 25,
                    fontColor: "#000"
    			},
    			legend: {
    				display: false, 
    				position: 'right',
    				labels: {
    					fontColor: '#000'
    				}
    			},
    			layout: {
    				padding: {
    					left: 50,
    					right: 0,
    					bottom: 0,
    					top: 0
    				}
    			}
    		}
    	});
    }
});