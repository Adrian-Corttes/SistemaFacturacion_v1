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
      <table class="datatable">
         <div class="datatable-header">
            <div class="datatable-title">
               <h1 class="datatable-title__title">Lista de Usuarios</h1>
            </div>
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
         </thead>

         <?php
         $query = mysqli_query($conection, "SELECT u.idusuario,u.nombre,u.correo,u.usuario,r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol");
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
                        <a href="#" class="delete-icon" title="Eliminar"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                              <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                           </svg></a>
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
   </section>

   <?php include "./components/footer.php" ?>
</body>

</html>