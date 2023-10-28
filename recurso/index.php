<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "./componentes/scripts.php" ?>
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
			<h1 class="header__title">Sistema Facturación V1.0</h1>
			<div class="optionsBar">
				<p> Colombia, <?php echo fechaC(); ?> </p>
				<span>|</span>
				<span class="user"><?php echo  $_SESSION['user'] ?></span>
				<img class="photouser" src="./img/user.png" alt="Usuario">
				<a href="./salir.php"><img class="close" src="./img/salir.png" alt="Salir del sistema" title="Salir"></a>
			</div>
		</div>

		<nav>
    <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li class="principal">
            <a href="#">Usuarios</a>
            <ul>
                <li><a href="./usuario/registro_usuario.php">Nuevo Usuario</a></li>
                <li><a href="./usuario/lista_usuario.php">Lista de Usuarios</a></li>
            </ul>
        </li>
        <li class="principal">
            <a href="#">Clientes</a>
            <ul>
                <li><a href="#">Nuevo Cliente</a></li>
                <li><a href="#">Lista de Clientes</a></li>
            </ul>
        </li>
        <li class="principal">
            <a href="#">Proveedores</a>
            <ul>
                <li><a href="#">Nuevo Proveedor</a></li>
                <li><a href="#">Lista de Proveedores</a></li>
            </ul>
        </li>
        <li class="principal">
            <a href="#">Productos</a>
            <ul>
                <li><a href="#">Nuevo Producto</a></li>
                <li><a href="#">Lista de Productos</a></li>
            </ul>
        </li>
        <li class="principal">
            <a href="#">Facturas</a>
            <ul>
                <li><a href="#">Nuevo Factura</a></li>
                <li><a href="#">Facturas</a></li>
            </ul>
        </li>
    </ul>
</nav>
	</header>

	<section id="container">
		<h1>Bienvenido al sistema</h1>
	</section>

	<?php include "./componentes/footer.php" ?>
</body>

</html>