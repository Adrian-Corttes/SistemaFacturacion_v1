<?php
include "../conexion.php";
//Validación del formulario
if (!empty($_POST)) {
	$alert = "";

	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['user']) || empty($_POST['password']) || empty($_POST['rol'])) {
		$alert = '<p class="msg_error">Oupss!... Todos los campos son obligatorios.</p>';
	} else {

		$nombre = $_POST['name'];
		$email = $_POST['email'];
		$user = $_POST['user'];
		$clave = md5($_POST['password']);
		$rol = $_POST['rol'];

		$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email'");
		$result = mysqli_fetch_array($query);

		if ($result > 0) {
			$alert = '<p class="msg_error">Oupss!... El correo o el usuario ya existen.</p>';
		} else {
			$query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol) 
                VALUES ('$nombre','$email','$user','$clave','$rol')");

			if ($query_insert) {
				$alert = '<p class="msg_save">Usuario registrado con exito.</p>';
			} else {
				$alert = '<p class="msg_error">Oupss!... Error al crear el usuario.</p>';
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "./components/scripts.php" ?>
	<title>Registro Usuario</title>

</head>

<body>
	<?php include "./components/header.php" ?>
	<section class="container">
		<div class="form_register">

			<div class="container_title">
				<h1 class="form_register__title">Registro usuarios</h1>
				<a href="./index.php" class="btn_close" title="Cerrar"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
						<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
					</svg></a>

			</div>

			<div class="alert"><?php echo isset($alert) ? $alert : " " ?></div>

			<form action="#" method="POST" class="form">
				<label for="name" class="form__label">Nombre <span class="text-danger">*</span></label>
				<input type="text" name="name" id="name" class="form__input" placeholder="Nombre Completo" required>

				<label for="email" class="form__label">Email <span class="text-danger">*</span></label>
				<input type="email" name="email" id="email" class="form__input" placeholder="Correo Electronico" required>

				<label for="user" class="form__label">Usuario <span class="text-danger">*</span></label>
				<input type="text" name="user" id="user" class="form__input" placeholder="Usuario" required>

				<label for="password" class="form__label">Contraseña <span class="text-danger">*</span></label>
				<input type="password" name="password" class="form__input" id="password" placeholder="Contraseña" required>

				<label for="rol" class="form__label">Tipo Usuario <span class="text-danger">*</span></label>

				<?php
				$query_rol = mysqli_query($conection, "SELECT * FROM rol");
				$result_rol = mysqli_num_rows($query_rol);
				?>

				<select name="rol" id="rol" class="form__input" require>
					<?php
					if ($result_rol > 0) {

						while ($rol = mysqli_fetch_array($query_rol)) {

					?>
							<option value="<?php echo $rol['idrol'] ?>"><?php echo $rol['rol'] ?></option>
					<?php
						}
					}
					?>

				</select>
					<input type="submit" value="Guardar" class="btn_save">
			</form>
			</form>
		</div>
	</section>
	<?php include "./components/footer.php" ?>
</body>

</html>