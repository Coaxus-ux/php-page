<?php include "link.php";
?>

<div>
    <div class="antialiased">
        <div class="w-full text-gray-700 dark-mode:text-gray-200 dark-mode:bg-gray-800 ">
            <div x-data="{ open: true }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                <div class="flex flex-row items-center justify-between p-4">
                    <a href="admin.php" class="text-lg font-semibold tracking-widest text-white uppercase rounded-lg  focus:outline-none focus:shadow-outline">Inventarios PHP - ADMIN</a>
                    <button class="rounded-lg md:hidden focus:outline-none focus:shadow-outline " @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:bg-secondary focus:text-gray-900 hover:bg-secondary focus:bg-secondary focus:outline-none focus:shadow-outline text-white hover:text-black" href="productos.php">Productos</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:bg-secondary focus:text-gray-900 hover:bg-secondary focus:bg-secondary focus:outline-none focus:shadow-outline text-white hover:text-black" href="#">Usuarios</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:bg-secondary focus:text-gray-900 hover:bg-secondary focus:bg-secondary focus:outline-none focus:shadow-outline text-white hover:text-black" href="#">Movimientos</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:bg-secondary focus:text-gray-900 hover:bg-secondary focus:bg-secondary focus:outline-none focus:shadow-outline text-white hover:text-black" href="#">Categorias</a>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg md:mt-0 md:ml-4 hover:bg-secondary focus:text-gray-900 hover:bg-secondary focus:bg-secondary focus:outline-none focus:shadow-outline text-white hover:text-black" href="salir.php">Salir</a>
                    
                </nav>
            </div>
        </div>
    </div>
</div>
