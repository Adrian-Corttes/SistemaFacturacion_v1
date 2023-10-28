<?php
    session_start();
    
    if(!empty($_SESSION['active'])){
        header('location: sistema/');
    }
    else{
        $alert = "";
        //validamos el envio del formulario
        if(!empty($_POST)){
            //validamos que los campos del formulario no esten vacios
            if(empty($_POST["user"]) || empty($_POST["password"])){
                $alert = "Ingrese su usuario y su contraseña";
            }
            else{
                require_once "./conexion.php";
                // mysqli_real_escape_string, esta función se utiliza para eliminar los caracteres extraños.
                $user = mysqli_real_escape_string($conection, $_POST["user"]);
                //se encripta la contraseña con la funcion md5().
                $pass = md5(mysqli_real_escape_string($conection, $_POST["password"]));
    
                $query = mysqli_query($conection,"SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
                $result = mysqli_num_rows($query);
    
                if($result > 0){
                    $data = mysqli_fetch_array($query);
                  //varibles de sesion
                    $_SESSION['active'] = true;
                    $_SESSION['idUser'] = $data['idusuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['user'] = $data['usuario'];
                    $_SESSION['rol'] = $data['rol'];
    
                    header('location: sistema/');
                }
                else{
                    $alert = "Oupss. Usuario o contraseña incorrectos";
                    session_destroy();
                }
            }
        }
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema Facturación</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <h2 class="title">Sistema de Facturación V1.0</h2>
    <section class="container_form">
        <form action="#" method="POST" class="form">
            <h2 class="form__title">Inicio de Sesión</h2>

            <img src="./img/huella-dactilar.png" alt="Img_Login">
            <input type="text" name="user" id="user" class="form__input" placeholder="Usuario">
            <input type="password" name="password" id="password" class="form__input" placeholder="Contraseña">
                            
            <div class="alert"><?php echo (isset($alert)? $alert : "")//Operador ternario?></div>

            <button type="submit" class="form__button">Ingresar al Sistema</button>
        </form>
    </section>
</body>
</html>