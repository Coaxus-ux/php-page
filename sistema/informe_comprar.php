<?php 
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
$user = $_SESSION['id'];

require_once "../connection.php";
$query_compra = mysqli_query($connection, "SELECT * FROM movimientos WHERE tipo_movimiento = 1 AND id_usuario = '$user'");
$result_compra = mysqli_num_rows($query_compra);
?>
<!DOCTYPE html>
<html lang="en">
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>

<body>
    <div class="centrado">
        <div>
            <h1>Inventarios PHP</h1>
            <h4>Reporte de compras</h4>
        </div>

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
</body>
</html>