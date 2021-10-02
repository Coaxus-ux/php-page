<?php
session_start();
require_once "../connection.php";
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}

$alert = false;
$mensaje = '';
if (!empty($_POST)) {
    $producto = $_POST['nombreProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $linea = $_POST['linea'];
    $sub_linea = $_POST['sublinea'];
    $cedula = $_POST['cedula'];
    $nombre_vendedor = $_POST['nombre_vendedor'];
    $fecha_movimiento = $_POST['fecha_movimiento'];
    $user = $_SESSION['id'];
    if (empty($producto) || empty($descripcionProducto) || empty($nombre_vendedor) || empty($cedula) || empty($fecha_movimiento)) {
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

        $alert = false;
        $query = "INSERT INTO productos(nombre, descripcion, stock, ultimo_costo, id_user, id_linea, id_sublinea) VALUES('$producto','$descripcionProducto', 2, 1, '$user', '$linea', '$sub_linea')";
        $query_movimientos = "INSERT INTO movimientos(id_usuario, tipo_movimiento, cedula_movimiento, nombre_movimiento, fecha_movimiento, valor_total_movimiento) VALUES('$user', 1, '$cedula', '$nombre_vendedor', '$fecha_movimiento', 0)";
        $result_q = mysqli_query($connection, $query);
        $result_movimientos = mysqli_query($connection, $query_movimientos);

        if (!$result_q || !$result_movimientos) {
            $alert = true;
            $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Registro del producto fallo.</label>
            </div>
            </div>';
        }
        if ($result_q) {
            $alert = true;
            $mensaje = '<div class="alert alert-success my-2 ">
            <div class="flex-1 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">          
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
          </svg> 
                <label>Producto registrado con exito.</label>
            </div>
            </div>';
            header('location: articulo_movimiento.php');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "includes/link.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                        Datos producto
                    </label>
                    <div class="form-control">
                        <input type="text" placeholder="Nombre producto" name="nombreProducto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <div class="form-control mt-1">
                        <textarea maxlength="600" class="textarea h-24 textarea-bordered" placeholder="Descripcion del producto" name="descripcionProducto"></textarea>
                    </div>
                    <?php
                    $query_linea = mysqli_query($connection, "SELECT * FROM linea WHERE estado = 1");
                    $result_linea = mysqli_num_rows($query_linea);

                    ?>
                    <select id="select1" name="linea" class="select select-bordered w-full mt-1">
                        <option disabled="disabled" selected="selected">Categoria</option>

                        <?php
                        if ($result_linea > 0) {
                            while ($linea = mysqli_fetch_array($query_linea)) {

                        ?>
                                <option value="<?php echo $linea['id'] ?>"><?php echo $linea['descripcion'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>

                    <div id="select2">

                    </div>
                    <script>
                        $(document).ready(function() {
                            recargarLista();
                            $('#select1').change(function() {
                                recargarLista();
                            });
                        })
                    </script>
                    <script>
                        function recargarLista() {
                            $.ajax({
                                type: "POST",
                                url: "subcategoria_llamado.php",
                                data: "categoria=" + $('#select1').val(),
                                success: function(r) {
                                    $('#select2').html(r);
                                }
                            })
                        }
                    </script>

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
                        <input type="date" name="fecha_movimiento" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" value="Siguiente" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    </div>



                </form>
                <a href="productos.php" class="btn btn-secundary w-full mt-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Volver
                </a>



            </div>
        </div>
    </div>

</body>

</html>