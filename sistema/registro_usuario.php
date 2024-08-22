<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<?php include "./components/scripts.php" ?>
	<title>Registro Usuario</title>
</head>

<body>
	<?php include "./components/header.php" ?>
	<section id="container">
		<div class="form_register">
			<h1 class="form_register__title">Registro usuarios</h1>
			<br>
			<div class="aler"></div>
			<form action="#" class="form">
				<label for="name" class="form__label">Nombre <span class="text-danger">*</span></label>
				<input type="text" name="name" id="name" class="form__input" placeholder="Nombre Completo" required>

				<label for="email" class="form__label">Email <span class="text-danger">*</span></label>
				<input type="email" name="email" id="email" class="form__input" placeholder="Correo Electronico" required>

				<label for="user" class="form__label">Usuario <span class="text-danger">*</span></label>
				<input type="text" name="user" id="user" class="form__input" placeholder="Usuario" required>

				<label for="password" class="form__label">Contraseña <span class="text-danger">*</span></label>
				<input type="password" name="password" class="form__input" id="password" placeholder="Contraseña" required>

				<label for="rol" class="form__label">Tipo Usuario <span class="text-danger">*</span></label>
				<select name="rol" id="rol" class="form__input">
					<option value="1">Administrador</option>
					<option value="2">Supervisor</option>
					<option value="3">Vendedor</option>
				</select>

				<input type="submit" value="Guardar" class="btn_save" style="text-align: right;">
			</form>
		</div>
	</section>
	<?php include "./components/footer.php" ?>
</body>

</html>