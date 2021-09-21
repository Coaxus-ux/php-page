<?php
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}

$alert = false;
$mensaje = '';
if (!empty($_POST)) {
    $cantida_producto = $_POST['cantida_producto'];
    $producto_nombre = $_POST['producto_nombre'];
    $cedula = $_POST['cedula'];
    $nombre_vendedor = $_POST['nombre_vendedor'];
    $fecha_movimiento = $_POST['fecha_movimiento'];

    $user = $_SESSION['id'];
    if (empty($cantida_producto) || empty($producto_nombre) || empty($nombre_vendedor) || empty($cedula) || empty($fecha_movimiento)) {
        $alert = true;
        $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>No pueden quedar casillas vacias.</label>
            </div>
            </div>';
    } else {
        $query_producto = mysqli_query($connection, "SELECT * FROM productos WHERE id = '$producto_nombre'");
        $result_query_producto = mysqli_fetch_array($query_producto);
        $stock_producto = $result_query_producto['stock'];
        $precio_producto = $result_query_producto['ultimo_costo'];
        $precio_siniva = $precio_producto * $cantida_producto;
        $precio_final = ($precio_siniva * 110) / 100;
        if($stock_producto < $cantida_producto){
            $alert = true;
            $mensaje = '<div class="alert my-2 ">
        <div class="flex-1 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
            </svg>
            <label>No hay unidades suficientes.</label>
        </div>
        </div>';
        }else{
            $query_movimiento = mysqli_query($connection, "INSERT INTO movimientos(tipo_movimiento, cedula_movimiento, nombre_movimiento, fecha_movimiento, valor_total_movimiento) VALUES(2, '$cedula', '$nombre_vendedor', '$fecha_movimiento', '$precio_siniva')");
            $_SESSION['precio_final'] = $precio_final;
            $_SESSION['cantidad_producto'] = $cantida_producto;
            $_SESSION['id_producto'] = $producto_nombre;
            $_SESSION['cedula_comprador'] = $cedula;
            $_SESSION['nombre_comprador'] = $nombre_vendedor;
            $_SESSION['fecha_movimiento'] = $fecha_movimiento;
            header("Location: venta_final.php");
        }
    }
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
                        Datos de la venta
                    </label>
                    <?php
                    $query_linea = mysqli_query($connection, "SELECT * FROM productos");
                    $result_linea = mysqli_num_rows($query_linea);
                    ?>
                    <select name="producto_nombre" class="select select-bordered w-full mt-1">
                        <option disabled="disabled" selected="selected">Producto</option>

                        <?php
                        if ($result_linea > 0) {
                            while ($producto = mysqli_fetch_array($query_linea)) {
                        ?>
                                <option value="<?php echo $producto['id'] ?>"><?php echo $producto['nombre'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                    <div class="form-control">
                        <input type="number" min="0" placeholder="Cantidad a vender" name="cantida_producto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>


                    <hr class="mt-2">
                    <label class="block mt-1 text-sm text-gray-500 ">
                        Datos vendedor
                    </label>
                    <div class="form-control">
                        <input type="number" min="0" placeholder="Cedula vendedor" name="cedula" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <div class="form-control">
                        <input type="text" min="0" placeholder="Nombre vendedor" name="nombre_vendedor" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <label for="fecha_movimiento" class="block mt-1 text-sm text-gray-500 ">
                        Fecha del movimiento
                    </label>
                    <div class="form-control">
                        <input type="date"  name="fecha_movimiento" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" value="Siguiente" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    </div>



                </form>
                <a href="usuarios_pages/main.php" class="btn btn-secundary w-full mt-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Volver
                </a>



            </div>
        </div>
    </div>

</body>

</html>