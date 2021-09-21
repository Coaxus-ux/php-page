<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=reporte.xls");
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
<table class="table w-full table-zebra">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre producto</th>
            <th>Descripcion</th>
            <th>Stock</th>
            <th>Costo</th>
            <th>Categorias</th>
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
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>

</html>