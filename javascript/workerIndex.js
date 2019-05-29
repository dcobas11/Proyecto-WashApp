$(document).ready(function(){
	comandasAceptadas();
	comandasPendientes();
	emailEmployee();
});

function comandasAceptadas(){
	$.ajax({
		url: 'php/worker_aceptados.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			console.log(data);
			
			for(var i=0;i<data.length;i++){
				var id = data[i].id;
				var nombre = data[i].name;
				var dia_recogida = data[i].dia_recogida;
				var franja = data[i].franja;
				var dia_entrega = data[i].dia_entrega;
				var franja2 = data[i].franja2;
				var address = data[i].address;
				var telf = data[i].telf;
				var status = data[i].status;
				/*alert(status + " " +id);*/
				$('#aceptado').append(`
					<tr class="fil" id='`+id+`'>
						<td>` + id + `</td>
						<td>` + nombre + `</td>
						<td>` + dia_recogida + `</td>
						<td>` + franja + `</td>
						<td>` + dia_entrega + `</td>
						<td>` + franja2 + `</td>
						<td>` + address + `</td>
						<td>` + telf + `</td>
						<td><input type="button" onclick="deCamino(this)" class="inEst" id="deCa-`+ id +`" value="EN RUTA"></td>
						<td><input type="button" onclick="comandasEntregadas(this)" class="inEst " id="entr-`+ id +`" value="ENTREGADO"></td>
					</tr>	
				`);
				if(status != 3){
					console.log(status);
				}else{
					/*var id = $(this).parent('td').parent('tr').*/
					//var id_td = $("#" + id).parent().parent().attr("id");
					/*$("#" +  id_td).addClass("bg-success");*/
					$("#" +  id).addClass("bg-success");
				}
			}
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}
function comandasPendientes(){
	$.ajax({
		url: 'php/worker_pendientes.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			console.log(data);

			for(var i=0;i<data.length;i++){
				var id = data[i].id;
				var nombre = data[i].name;
				var dia_recogida = data[i].dia_recogida;
				var franja = data[i].franja;
				var dia_entrega = data[i].dia_entrega;
				var franja2 = data[i].franja2;
				var address = data[i].address;
				var telf = data[i].telf;
				$('#pendiente').append(`
					<tr class="fil" id='`+id+`'>
						<td>` + id + `</td>
						<td>` + nombre + `</td>
						<td>` + dia_recogida + `</td>
						<td>` + franja + `</td>
						<td>` + dia_entrega + `</td>
						<td>` + franja2 + `</td>
						<td>` + address + `</td>
						<td>` + telf + `</td>
						<td><input type="button" onclick="aceptarComandas(this)" class="inEst" id="acept-`+ id +`" value="ACEPTAR"></td>
					</tr>
				`);
			}
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}

function aceptarComandas(boton){
	  	var id = boton.id.substr(6);
		//enviamos el id de la comanda que queremos aceptar
		$.ajax({
			url: 'php/update_com.php',
			type: 'POST',
			data: {acept_id:id},
			success: function(response){
				console.log(response);
			},
			error: function(){
				alert("Se ha producido un error");
			}
		});
		location.reload();
}

function deCamino(boton){	
	var idC = boton.id;
	var id_td = $("#" + idC).parent().parent().attr("id");
	$("#" +  id_td).addClass("bg-success");
	$("#" +  id_td).addClass("letra-info");
	var id = boton.id.substr(5);
  	
  	//enviamos el id de la comanda que queremos aceptar
	$.ajax({
		url: 'php/update_com.php',
		type: 'POST',
		data: {deCa_id:id},
		success: function(response){
			console.log(response);
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}

function comandasEntregadas(boton){
  	var id = boton.id.substr(5);
	$.ajax({
		url: 'php/update_com.php',
		type: 'POST',
		data: {entr_id:id},
		success: function(response){
			console.log(response);
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});	
	location.reload();
}

function emailEmployee(){
	$.ajax({
		url: 'php/email-worker.php',
		type: 'GET',
		success: function(response){
			var data = JSON.parse(response);
			var email = data;
			$('#email-icon1').append(`
				<div class=text-center">
					<p class="icon">` + email + `</p>
				</div>
			`);
		},
		error: function(){
			alert("Se ha producido un error");
		}
	});
}