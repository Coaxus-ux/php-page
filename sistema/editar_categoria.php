<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
if ($_SESSION['rol'] != 1) {
    header('location: usuarios_pages/main.php');
}
include "../connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT * FROM linea WHERE id = '$id'");

    if (mysqli_num_rows($query) == 1) {
        $linea = mysqli_fetch_array($query);
        $descripcion = $linea['descripcion'];
    }
}


$alert = false;
$mensaje = '';
if (!empty($_POST)) {
    $id = $_GET['id'];
    $nombreCategoria = $_POST['nombreCategoria'];
    $estado = intval($_POST['estado']);


    if (empty($nombreCategoria)) {
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
        $query = "UPDATE linea SET descripcion='$nombreCategoria', estado='$estado' WHERE id = '$id' ";
        $result_q = mysqli_query($connection, $query);
        if(!$result_q) {
            $alert = true;
            $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Actualizacion de la categoria fallo.</label>
            </div>
            </div>';
        }
        if ($result_q) {
            if ($estado == 0) {
                $query_sub = "UPDATE sublinea SET estado='$estado' WHERE categoria_id = '$id' ";
                $result_s = mysqli_query($connection, $query_sub);
            }
            
            header("Location: categoria.php");
            
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
                    Agregar Categoria
                </label>
                <form action="editar_categoria.php?id=<?php echo $_GET['id']; ?>" method="POST" class="mt-10 ">
                    <div class="form-control">
                        <input type="text" value="<?php echo $descripcion ?>" placeholder="Nombre Categoria" name="nombreCategoria" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <select name="estado" class="select select-bordered w-full mt-1">
                        <option disabled="disabled" selected="selected">Estado</option>
                        <option  value="1" >Disponible</option>
                        <option  value="0" >Oculta</option>

                    </select>

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" value="Actualizar" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    </div>



                </form>
                <a href="categoria.php" class="btn btn-secundary w-full mt-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Volver
                </a>



            </div>
        </div>
    </div>

</body>

</html>