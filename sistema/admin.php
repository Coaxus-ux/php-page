<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../login.php');
}
if($_SESSION['rol'] != 1){
    header('location: home.php');
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
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    ADMIN PANEL
                </label>
                <a href="productos.php" class="btn btn-primary w-full mt-4">
                    Productos
                </a>
                <a href="#" class="btn btn-primary w-full mt-4">
                    Movimientos
                </a>
                <a href="#" class="btn btn-primary w-full mt-4">
                    Categorias
                </a>
                <a href="#" class="btn btn-primary w-full mt-4">
                    Usuarios
                </a>
                <a href="salir.php" class="btn btn-accent w-full mt-4">
                    Salir
                </a>
            </div>
        </div>
    </div>
</body>

</html>