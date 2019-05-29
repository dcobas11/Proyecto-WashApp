<?php
include("blocks/sessionToUserLogin.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php
	include("blocks/head.php");
	?>
	<title>WashApp - Orders</title>
	<script type="text/javascript" src="javascript/cliente.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
</head>
<body>
<!-- Header Navigation -->
<header>
    <nav class="navbar navbar-expand bg-light navbar-light fixed-top">
		<?php
		include("blocks/navbar-brand.php");
		?>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<?php
			  	include("blocks/navbar-clientInfo.php");
			  	?>
	    	</ul>
	    </div>
	</nav>
</header>
<!-- Container -->
<div class="container cont">
	<h3><i class="fas fa-archive"></i> Pedidos </h3>

	<div class="row">
		<div class="col-lg-4 col-md-6">
			<div class="info-order-box">

			</div>
		</div>
		<div class="col-lg-8 col-md-6">
			<div class="shadow-sm p-3 mb-3 bg-white rounded prod-box">
				<div id="print-div" class="products-box">
					<div class="alerta-click text-center">
						<h5>¡Haz click sobre un pedido para más información!</h5>
						<i class="far fa-smile"></i>
					</div>
				</div>
				<div class="pdf text-center">
					<i id='print' class='fas fa-file-pdf'></i>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
<script type="text/javascript">
	function genPDF(){
		html2canvas(document.getElementById('print-div'),{
			onrendered: function(canvas){
				var img = canvas.toDataURL("image/png");
				var doc = new jsPDF();
				doc.setFontType('bold')
				doc.text(20,20, "WashApp SL - Factura");
				doc.setFontType('normal')
				doc.setFontSize(10)
				doc.text(20,30, "Calle falsa 123");
				doc.text(20,35, "Barcelona, 08020");
				doc.text(20,40, "699 99 99 99");
				doc.addImage(img, 'JPEG', 20,50);
				doc.save('test.pdf');
			}
		});
	}

	$('#print').click(function () {
		genPDF();
	});
</script>
<style type="text/css">
	
	.order-box{
		cursor: pointer;
	}
	.alerta-click{
		color: #A9A9A9;
		padding-top: 30vh;
		height: 75vh;		
	}
	.fa-smile{
		font-size: 60px;
	}
	.badge-pill{
		width: 100%;
	}
	.fa-file-pdf{
		cursor: pointer;
		font-size: 18px;
		color: #cc0000;
	}
	.pdf{
		padding-top: 20px;
	}
</style>