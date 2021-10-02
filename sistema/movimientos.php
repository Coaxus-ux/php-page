<?php
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
$user = $_SESSION['id'];

require_once "../connection.php";
$query_compra = mysqli_query($connection, "SELECT * FROM movimientos WHERE tipo_movimiento = 1 AND id_usuario = '$user'");
$query_ventas = mysqli_query($connection, "SELECT * FROM movimientos WHERE tipo_movimiento = 2 AND id_usuario = '$user'");

$result_compra = mysqli_num_rows($query_compra);
$result_ventas = mysqli_num_rows($query_ventas);
?>

<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>

<body>

    <div class="mt-10 mx-auto ml-10">

        <div class="dropdown">
            <form action="report_compras.php" method="post">
            <div tabindex="0" class="m-1 btn">Informe Compras</div>
            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                <li>
                    <input class="btn" name="generar_pdf" value="PDF" type="submit"></input>
                </li>
                <li>
                    <a class="btn mt-1" href="compras_excel.php">Excel</a>
                </li>
            </ul>
        </div>
        </form>
        <div class="dropdown">
        <form action="report_ventas.php" method="post">
            <div tabindex="0" class="m-1 btn">Informe Ventas</div>
            <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                <li>
                <input class="btn" name="generar_pdf" value="PDF" type="submit"></input>
                </li>
                <li>
                <a class="btn mt-1" href="ventas_excel.php">Excel</a>
                </li>
            </ul>
        </div>
        </form>
        <a href="admin.php" class="btn btn-warning w-56 mb-3 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
            Volver
        </a>
    </div>
    </div>
    <div class="flex flex-col sm:flex-row justify-center mt-10 overflow-x-auto">
        <div>
            <div class="">
                <p class="text-2xl text-center pb-3"> Compras </p>
                <table class="table w-full table-zebra">
                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Producto</th>
                            <th>Cedula</th>
                            <th>Fecha</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result_compra > 0) {
                            while ($compra = mysqli_fetch_array($query_compra)) {
                                $id = $compra['id'];
                                $query_productos = mysqli_query($connection, "SELECT * FROM articulo_movimientos WHERE id_movimiento = '$id'");

                                $num_rows_productos = mysqli_fetch_array($query_productos);
                                $id_producto = $num_rows_productos['id_producto'];
                                $query_productos_nombre = mysqli_query($connection, "SELECT * FROM productos WHERE id = '$id_producto'");
                                $array_productos = mysqli_fetch_array($query_productos_nombre);

                        ?>
                                <tr>
                                    <th> <?php echo $compra['id'] ?></th>
                                    <td><?php echo $compra['nombre_movimiento'] ?></td>
                                    <td><?php echo $array_productos['nombre'] ?></td>
                                    <td><?php echo $compra['cedula_movimiento'] ?></td>
                                    <td><?php echo $compra['fecha_movimiento'] ?></td>
                                    <td><?php echo $num_rows_productos['cantidad'] ?></td>
                                    <td>$<?php echo $compra['valor_total_movimiento'] ?></td>
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
            <p class="text-2xl text-center pb-3"> Ventas </p>
            <table class="table w-full table-zebra mx-16 mt-10 sm:mt-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Producto</th>
                        <th>Cedula</th>
                        <th>Fecha</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result_ventas > 0) {
                        while ($ventas = mysqli_fetch_array($query_ventas)) {
                            $idS = $ventas['id'];
                            $query_productos_ventas = mysqli_query($connection, "SELECT * FROM articulo_movimientos WHERE id_movimiento = '$idS'");
                            $num_rows_productos_ventas = mysqli_fetch_array($query_productos_ventas);
                            $id_producto_ventas = $num_rows_productos_ventas['id_producto'];
                            $query_productos_nombre_ventas = mysqli_query($connection, "SELECT * FROM productos WHERE id = '$id_producto_ventas'");
                            $array_productos_ventas = mysqli_fetch_array($query_productos_nombre_ventas);
                    ?>
                            <tr>
                                <th> <?php echo $ventas['id'] ?></th>
                                <td><?php echo $ventas['nombre_movimiento'] ?></td>
                                <td><?php echo $array_productos_ventas['nombre'] ?></td>
                                <td><?php echo $ventas['cedula_movimiento'] ?></td>
                                <td><?php echo $ventas['fecha_movimiento'] ?></td>
                                <td><?php echo $num_rows_productos_ventas['cantidad'] ?></td>
                                <td>$<?php echo $ventas['valor_total_movimiento'] ?></td>
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