$(document).ready(function(){
	var $form = $("#register-form");
	//cuando se hace submit, mejor que click para que pase la validación html5 de required
	$form.on('submit', function(e){
		e.preventDefault();
		//se recoge el valor de los inputs introducidos
		var data = $("#register-form").serialize();
		//$.ajax(url, [ parámetros ]);
		$.ajax({
			url: 'php/register.php',
			method: 'POST',
			data: data,
			cache: "false",
			beforeSend: function(){
	  			$('#register-btn').val("Registrando...");
	  		},
			success: function(response){
				$('#register-btn').val("Enviar");
				//Si el servidor responde con un 1 es que todo ha ido bien
				if (response=="1"){
					$('#register-result').html("");
					Swal.fire({
						title: "¡Ya estas registrado!",
						text: "Puedes ingresar a tu cuenta en al página principal.",
						icon: "success",
						button: "Aceptar",
					}).then(function(){
						//Se redirige al usuario a la pagina home, donde podrá hacer login
						$(location).attr('href', 'index.php');
					});
				//Control de errores, usuario o email ya existe
				} else if (response=="Usuario existe"){
					$('#register-result').html("<div class='alert alert-warning' role='alert'>El <b>usuario</b> que has ingresado ya existe en nuestros servidores.</div>");
				} else if (response=="Email existe"){
					$('#register-result').html("<div class='alert alert-warning' role='alert'>El <b>email</b> que has ingresado ya existe en nuestros servidores.</div>");
				} else if (response=="Tipo null"){
					$('#register-result').html("<div class='alert alert-info' role='alert'>Elige el <b>tipo,</b> particular o empresa.</div>");
				//Control de errores, las contraseñas tienen que coincidir
		  		} else if (response=="Error password"){
					//console.log(response);
					$('#register-result').html("<div class='alert alert-danger' role='alert'><b>Error,</b> las contraseñas no coinciden.</div>");
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