<?php
include "../../conexion.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <?php include "../componentes/scripts.php" ?>
  <title>Registro Usuarios</title>
</head>

<body>
  <?php include "../componentes/header.php" ?>

  <section id="container" class="container-list">
    <table class="datatable">
      <div class="datatable__title">
        <h1 class="container-list__title">Lista de Usuarios</h1>
        <a href="./registro_usuario.php" class="container-list__btn">Agregar Nuevo/a</a>
      </div>
      <thead class="datatable__thead">
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
                <a href="#" class="delete-icon" title="Eliminar"><i class="bi bi-trash3"></i></a>
                <a href="./editar_usuario.php?id=<?php echo $data['idusuario'] ?>" class="edit-icon" title="Editar"><i class="bi bi-pencil-square"></i></a>
              </td>
            </tr>
          </tbody>
      <?php
        }
      }
      ?>


    </table>
  </section>

  <?php include "../componentes/footer.php" ?>
</body>

</html>