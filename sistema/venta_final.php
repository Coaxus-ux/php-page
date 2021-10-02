<?php
session_start();
require_once "../connection.php";


$cantida_producto = $_SESSION['cantidad_producto'];
$id_producto = $_SESSION['id_producto'];
$cedula_comprador = $_SESSION['cedula_comprador'];
$nombre_comprador = $_SESSION['nombre_comprador'];
$fecha_movimiento = $_SESSION['fecha_movimiento'];
$precio_final = $_SESSION['precio_final'];

$query_producto = mysqli_query($connection, "SELECT * FROM productos WHERE id = '$id_producto'");
$result_query_producto = mysqli_fetch_array($query_producto);
$nombre_producto = $result_query_producto['nombre'];
$stock_producto = $result_query_producto['stock'];
$nueva_cantidad = $stock_producto - $cantida_producto;

$query_id_movimiento = mysqli_query($connection, "SELECT * FROM movimientos ORDER BY movimientos.id DESC LIMIT 1");
$movimientos_info = mysqli_fetch_array($query_id_movimiento);
$id_movimiento = $movimientos_info['id'];

if (!empty($_POST['done'])) {

    $query_articulo_movimiento = mysqli_query($connection, "INSERT INTO articulo_movimientos(id_movimiento, id_producto, cantidad, valor) VALUE('$id_movimiento', '$id_producto', '$cantida_producto', '$precio_final')");

    if ($query_articulo_movimiento) {
        if ($nueva_cantidad == 0) {
            $query_delete_producto = mysqli_query($connection, "UPDATE productos SET stock = 0, estado = 0 WHERE id = '$id_producto' ");
        } else {
            $query = mysqli_query($connection, "UPDATE productos SET stock = '$nueva_cantidad' WHERE id = '$id_producto' ");
        }
        header('location: usuarios_pages/main.php');
    }
}
if (!empty($_POST['cancel'])) {
    $query_delete_movimiento = mysqli_query($connection, "DELETE FROM movimientos WHERE id = '$id_movimiento'");
    header('location: usuarios_pages/main.php');
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
</head>


<body>

    <div class="relative min-h-screen flex flex-col sm:justify-center items-center ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-xl text-black text-center font-semibold">
                    Agregar productos
                </label>
                <form action="" method="POST" class="mt-10 ">
                    <label class="block mt-1 text-sm text-gray-500 ">
                        Resumen
                    </label>
                    <div class="shadow stats w-full">
                        <div class="stat">
                            <div class="stat-title">Producto: <?php echo $nombre_producto ?></div>
                            <div class="stat-value"><?php echo $precio_final ?></div>
                            <div class="stat-desc">Por un total de <?php echo $cantida_producto ?> unidades </div>
                        </div>
                    </div>


                    <hr class="mt-2">
                    <label class="block mt-1 text-sm text-gray-500 ">
                        Datos vendedor
                    </label>

                    <div class="shadow stats w-full">
                        <div class="stat">
                            <div class="stat-title">Comprador: <?php echo $nombre_comprador ?></div>
                            <div class="stat-title"> Cedula: <?php echo $cedula_comprador ?></div>
                            <div class="stat-desc">Fecha: <?php echo $fecha_movimiento ?> </div>
                        </div>
                    </div>
                    <div class="mt-7 ">
                        <input type="submit" name="done" value="Confirmar venta" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    </div>
                    <input type="submit" name="cancel" value="Cancelar compra" class="btn btn-secundary w-full mt-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                </form>




            </div>
        </div>
    </div>

</body>

</html>