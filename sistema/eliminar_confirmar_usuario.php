<?php
	include '../conexion.php';
	//POST
	if(!empty($_POST)){
		$idusuario = $_POST['idusuario'];

		//$query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");
		$query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario");

		if($query_delete){
			header('Location: lista_usuario.php');
		}
		else{
			echo "Oops... Ha ocurrido un error.";
		}

	}
	
	//Recuperación de los datos
    if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1){
        header('Location: lista_usuario.php');
    }
    else{
        $idusuario = $_REQUEST['id'];
		$query = mysqli_query($conection, "SELECT u.nombre, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE u.idusuario = $idusuario");
		$result = mysqli_num_rows($query);

		if($result > 0){
			while($data = mysqli_fetch_array($query)){
				$nombre = $data['nombre'];
				$usuario = $data['usuario'];
				$rol = $data['rol'];
			}
		}
		else{
			header('Location: lista_usuario.php');
		}

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "./components/scripts.php"?>
	<title>Eliminar usuario</title>
</head>
<body>
	<?php include "./components/header.php"?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Esta seguro de eliminar el registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Usuario: <span><?php echo $usuario; ?></span></p>
			<p>Tipo Usuario: <span><?php echo $rol; ?></span></p>

			<form method="POST" action="#">
				<input type="hidden" name="idusuario" value="<?php echo $idusuario;?>">
				<input type="submit" value="Aceptar" class="btn btn_ok">
				<a href="lista_usuario.php" class="btn btn_cancel">Cancelar</a>

			</form>
		</div>
	</section>
	<?php include "./components/footer.php"?>
</body>
</html>