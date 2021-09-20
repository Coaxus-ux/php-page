<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
if ($_SESSION['rol'] != 1) {
    header('location: home.php');
}
require_once "../connection.php";
$query_productos = mysqli_query($connection, "SELECT * FROM usuarios");
$result_productos = mysqli_num_rows($query_productos);






?>
<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>


<body>
    <?php include "includes/adminNav.php" ?>
    <div class="overflow-x-auto mx-16 my-6">
        <div class="flex mx-16">
            <a href="agregarProductos.php" class="btn btn-primary w-1/2 mr-10 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                generar clave 
            </a>
            <a href="admin.php" class="btn btn-warning w-1/2  mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                Volver
            </a>
        </div>

        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre usario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_productos > 0) {

                    while ($usuario = mysqli_fetch_array($query_productos)) {
                        $rol = $usuario['rol'];
                        $query_rol = mysqli_query($connection, "SELECT * FROM roles WHERE id = '$rol'");
                        $result_rol = mysqli_fetch_array($query_rol);

                ?>
                        <tr>
                            <th><?php echo $usuario['id'] ?></th>
                            <td><?php echo $usuario['nombre'] ?></td>
                            <td><?php echo $usuario['correo'] ?></td>
                            <td><?php echo $result_rol['rol'] ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-info hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                    <i class="uil uil-pen"></i> Editar
                                </a>
                                <a href="borrar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-error hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                    <i class="uil uil-times"></i> Borrar
                                </a>

                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>