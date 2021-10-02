<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../../login.php');
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="dracula">

<head>
    <?php include "../includes/link.php" ?>
</head>


<body>
    <div class="relative min-h-screen flex flex-col sm:justify-center items-center ">
        <div class="relative sm:max-w-sm w-full">
            <div class="card bg-blue-400 shadow-lg  w-full h-full rounded-3xl absolute  transform -rotate-6"></div>
            <div class="card bg-red-400 shadow-lg  w-full h-full rounded-3xl absolute  transform rotate-6"></div>
            <div class="relative w-full rounded-3xl  px-6 py-4 bg-gray-100 shadow-md">
                <label for="" class="block mt-3 text-sm text-gray-700 text-center font-semibold">
                    USER PANEL
                </label>
                <a href="../productos.php" class="btn btn-primary w-full mt-4 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Mis productos
                </a>
                <div class="dropdown dropdown-right w-full">
                    <div tabindex="0" class="btn btn-primary w-full mt-4 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">Generar Movimiento</div>
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-200 rounded-box w-52">
                        <li>
                            <a href="../agregarProductos.php">Compra</a>
                        </li>
                        <li>
                            <a href="../venta.php">Venta</a>
                        </li>
                    </ul>
                </div>
                <a href="../movimientos.php" class="btn btn-primary w-full mt-4 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Mis movimiento
                </a>
                <a href="mi_cuenta.php" class="btn btn-primary w-full mt-4 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Mi cuenta
                </a>
                
                <a href="../salir.php" class="btn btn-accent w-full mt-4 hover:shadow-inner focus:outline-none transition duration-500 ease-in-out  transform hover:-translate-x hover:scale-105">
                    Salir
                </a>
            </div>
        </div>
    </div>
</body>

</html>