<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	<a class="navbar-brand" href="index.php">
		<img src="media/washing-machine2.png"  height="30" width="30" class="d-inline-block align-top logo" alt="logo_wash_app">
		WashApp
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
	<ul class="navbar-nav justify-content-center d-flex flex-fill">
	   	<li class="nav-item active">
     		<a class="nav-link nav-menu" href="admin.php">Home</a>
	   	</li>
	  	<li class="nav-item">
    		<a class="nav-link nav-menu" href="admin_altas.php">Altas</a>
	   	</li>
	   	<li class="nav-item">
     		<a class="nav-link nav-menu" href="admin_menu.php">Menú</a>
	   	</li>
 	</ul>
  	<ul class="nav navbar-nav flex-row justify-content-md-center justify-content-start flex-nowrap">
	    <li class="nav-item active">
	    	<a class="nav-link"><span class='fas fa-portrait'></span> <?php echo $_SESSION["admin"]; ?></a>
	    </li>
	    <li class="nav-item">
	    	<a class="nav-link" href="php/logout.php"><span class='fas fa-sign-out-alt'></span> Logout </a>
	    </li>
	</ul>
</div>
</nav>