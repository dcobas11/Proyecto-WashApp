<div class="collapse navbar-collapse" id="navbarNav">
	<ul class="navbar-nav justify-content-center d-flex flex-fill">
		<li class="nav-item active">
	     	<a class="nav-link nav-menu" href="trabajador_pendientes.php">Pendientes</a>
		</li>
		<li class="nav-item">
	     	<a class="nav-link nav-menu" href="trabajador_aceptadas.php">Aceptadas</a>
		</li>
	</ul>
	<ul class="nav navbar-nav flex-row justify-content-md-center justify-content-start flex-nowrap">
		<li class="nav-item active">
		    <a class="nav-link"><span class='fas fa-portrait'></span> <?php echo $_SESSION["employee"]; ?></a>
		</li>
		<li class="nav-item">
		    <a class="nav-link" href="php/logout.php"><span class='fas fa-sign-out-alt'></span> Logout </a>
		</li>
	</ul>
</div>
