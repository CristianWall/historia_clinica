<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/logo.png" /> <!-- Cambié la ruta aquí -->

    <title>CLINIC</title>
    <!-- Enlace a Tailwind CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Estilos adicionales si es necesario */
        #sidebar {
            transition: transform 0.3s ease;
        }

        #sidebar.closed {
            transform: translateX(-100%);
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="h-20 bg-gray-800 p-4 fixed top-0 left-0 w-full flex items-center">
        <button id="openSidebar" class="h-full">
            <img class="h-full" src="assets/menu_icon.png" alt="Menú">
        </button>
        <div class="h-full">
            <img class="h-full" src="assets/clinic_logo.png" alt="Logo Clínica">
        </div>
    </nav>

    <!-- Sidebar -->
    <div id="sidebar" class=" flex flex-col sidebar bg-gray-600 text-white fixed left-0 top-0 h-full w-64 transform -translate-x-full ">
        <div class=" relative w-full bg-gray-800 p-4  items-center flex flex-col pt-4 ">
        <img class="w-full mt-10" src="assets/clinic_logo.png" alt="Logo Clínica">

            <button id="closeSidebar" class="absolute top-4 right-4 text-white rounded-full hover:bg-blue-700 font-bold"><img class="h-8" src="assets/close_icon.png" alt=""></button>

        </div>
        <div class="flex flex-col w-full p-3 space-y-4 flex-grow overflow-y-auto h-full text-lg ">
            <a href="http://localhost/funciona/index.php?" class=" font-semibold px-3  mx-3 rounded-3xl hover:bg-white hover:text-black text-white text-center bg-gray-700">Pacientes</a>

        </div>
        <button class='justify-self-end bg-black p-3 rounded-md text-white m-2 '>Salir / Cerrar Sesión</button>

    </div>

    <!-- Contenido Principal -->
    <div class="m-5 ">
        <!-- Incluimos la tabla -->
        <?php include('home_page.php'); ?>
    </div>

    <!-- Script para abrir y cerrar el Sidebar -->
    <script>
        const openSidebarBtn = document.getElementById('openSidebar');
        const closeSidebarBtn = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');

        openSidebarBtn.addEventListener('click', () => {
            sidebar.classList.remove('transform', '-translate-x-full');
        });

        closeSidebarBtn.addEventListener('click', () => {
            sidebar.classList.add('transform', '-translate-x-full');
        });
    </script>
</body>

</html>