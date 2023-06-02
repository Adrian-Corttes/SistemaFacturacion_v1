<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $bd = "sistemafacturacion";

    $conection = @mysqli_connect($host,$user,$password,$bd);
    
    if(!$conection){
        echo "Error en la conexion";
    }
?>
