<?php
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}

if($_SESSION['rol'] == 1){
    header('location: admin.php');
}
$query_productos = mysqli_query($connection, "SELECT * FROM productos ORDER BY productos.id DESC LIMIT 1");
$query_movimientos = mysqli_query($connection, "SELECT * FROM movimientos ORDER BY movimientos.id DESC LIMIT 1");
$productos = mysqli_fetch_array($query_productos);
$nombre_producto = $productos['nombre'];
$id_producto = $productos['id'];


$movimientos = mysqli_fetch_array($query_movimientos);
$cedula_movimiento = $movimientos['cedula_movimiento'];
$nombre_movimiento = $movimientos['nombre_movimiento'];
$id_movimiento = $movimientos['id'];


$alert = false;
$mensaje = '';
if (!empty($_POST)){
    $precio_unidad = $_POST['precio_unidad'];
    $cantidad_unidades =$_POST['cantidad_unidades'];

    
    if(empty($cantidad_unidades) || empty($precio_unidad)){
        $alert = true;
        $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>No pueden quedar casillas vacias.</label>
            </div>
            </div>';
    }else{
        $alert = false;
        $precio_total = $cantidad_unidades * $precio_unidad;

        $query_actualizar_movimiento = "UPDATE movimientos SET valor_total_movimiento='$precio_total' WHERE id = '$id_movimiento'";
        $result_query_actualizar_movimiento = mysqli_query($connection, $query_actualizar_movimiento);


        $query_actualizar_producto = "UPDATE productos SET stock='$cantidad_unidades', ultimo_costo='$precio_unidad' WHERE id = '$id_producto'";
        $result_query_actualizar_producto = mysqli_query($connection, $query_actualizar_producto);


        $query_articulo_movimiento = "INSERT INTO articulo_movimientos(id_movimiento, id_producto, cantidad, valor) VALUE('$id_movimiento', '$id_producto', '$cantidad_unidades', '$precio_unidad')";
        $result_query_articulo_movimiento = mysqli_query($connection, $query_articulo_movimiento);
        
        if(!$result_query_actualizar_movimiento || !$result_query_actualizar_producto || !$result_query_articulo_movimiento) {
            $alert = true;
            $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Actualizacion del producto fallo.</label>
            </div>
            </div>';
        }
        if($result_query_actualizar_movimiento || $result_query_actualizar_producto || $result_query_articulo_movimiento) {
            $alert = true;
            $mensaje = '<div class="alert alert-success my-2 ">
            <div class="flex-1 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">          
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
          </svg> 
                <label>Producto actualizado con exito.</label>
            </div>
            </div>';
            header('location: usuarios_pages/main.php');
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
                <form action="" method="POST" class="mt-4 ">
                    <hr class="mt-2">
                    <label class="block mt-1 text-sm text-gray-500 ">
                        Resumen
                    </label>
                    <div class="form-control">
                        <input disabled="disabled" type="text" placeholder="<?php echo $nombre_producto ?>" name="nombreProducto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <div class="form-control">
                        <input type="number" disabled="disabled" min="0" placeholder="<?php echo $cedula_movimiento ?>" name="cedula" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <div class="form-control">
                        <input type="text" disabled="disabled" min="0" placeholder="<?php echo $nombre_movimiento ?>" name="nombre_vendedor" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <hr class="mt-2">


                    <label for="fecha_movimiento" class="block mt-1 text-sm text-gray-500 ">
                        Dato finales
                    </label>
                    <div class="form-control">
                        <input type="number"  min="0" placeholder="Cantidad" name="cantidad_unidades" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <div class="form-control">
                        <input type="number"  min="0" placeholder="Precio por unidad" name="precio_unidad" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" value="Finalizar" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>