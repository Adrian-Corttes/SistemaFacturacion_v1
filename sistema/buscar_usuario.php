<?php
include "../conexion.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "./components/scripts.php" ?>
    <title>Lista Usuarios</title>
</head>

<body>
    <?php include "./components/header.php" ?>

    <section class="container">
       
        <?php
        //Capturamos la información que viene en la URL
        $busqueda = strtolower($_REQUEST['busqueda']);
        //Función strtolower() onvierte mayúsculas a minúsculas.

        if (empty($busqueda)) {
            header("location: lista_usuario.php");
        }
        ?>

        <table class="datatable">
            <div class="datatable-header">
                <div class="datatable-title">
                    <h1 class="datatable-title__title">Lista de Usuarios</h1>
                </div>
                    <!-- Buscador -->
                <div class="serach">
                    <form action="buscar_usuario.php" method="GET" class="">
                        <input type="text" name="busqueda" id="busqueda" class="buscar" placeholder="Buscar" value="<?php echo $busqueda; ?>">
                        <input type="submit" value="Buscar" class="btn_search">
                    </form>
                </div>
                <!-- Btn nuevo usuario -->
                <div class="datatable-links">
                    <a href="./registro_usuario.php" class="datatable-header__add-btn" title="Agregar nuevo usuario"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                            <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                        </svg></a>

                    <a href="./index.php" class="datatable-header__close" title="Cerrar"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                        </svg></a>
                </div>
            </div>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php
            //Condicional par los roles.
            $rol = '';

            if ($busqueda == 'administrador') {
                $rol = "OR rol LIKE '%1%'";
            } else if ($busqueda == 'supervisor') {
                $rol = "OR rol LIKE '%2%'";
            } else if ($busqueda == 'vendedor') {
                $rol = "OR rol LIKE '%3%'";
            }

            //Query para la usqueda
            $query_registe = mysqli_query($conection, "SELECT COUNT(*) AS total_registro FROM usuario WHERE (idusuario LIKE '%$busqueda%' OR nombre LIKE '%$busqueda%' OR correo LIKE '%$busqueda%' OR usuario LIKE '%$busqueda%' $rol) AND estatus = 1;");
            $result_register = mysqli_fetch_array($query_registe);
            $tatal_registro = $result_register['total_registro'];

            //Logica para el paginador
            $por_pagina = 10;

            if (empty($_GET['pagina'])) {
                $pagina = 1;
            } else {
                $pagina  = $_GET['pagina'];
            }

            $desde = ($pagina - 1) * $por_pagina;
            //la función Ceil nos redondea el numero a un entero
            $total_paginas = ceil($tatal_registro / $por_pagina);

            //Query para Mostrar el listado de usuarios
            $query = mysqli_query($conection, "SELECT u.idusuario,u.nombre,u.correo,u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE (u.idusuario LIKE '%$busqueda%' OR u.nombre LIKE '%$busqueda%' OR u.correo LIKE '%$busqueda%' OR u.usuario LIKE '%$busqueda%' OR r.rol LIKE '%$busqueda%') AND estatus = 1 ORDER BY idusuario ASC LIMIT $desde,$por_pagina");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                while ($data = mysqli_fetch_array($query)) {
            ?>
                    <tbody class="datatable__body">
                        <tr>
                            <td><?php echo $data['idusuario'] ?></td>
                            <td><?php echo $data['nombre'] ?></td>
                            <td><?php echo $data['correo'] ?></td>
                            <td><?php echo $data['usuario'] ?></td>
                            <td><?php echo $data['rol'] ?></td>
                            <td>
        
                                <?php if ($data['idusuario'] != 1) { ?>
                                    <!-- Btn eliminar usuario, Enviamos datos mediate URL-->
                                    <a href="./eliminar_confirmar_usuario.php?id=<?php echo $data['idusuario'] ?>" class="delete-icon" title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                        </svg>
                                    </a>
                                <?php } ?>

                                <!-- Enviamos datos mediate URL -->
                                <a href="./editar_usuario.php?id=<?php echo $data['idusuario'] ?>" class="edit-icon" title="Editar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></a>
                            </td>
                        </tr>
                    </tbody>
            <?php
                }
            }
            ?>


        </table>

        <!-- Paginador -->
        <div class="paginador">
            <ul>
                <?php
                //validación para busquedas no encontradas.
                if ($pagina != 1) {
                ?>

                    <li><a href="?pagina=<?php echo 1; ?> &busqueda <?php echo $busqueda ?>"> |< </a></li>
                    <li><a href="?pagina=<?php echo $pagina - 1; ?> &busqueda <?php echo $busqueda ?>"> << </a></li>
                <?php
                }
                for ($i = 1; $i <= $total_paginas; $i++) {
                    if ($i == $pagina) {
                        echo '<li class="pageSelected">' . $i . '</li>';
                    } else {
                        echo '<li><a href="?pagina=' .$i. '&busqueda='.$busqueda.'">' .$i. '</a></li>';
                    }
                }

                if ($pagina != $total_paginas) {
                ?>
                    <li><a href="?pagina=<?php echo $pagina + 1; ?> &busqueda <?php echo $busqueda ?>">>></a></li>
                    <li><a href="?pagina=<?php echo $total_paginas; ?> &busqueda <?php echo $busqueda ?>">>|</a></li>
                <?php } ?>
            </ul>
        </div>

    </section>

    <?php include "./components/footer.php" ?>
</body>

</html>