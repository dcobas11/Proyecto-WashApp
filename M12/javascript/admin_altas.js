$(document).ready(function(){
	var $form = $("#admin-form");
	//cuando se hace submit, mejor que click para que pase la validación html5 de required
	$form.on('submit', function(e){
		e.preventDefault();
		//se recoge el valor de los inputs introducidos
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
});