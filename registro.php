<?php
$alert = false;
$mensaje = '';
if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['nombre']) || empty($_POST['contra']) || empty($_POST['contraVerificada'])) {
        $alert = true;
        $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Uno o mas datos faltan.</label>
            </div>
            </div>';
    } else {
        if ($_POST['contra'] != $_POST['contraVerificada']) {
            $alert = true;
            $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Las contraseñas no son iguales</label>
            </div>
            </div>';
        } else {
            $alert = false;
            include "connection.php";
            $nombre = $_POST['nombre'];
            $email = $_POST['usuario'];
            $password = md5($_POST['contra']);

            $query = mysqli_query($connection, "SELECT * FROM usuarios WHERE correo = '$email'");
            $result = mysqli_fetch_array($query);
            if ($result > 0) {
                $alert = true;
                $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>El correo ya exite en la base de datos.</label>
            </div>
            </div>';
            } else {
                $query_insert = mysqli_query($connection, "INSERT INTO usuarios(nombre, correo, contra, productos, rol, descripcion) VALUES('$nombre', '$email', '$password', '0', '2', '')");
                if ($query_insert) {
                    $alert = true;
                    $mensaje = '<div class="alert my-2">
                    <div class="flex-1">
                      <label class="mx-3">Se registro con exito, ya puede iniciar seccion</label>
                    </div> 
                    <div class="flex-none">
                      <a href="login.php" class="btn btn-sm btn-primary">Login</a>
                    </div>
                  </div>
                  ';
                } else {
                    $alert = true;
                    $mensaje = '<div class="alert my-2 ">
                        <div class="flex-1 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                        <label>Registro fallo.</label>
                        </div>
                    </div>';
                }
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "./sistema/includes/link.php" ?>
    <title>Inventarios-Registro</title>
</head>

<body>
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    Registro
                </label>
                <form action="" method="post" class="mt-10">

                    <div>
                        <input type="email" name="usuario" placeholder="Correo electronico" class="input input-ghost mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>
                    <div class="mt-7">
                        <input type="text" name="nombre" placeholder="Nombre Completo" class="input input-ghost mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>
                    <div class="mt-7">
                        <input type="password" placeholder="Contraseña" name="contra" class="input input-ghost mt-1 block w-full  bg-gray-100 h-11  shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>
                    <div class="mt-7">
                        <input type="password" placeholder="Repita su contraseña" name="contraVerificada" class="input input-ghost mt-1 block w-full  bg-gray-100 h-11  shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>


                    <div class="mt-7 flex">
                        <label for="remember_me" class="inline-flex items-center w-full cursor-pointer">
                            <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="terminos">
                            <span class="ml-2 text-sm text-gray-600">
                                Acepto terminos y condiciones
                            </span>
                        </label>

                        <div class="w-full text-right">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                                Terminos y condiciones
                            </a>
                        </div>
                    </div>

                    <div class="mt-7 ">
                        <button type="submit" value="Login" class="w-full btn btn-primary py-3 text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Registro
                        </button>

                    </div>

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>
                    <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <label class="mr-2 text-black">¿Ya tienes una cuenta?</label>
                            <a href="login.php" class="btn btn-secondary">
                                Inicio seccion
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>