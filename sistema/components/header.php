<?php
session_start();
//Validamos la sesión, para que la pagina quede privada
if (empty($_SESSION['active'])) {
    header('location: ../');
}

?>
<header>
    <div class="header">
        <h1>SoftVipad, Factu</h1>
        <div class="optionsBar">
            <p><?php echo fechaC(); ?></p>
            <span>|</span>
            <span class="user"><?php echo $_SESSION['user']; ?></span>
            <img class="photouser" src="./public/img/user.png" alt="Usuario">
            <a href="./salir.php" title="Salir del sistema"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                    <path d="M7.5 1v7h1V1z" />
                    <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812" />
                </svg></a>
        </div>
    </div>
    <?php include "nav.php" ?>
</header>