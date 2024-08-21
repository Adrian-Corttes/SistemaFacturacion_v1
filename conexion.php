<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $bd = "billinsys";

    $conection = @mysqli_connect($host,$user,$password,$bd);
    
    if(!$conection){
        echo "Ooops!..  Error en la conexion";
    }
?>
