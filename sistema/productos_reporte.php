<?php
require_once "../connection.php";
session_start();
$id_usuario = $_SESSION['id'];
$query_productos;
if($_SESSION['rol'] == 1){
    $query_productos = mysqli_query($connection, "SELECT * FROM productos");
}else{
    $query_productos = mysqli_query($connection, "SELECT * FROM productos WHERE id_user = '$id_usuario'");
}

$result_productos = mysqli_num_rows($query_productos);

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
            <h4>Reporte de todos los productos disponibles</h4>
        </div>

        <table>
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
                            <td><?php echo $producto['ultimo_costo'] ?></td>
                            <td><?php echo $result_linea['descripcion'] ?> - <?php echo $result_sublinea['descripcion'] ?></td>
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