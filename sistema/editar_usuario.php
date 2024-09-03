<?php
include "../conexion.php";
//Validaciones del formulario
if (!empty($_POST)) {
	$alert = "";

	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['user']) || empty($_POST['rol'])) {
		$alert = '<p class="msg_error">Oupss!... Todos los campos son obligatorios.</p>';
	} else {

		$idUsuario = $_POST['idUsuario'];
		$nombre = $_POST['name'];
		$email = $_POST['email'];
		$user = $_POST['user'];
		$clave = md5($_POST['clave']);
		$rol = $_POST['rol'];

		$query = mysqli_query($conection, "SELECT * FROM usuario WHERE (usuario = '$user' AND idusuario != $idUsuario) OR (correo = '$email' AND idusuario != $idUsuario)");
		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<p class="msg_error">Oupss!... El correo o el usuario ya existen.</p>';

		} else {
			if(empty($_POST['clave'])){
				$sql_update = mysqli_query($conection, " UPDATE usuario SET nombre = '$nombre', correo = '$email', usuario = '$user', rol = '$rol' WHERE idusuario = $idUsuario");
			}
			else{
				$sql_update = mysqli_query($conection, "UPDATE usuario SET nombre = '$nombre', correo = '$email', usuario = '$user, clave = '$clave', rol = '$rol' WHERE idusuario = $idUsuario");
			}


			if ($sql_update) {
				$alert = '<p class="msg_save">Usuario actualizado con exito.</p>';
			} else {
				$alert = '<p class="msg_error">Oupss!... Error al actualizar el usuario.</p>';
			}
		}
	}
}


//Mostrar datos. Logica del formulario
if (empty($_GET['id'])) {
	header('Location: lista_usuario.php');
}

$idUser = $_GET['id'];
$sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, (u.rol) AS idrol, (r.rol) AS rol FROM usuario u INNER JOIN rol r ON u.rol = idrol WHERE idusuario = $idUser");
$result_sql = mysqli_num_rows($sql);

if ($result_sql == 0) {
	header('Location: lista_usuario.php');
} else {
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		$idUser = $data['idusuario'];
		$nombre = $data['nombre'];
		$correo = $data['correo'];
		$usuario = $data['usuario'];
		$idrol = $data['idrol'];
		$rol = $data['rol'];

		if ($idrol == 1) {
			$option = '<option value="' . $idrol . '"select >' . $rol . '</option>';
		} else if ($idrol == 2) {
			$option = '<option value="' . $idrol . '"select >' . $rol . '</option>';
		} else if ($idrol == 3) {
			$option = '<option value="' . $idrol . '"select >' . $rol . '</option>';
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "./components/scripts.php" ?>
	<title>Actualizar Usuario</title>

</head>

<body>
	<?php include "./components/header.php" ?>
	<section class="container">
		<div class="form_register">

			<div class="container_title">
				<h1 class="form_register__title">Actualizar Usuario</h1>
				<a href="./lista_usuario.php" class="btn_close" title="Cerrar">
					<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
						<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
					</svg>
				</a>
			</div>

			<div class="alert"><?php echo isset($alert) ? $alert : " " ?></div>

			<form action="#" method="POST" class="form">
				<input type="hidden" name="idUsuario" value="<?php echo $idUser; ?>">

				<label for="name" class="form__label">Nombre</label>
				<input type="text" name="name" id="name" class="form__input" value="<?php echo $nombre ?>">

				<label for="email" class="form__label">Email</label>
				<input type="email" name="email" id="email" class="form__input" value="<?php echo $correo ?>">

				<label for="user" class="form__label">Usuario</label>
				<input type="text" name="user" id="user" class="form__input" value="<?php echo $usuario ?>">

				<label for="clave" class="form__label">Contraseña</label>
				<input type="password" name="clave" class="form__input" id="clave" placeholder="****************">


				<label for="rol" class="form__label">Tipo Usuario</label>

				<?php
				$query_rol = mysqli_query($conection, "SELECT * FROM rol");
				$result_rol = mysqli_num_rows($query_rol);
				?>

				<select name="rol" id="rol" class="form__input notItem" require>
					<?php
					echo $option;
					if ($result_rol > 0) {

						while ($rol = mysqli_fetch_array($query_rol)) {

					?>
							<option value="<?php echo $rol['idrol'] ?>"><?php echo $rol['rol'] ?></option>
					<?php
						}
					}
					?>

				</select>
				<input type="submit" value="Actualizar" class="btn_save">

			</form>
			</form>
		</div>
	</section>
	<?php include "./components/footer.php" ?>
</body>

</html>