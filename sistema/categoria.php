<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
if ($_SESSION['rol'] != 1) {
    header('location: ../login.php');
}
require_once "../connection.php";
$query_linea = mysqli_query($connection, "SELECT * FROM linea");
$query_subLinea = mysqli_query($connection, "SELECT * FROM sublinea");

$result_linea = mysqli_num_rows($query_linea);
$result_subLinea = mysqli_num_rows($query_subLinea);

?>

<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>


<body>
    <?php include "includes/adminNav.php" ?>
    <div class="overflow-x-auto mx-16 ">
        <div class="flex mx-16">
            <a href="agregarProductos.php" class="btn btn-primary w-56 mr-10 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                Agregar productos
            </a>
            </form>
            <a href="admin.php" class="btn btn-warning w-56 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                Volver
            </a>
        </div>
    </div>
    <div class="flex flex-row justify-center mt-10">
        <div>
            <div class="overflow-x-auto">
                <table class="table w-full table-zebra">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nombre categoria</th>
                            <th>Numero de productos</th>
                            <th>Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_linea > 0) {
                            while ($linea = mysqli_fetch_array($query_linea)) {
                                $id = $linea['id'];
                                $query_productos = mysqli_query($connection, "SELECT * FROM productos WHERE id_linea = '$id'");

                                $num_rows_productos = mysqli_num_rows($query_productos);
                        ?>
                                <tr>
                                    <th> <?php echo $linea['id'] ?></th>
                                    <td><?php echo $linea['descripcion'] ?></td>
                                    <td><?php echo $num_rows_productos ?></td>
                                    <td>
                                        <a href="editar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-info hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                            <i class="uil uil-pen"></i> Editar
                                        </a>
                                        <a href="borrar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-error hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                            <i class="uil uil-times"></i> Borrar
                                        </a>
                                        <a href="borrar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-secundary hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                            <i class="uil uil-file-minus"></i> listar
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
        </div>
        <div>
            <table class="table w-full table-zebra mx-16">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre sub-categoria</th>
                        <th>Numero de productos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_subLinea > 0) {
                        while ($sublinea = mysqli_fetch_array($query_subLinea)) {
                            $idS = $sublinea['id'];
                            $query_productos_sublinea = mysqli_query($connection, "SELECT * FROM productos WHERE id_sublinea = '$idS'");

                            $num_rows_productos_sublinea = mysqli_num_rows($query_productos_sublinea);
                    ?>
                            <tr>
                                <th> <?php echo $sublinea['id'] ?></th>
                                <td><?php echo $sublinea['descripcion'] ?></td>
                                <td><?php echo $num_rows_productos_sublinea ?></td>
                                <td>
                                    <a href="editar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-info hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                        <i class="uil uil-pen"></i> Editar
                                    </a>
                                    <a href="borrar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-error hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                        <i class="uil uil-times"></i> Borrar
                                    </a>
                                    <a href="borrar_usuario.php?id=<?php echo $usuario['id'] ?>" class="btn btn-secundary hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                    <i class="uil uil-file-minus"></i> listar
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
    </div>
</body>

</html>