<?php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=reporte.xls");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
$user = $_SESSION['id'];

require_once "../connection.php";

$query_ventas = mysqli_query($connection, "SELECT * FROM movimientos WHERE tipo_movimiento = 2 AND id_usuario = '$user'");
$result_ventas = mysqli_num_rows($query_ventas);
?>
<!DOCTYPE html>
<html lang="es" data-theme="dracula">

<head>

    <meta charset="utf-8" />
</head>
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

</html>