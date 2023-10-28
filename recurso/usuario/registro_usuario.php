<?php
include "../../conexion.php";

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
    <?php include "../componentes/scripts.php" ?>
    <link rel="stylesheet" href="../css/style.css">
    <title>Registro Usuario</title>
</head>

<body>
    <?php include "../componentes/header.php" ?>

    <section id="container">
        <div class="form_register">
            <h1 class="form_register__title">Ingresar Usuario</h1>
            <form action="#" method="POST" class="form">
                <div class="alert">
                    <?php echo isset($alert) ? $alert : " " ?>
                </div>
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
                            <option value="<?php echo $rol['idrol']?>"><?php echo $rol['rol']?></option>
                    <?php
                        }
                    }
                    ?>

                </select>
                <input type="submit" value="Guardar" class="btn_save" style="text-align: right;">
            </form>
        </div>
    </section>

    <?php include "../componentes/footer.php" ?>
</body>

</html>