$(document).ready(function(){
	var $form = $("#login-form");
	//cuando se hace submit, mejor que click para que pase la validación html5 de required
	$form.on('submit', function(e){
		e.preventDefault();
		//se recoge el valor de los inputs introducidos
		var data = $("#login-form").serialize();
		//$.ajax(url, [ parámetros ]);
		$.ajax({
			url: 'php/login.php',
			method: 'POST',
			data: data,
			cache: "false",
			beforeSend: function(){
	  			$('#login-btn').val("Conectando...");
	  		},
			success: function(response){
				$('#login-btn').val("Enviar");
				//Si el servidor responde con un 1 es que todo ha ido bien
				if (response=="1"){
					$('#login-result').html("");
					const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000
					});

					Toast.fire({
					  type: 'success',
					  title: 'Acceso correcto'
					})
					setTimeout(function(){
						location.href="index.php"
					}, 1000);   
				//usuario administrador
				} else if (response=="Ok admin"){
					$('#login-result').html("");
					const Toast = Swal.mixin({
					  toast: true,
					  position: 'top-end',
					  showConfirmButton: false,
					  timer: 3000
					});

					Toast.fire({
					  type: 'success',
					  title: 'Acceso correcto'
					})
					setTimeout(function(){
						location.href="admin.php"
					}, 1000); 
				} else if (response=="Error usuario"){
					//console.log(response);
					$('#login-result').html("<div class='alert alert-danger' role='alert'><b>Error,</b> usuario incorrecto.</div>");
				} else if (response=="Error pwd"){
					//console.log(response);
					$('#login-result').html("<div class='alert alert-danger' role='alert'><b>Error,</b> contraseña incorrecta.</div>");
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