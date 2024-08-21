<?php
session_start();
//Validamos la sesión, para que la pagina quede privada
if(empty($_SESSION['active'])){
    header('location: ../');
}

?>
<header>
    <div class="header">
        <h1>BillingSys</h1>
        <div class="optionsBar">
            <p><?php echo fechaC();?></p>
            <span>|</span>
            <span class="user"><?php echo $_SESSION['user'];?></span>
            <img class="photouser" src="./public/img/user.png" alt="Usuario">
            <a href="./salir.php"><img class="close" src="./public/img/salir.png" alt="Salir del sistema" title="Salir"></a>
        </div>
    </div>
    <?php include "nav.php"?>
</header>