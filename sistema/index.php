<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "./componentes/functions.php" ?>
	<link rel="stylesheet" href="../sistema/css/style.css">
	<title>Sisteme Ventas</title>
</head>

<body>
	<?php
	session_start();
	if (empty($_SESSION['active'])) {
		header('location: ../');
	}
	?>
	<header>
		<div class="header">

			<h1>Sistema Facturación V1.0</h1>
			<div class="optionsBar">
				<p> Colombia, <?php echo fechaC(); ?> </p>
				<span>|</span>
				<span class="user"><?php echo  $_SESSION['user'] ?></span>
				<img class="photouser" src="./img/user.png" alt="Usuario">
				<a href="./salir.php"><img class="close" src="./img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>

		<?php include "./componentes/nav.php" ?>
	</header>

	<section id="container">
		<h1>Bienvenido al sistema</h1>
	</section>

	<?php include "./componentes/footer.php" ?>
</body>

</html>