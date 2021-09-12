<?php
$alert = false;
$mensaje = '';
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema/home.php');
} else {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['contra'])) {
            $alert = true;
            $mensaje = '<div class="alert my-2">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Los campos estan vacios</label>
            </div>
            </div>';
        } else {
            require_once "connection.php";
            $user = mysqli_real_escape_string($connection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($connection, $_POST['contra'])); 
            $query = mysqli_query($connection, "SELECT * FROM usuarios WHERE correo='$user' AND contra = '$pass'");

            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                
                $_SESSION['active'] = true;
                $_SESSION['id'] = $data['id'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['correo'] = $data['correo'];
                $_SESSION['productos'] = $data['productos'];
                $_SESSION['rol'] = $data['rol'];
                if($data['rol'] == 1){
                    header('location: sistema/admin.php');
                }else{
                    header('location: sistema/home.php');
                    
                }
                
            } else {
                $alert = true;
                $mensaje = '<div class="alert my-2 ">
            <div class="flex-1 ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#ff5722" class="w-6 h-6 mx-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                </svg>
                <label>Valores incorrectos</label>
            </div>
            </div>';
                session_destroy();
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
    <?php include "./sistema/includes/link.php"?>
    <title>Inventarios-Login</title>
</head>

<body>
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    Inicio de sección
                </label>
                <form action="" method="post" class="mt-10">

                    <div>
                        <input type="text" name="usuario" placeholder="Correo electronico" class="input input-ghost mt-1 block w-full border-none bg-gray-100 h-11 rounded-xl shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>

                    <div class="mt-7">
                        <input type="password" placeholder="Contraseña" name="contra" class="input input-ghost mt-1 block w-full  bg-gray-100 h-11  shadow-lg hover:bg-blue-100 focus:bg-blue-100 focus:ring-0">
                    </div>

                    <div class="mt-7 flex">
                        <label for="remember_me" class="inline-flex items-center w-full cursor-pointer">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">
                                Recuerdame
                            </span>
                        </label>

                        <div class="w-full text-right">
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="#">
                                ¿Olvidó su contraseña?
                            </a>
                        </div>
                    </div>

                    <div class="mt-7 ">
                        <button type="submit" value="Login" class="w-full btn btn-primary py-3 text-white shadow-xl hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                            Login
                        </button>

                    </div>

                    <?php
                    echo $alert ? $mensaje
                        : '';
                    ?>



                    <div class="flex mt-7 items-center text-center">
                        <hr class="border-gray-300 border-1 w-full rounded-md">
                        <label class="block  font-medium text-sm text-gray-600 w-full">
                            Accede con
                        </label>
                        <hr class="border-gray-300 border-1 w-full rounded-md">
                    </div>

                    <div class="flex mt-7 justify-center w-full">
                        <div data-tip="Tu empresa te dio un id unico con el cual puedes ingresar" class="tooltip tooltip-secondary">
                            <button class="btn btn-secondary mr-2">
                                ID unico
                            </button>
                        </div>

                        <div data-tip="Se te enviara un mensaje de texto con tu credenciales" class="tooltip tooltip-accent">
                            <button class="btn btn-accent">
                                SMS
                            </button>
                        </div>

                    </div>

                    <div class="mt-7">
                        <div class="flex justify-center items-center">
                            <label class="mr-2 text-black">¿Eres nuevo?</label>
                            <a href="registro.php" class="btn btn-secondary">
                                Crea una cuenta
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>