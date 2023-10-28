<?php
    include "../../conexion.php";
    //Validamos que si se este enviando información via POST
    if (!empty($_POST)) {
        $alert = "";

        //validamos que los campos del formulario no vayan vacios
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['user'])|| empty($_POST['rol'])) {
            $alert = '<p class="msg_error">Oupss!... Todos los campos son obligatorios.</p>';

        } else {
            $idUsuario = $_POST('idusuario');
            $nombre = $_POST['name'];
            $email = $_POST['email'];
            $user = $_POST['user'];
            $clave = md5($_POST['password']);
            $rol = $_POST['rol'];
           
            echo "SELECT * FROM usuario WHERE (usuario = $user AND idusuario = $idUsuario) OR (correo = $email AND idusuario = $idUsuario "; exit;

            $query = mysqli_query($conection, "SELECT * FROM usuario WHERE (usuario = $user AND idusuario = $idUsuario) OR (correo = $email AND idusuario = $idUsuario ");
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

    //Validamos que el id no vaya vacio
    if (empty($_GET['id'])) {
        header('Location: ./lista_usuario.php');
    }
    $iduser = $_GET['id'];
    $query2 = mysqli_query($conection, "SELECT u.idusuario,u.nombre,u.correo,u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE idusuario = $iduser");
    $query_result = mysqli_num_rows($query2);

    if($query_result == 0){
        header('Location: ./lista_usuario.php');
    }
    else{
        $option = '';
        while($data = mysqli_fetch_array($query2)){
            $iduser = $data['idusuario'];
            $nombre = $data['nombre'];
            $correo = $data['correo'];
            $usuario = $data['usuario'];
            $idrol = $data['idrol'];
            $rol = $data['rol'];

            if($idrol == 1){
                $option = '<option value="'.$idrol.'" select >'.$rol.'</option>';
            }
            else if($idrol == 2){
                $option = '<option value="'.$idrol.'" select >'.$rol.'</option>';
            }
            else if($idrol == 3){
                $option = '<option value="'.$idrol.'" select >'.$rol.'</option>';
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
    <title>Editar Usuario</title>
</head>

<body>
    <?php include "../componentes/header.php" ?>

    <section id="container">
        <div class="form_register">
            <h1 class="form_register__title">Editar Usuario</h1>
            <form action="#" method="POST" class="form">
                <div class="alert">
                    <?php echo isset($alert) ? $alert : " " ?>
                </div>
                <input type="hidden" name="idusuario" value=<?php echo $iduser?>>
                <label for="name" class="form__label">Nombre <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form__input" placeholder="Nombre Completo" value=<?php echo $nombre?> required>
                <label for="email" class="form__label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form__input" placeholder="Correo Electronico" value=<?php echo $correo?> required>
                <label for="user" class="form__label">Usuario <span class="text-danger">*</span></label>
                <input type="text" name="user" id="user" class="form__input" placeholder="Usuario" value=<?php echo $usuario?> required>
                <label for="password" class="form__label">Contraseña <span class="text-danger"></span></label>
                <input type="password" name="password" class="form__input" id="password" placeholder="Contraseña">
                <label for="rol" class="form__label">Tipo Usuario <span class="text-danger">*</span></label>

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
                <input type="submit" value="Editar" class="btn_save" style="text-align: right;">
            </form>
        </div>
    </section>

    <?php include "../componentes/footer.php" ?>
</body>

</html>