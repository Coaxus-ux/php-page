<?php
include "../connection.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT * FROM productos WHERE id = '$id'");

    if (mysqli_num_rows($query) == 1) {
        $producto = mysqli_fetch_array($query);
        $nombre = $producto['nombre'];
        $descripcion = $producto['descripcion'];
        $stock = $producto['stock'];
        $precio = $producto['ultimo_costo'];
    }
}

$alert = false;
$mensaje = '';
if (!empty($_POST['update'])) {
    $id = $_GET['id'];
    $producto = $_POST['nombreProducto'];
    $descripcionProducto = $_POST['descripcionProducto'];
    $stockProducto = $_POST['stockProducto'];
    $linea = $_POST['linea'];
    $sub_linea = $_POST['sublinea'];
    $costoProducto = $_POST['costoProducto'];
    if (empty($producto) || empty($descripcionProducto) || empty($stockProducto) || empty($costoProducto)) {
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
        $query = "UPDATE productos SET nombre = '$producto', descripcion='$descripcionProducto', stock = '$stockProducto', ultimo_costo='$costoProducto', id_linea='$linea', id_sublinea = '$sub_linea' WHERE id = '$id' ";
        $result_q = mysqli_query($connection, $query);
        if(!$result_q) {
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
        if($result_q) {
            $alert = true;
            $mensaje = '<div class="alert alert-success my-2 ">
            <div class="flex-1 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">          
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>                
          </svg> 
                <label>Producto actualizado con exito.</label>
            </div>
            </div>';
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
                    Editar producto
                </label>
                <form action="editar.php?id=<?php echo $_GET['id'];?>" method="POST" class="mt-10 ">

                    <div class="form-control">
                        <input value="<?php echo $nombre ?>" type="text" placeholder="Nombre producto" name="nombreProducto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <div class="form-control mt-1">
                        <textarea maxlength="600" class="textarea h-24 textarea-bordered" placeholder="Descripcion del producto" name="descripcionProducto"> <?php echo $descripcion ?></textarea>
                    </div>
                    <div class="form-control">
                        <input disabled="disabled" value="<?php echo $stock ?>" type="number" min="0" placeholder="Stock" name="stockProducto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <div class="form-control">
                        <input disabled="disabled" value="<?php echo $precio ?>" type="number" min="0" placeholder="Costo" name="costoProducto" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <?php
                    $query_linea = mysqli_query($connection, "SELECT * FROM linea");
                    $result_linea = mysqli_num_rows($query_linea);
   



                    ?>
                    <select id='select1' name="linea" class="select select-bordered w-full mt-1">
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



                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" name="update" value="guardar Producto" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">

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