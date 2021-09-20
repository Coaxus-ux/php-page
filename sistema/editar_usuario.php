<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
if ($_SESSION['rol'] != 1) {
    header('location: home.php');
}
include "../connection.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($connection, "SELECT * FROM usuarios WHERE id = '$id'");

    if (mysqli_num_rows($query) == 1) {
        $usuario = mysqli_fetch_array($query);
        $nombre = $usuario['nombre'];
        $correo = $usuario['correo'];
    }
}

$alert = false;
$mensaje = '';
if (!empty($_POST['update'])) {
    $id = $_GET['id'];
    $nombreUsuario = $_POST['nombreUsuario'];
    $email = $_POST['email'];
    $roles = $_POST['rol'];
    echo $roles, "  ", $nombreUsuario;

    if (empty($nombreUsuario) || empty($email)) {
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
        $query = "UPDATE usuarios SET nombre='$nombreUsuario', correo='$email', rol = '$roles' WHERE id = '$id' ";
        echo $query;
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
            header("Location: usuarios.php");
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
                    Actualizar Usuario
                </label>
                <form action="editar_usuario.php?id=<?php echo $_GET['id']; ?>" method="POST" class="mt-10 ">

                    <div class="form-control">
                        <input value="<?php echo $nombre ?>" type="text" placeholder="Nombre" name="nombreUsuario" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>

                    <div class="form-control">
                        <input value="<?php echo $correo ?>" type="email" placeholder="Correo" name="email" class="input input-bordered mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg  focus:ring-0">
                    </div>
                    <?php
                    $query_cambiar_rol = mysqli_query($connection, "SELECT * FROM roles");
                    $resultado_cambiar_rol = mysqli_num_rows($query_cambiar_rol);

                    ?>
                    <select name="rol" class="select select-bordered w-full mt-1">
                        <option disabled="disabled" selected="selected">Rol</option>

                        <?php
                        if ($resultado_cambiar_rol > 0) {
                            while ($rol = mysqli_fetch_array($query_cambiar_rol)) {
                        ?>
                                <option value="<?php echo $rol['id'] ?>"><?php echo $rol['rol'] ?></option>
                        <?php
                            }
                        }
                        ?>
                    </select>


                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7 ">
                        <input type="submit" name="update" value="Actualizar Usuario" class="w-full btn btn-primary  text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">

                    </div>



                </form>
                <a href="usuarios.php" class="btn btn-secundary w-full mt-2 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Volver
                </a>



            </div>
        </div>
    </div>

</body>

</html>