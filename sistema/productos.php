<?php
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
$id_usuario = $_SESSION['id'];
$url;
if ($_SESSION['rol'] == 1) {
    $query_productos = mysqli_query($connection, "SELECT * FROM productos");
    $url = 'admin.php';
} else {
    $query_productos = mysqli_query($connection, "SELECT * FROM productos WHERE id_user = '$id_usuario'");
    $url = './usuarios_pages/main.php';
}
$result_productos = mysqli_num_rows($query_productos);

?>
<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>


<body>
    <div class="overflow-x-auto mx-16 mt-16">
        <div class="flex mx-16">
            <?php
            if ($_SESSION['rol'] != 1) { ?>
                <a href="agregarProductos.php" class="btn btn-primary w-56 mr-10 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Agregar productos
                </a>
            <?php  }
            ?>

            <div class="dropdown dropdown-hover ">
                <form action="report.php" method="POST">
                    <div tabindex="0" class="m-1 btn w-56 mr-10 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">Generara informe</div>
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <input class="btn" type="submit" name="generar_pdf" value="PDF"></input>
                        </li>
                        <li>
                            <a>excel</a>
                        </li>

                    </ul>
            </div>
            </form>
            <a href="<?php echo $url ?>" class="btn btn-warning w-56 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                Volver
            </a>
        </div>

        <table class="table w-full table-zebra">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre producto</th>
                    <th>Descripcion</th>
                    <th>Stock</th>
                    <th>Costo</th>
                    <th>Categorias</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_productos > 0) {

                    while ($producto = mysqli_fetch_array($query_productos)) {
                        $linea = $producto['id_linea'];
                        $query_linea = mysqli_query($connection, "SELECT * FROM linea WHERE id = '$linea'");
                        $result_linea = mysqli_fetch_array($query_linea);

                        $sublinea = $producto['id_sublinea'];
                        $query_sublinea = mysqli_query($connection, "SELECT * FROM sublinea WHERE id = '$sublinea'");
                        $result_sublinea = mysqli_fetch_array($query_sublinea);
                ?>
                        <tr>
                            <th><?php echo $producto['id'] ?></th>
                            <td><?php echo $producto['nombre'] ?></td>
                            <td><?php echo $producto['descripcion'] ?></td>
                            <td><?php echo $producto['stock'] ?></td>
                            <td>$<?php echo $producto['ultimo_costo'] ?></td>
                            <td><?php echo $result_linea['descripcion'] ?> <i class="uil uil-arrow-right"></i> <?php echo $result_sublinea['descripcion'] ?></td>
                            <td><a href="editar.php?id=<?php echo $producto['id'] ?>" class="btn btn-accent mr-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                    <i class="uil uil-pen"></i> Editar
                                </a><a href="borrar.php?id=<?php echo $producto['id'] ?>" class="btn btn-error hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                                    <i class="uil uil-times"></i> Borrar
                                </a></td>
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