<?php
include_once 'db.php';
$database = new Database();
$db = $database->getConnection();

$persona = new Persona($db);
$search = isset($_GET['search']) ? $_GET['search'] : "";
$filter1 = isset($_GET['filter1']) ? $_GET['filter1'] : "";
$filter2 = isset($_GET['filter2']) ? $_GET['filter2'] : "";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;
$start = ($page - 1) * $limit;

// Consulta para obtener los registros
$query = "SELECT * FROM personas WHERE nombres LIKE ? LIMIT ?, ?";
$stmt = $db->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param("sii", $searchTerm, $start, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Consulta para contar el número total de registros
$countQuery = "SELECT COUNT(*) as total FROM personas WHERE nombres LIKE ?";
$stmtCount = $db->prepare($countQuery);
$stmtCount->bind_param("s", $searchTerm);
$stmtCount->execute();
$countResult = $stmtCount->get_result();
$total_records = $countResult->fetch_assoc()['total'];

$total_pages = ceil($total_records / $limit);
?>

<div class="container mx-auto mt-24">
    <h1 class="text-2xl font-bold mb-4">Listado de Personas</h1>
    <div class="mb-4">
        <a href="create.php" class="bg-green-500 text-white px-4 py-2 rounded">Crear Persona</a>
    </div>

    <form method="GET" action="index.php" class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-2 w-full">
        <!-- Input de búsqueda -->
        <input type="text" name="search" placeholder="Buscar..." class="p-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 w-full" id="searchInput" value="<?php echo htmlspecialchars($search); ?>">

        <!-- Botón de Filtros -->
        <button type="button" id="filterBtn" class="p-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            Filtros
        </button>

        <!-- Menú Desplegable de Filtros -->
        <div id="filterMenu" class="filter-menu absolute top-16 right-0 bg-white border border-gray-300 rounded-md shadow-md w-48 z-10 hidden">
            <ul class="space-y-2 p-2">
                <li>
                    <label for="filter1" class="text-gray-700">Filtro 1</label>
                    <select name="filter1" id="filter1" class="w-full p-1 border border-gray-300 rounded-md">
                        <option value="">Selecciona...</option>
                        <option value="option1" <?php echo ($filter1 == "option1") ? "selected" : ""; ?>>Opción 1</option>
                        <option value="option2" <?php echo ($filter1 == "option2") ? "selected" : ""; ?>>Opción 2</option>
                        <option value="option3" <?php echo ($filter1 == "option3") ? "selected" : ""; ?>>Opción 3</option>
                    </select>
                </li>
                <li>
                    <label for="filter2" class="text-gray-700">Filtro 2</label>
                    <select name="filter2" id="filter2" class="w-full p-1 border border-gray-300 rounded-md">
                        <option value="">Selecciona...</option>
                        <option value="option1" <?php echo ($filter2 == "option1") ? "selected" : ""; ?>>Opción 1</option>
                        <option value="option2" <?php echo ($filter2 == "option2") ? "selected" : ""; ?>>Opción 2</option>
                        <option value="option3" <?php echo ($filter2 == "option3") ? "selected" : ""; ?>>Opción 3</option>
                    </select>
                </li>
            </ul>
        </div>
    </form>

    <!-- Script para abrir/cerrar el menú desplegable -->
    <script>
        const filterBtn = document.getElementById('filterBtn');
        const filterMenu = document.getElementById('filterMenu');

        // Al hacer clic en el botón de filtros, alterna la visibilidad del menú desplegable
        filterBtn.addEventListener('click', () => {
            filterMenu.classList.toggle('hidden');
        });

        // Para ocultar el menú si se hace clic fuera de él
        document.addEventListener('click', (event) => {
            if (!filterBtn.contains(event.target) && !filterMenu.contains(event.target)) {
                filterMenu.classList.add('hidden');
            }
        });
    </script>

    <!-- Contenedor para la tabla con desplazamiento -->
    <div class='overflow-x-auto'>
        <table class='min-w-full bg-white'>
            <thead>
                <tr>
                    <th class='py-2 px-4 border-b'>DNI</th>
                    <th class='py-2 px-4 border-b'>Nombres</th>
                    <th class='py-2 px-4 border-b'>Apellido Paterno</th>
                    <th class='py-2 px-4 border-b'>Apellido Materno</th>
                    <th class='py-2 px-4 border-b'>Nombre Padre</th>
                    <th class='py-2 px-4 border-b'>Nombre Madre</th>
                    <th class='py-2 px-4 border-b'>Nacionalidad</th>
                    <th class='py-2 px-4 border-b'>Sexo</th>
                    <th class='py-2 px-4 border-b'>Fecha de Nacimiento</th>
                    <th class='py-2 px-4 border-b'>Lugar de Nacimiento</th>
                    <th class='py-2 px-4 border-b'>Lugar de Residencia</th>
                    <th class='py-2 px-4 border-b'>Dirección</th>
                    <th class='py-2 px-4 border-b'>Grado de Instrucción</th>
                    <th class='py-2 px-4 border-b'>Estado Civil</th>
                    <th class='py-2 px-4 border-b'>Ocupación</th>
                    <th class='py-2 px-4 border-b'>Religión</th>
                    <th class='py-2 px-4 border-b'>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td class='py-2 px-4 border-b'>{$row['dni']}</td>
                        <td class='py-2 px-4 border-b'>{$row['nombres']}</td>
                        <td class='py-2 px-4 border-b'>{$row['apellidopa']}</td>
                        <td class='py-2 px-4 border-b'>{$row['apellidoma']}</td>
                        <td class='py-2 px-4 border-b'>{$row['nombrepa']}</td>
                        <td class='py-2 px-4 border-b'>{$row['nombrema']}</td>
                        <td class='py-2 px-4 border-b'>{$row['nacionalidad']}</td>
                        <td class='py-2 px-4 border-b'>{$row['sexo']}</td>
                        <td class='py-2 px-4 border-b'>{$row['fechanac']}</td>
                        <td class='py-2 px-4 border-b'>{$row['lugarnac']}</td>
                        <td class='py-2 px-4 border-b'>{$row['lugarresi']}</td>
                        <td class='py-2 px-4 border-b'>{$row['direccion']}</td>
                        <td class='py-2 px-4 border-b'>{$row['gradoins']}</td>
                        <td class='py-2 px-4 border-b'>{$row['estadoci']}</td>
                        <td class='py-2 px-4 border-b'>{$row['ocupacion']}</td>
                        <td class='py-2 px-4 border-b'>{$row['religion']}</td>
                        <td class='py-2 px-4 border-b'>
                            <a href='update.php?dni={$row['dni']}' class='text-blue-500'>Editar</a> |
                            <a href='delete.php?dni={$row['dni']}' class='text-red-500' onclick='return confirm(\"¿Estás seguro?\")'>Eliminar</a> |
                            <a href='generate_pdf.php?dni={$row['dni']}' class='text-green-500' target='_blank'>Generar PDF</a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class='mt-4'>
        <?php
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='index.php?page=$i&search=$search&filter1=$filter1&filter2=$filter2' class='bg-blue-500 text-white px-3 py-2 rounded m-1'>$i</a>";
        }
        ?>
    </div>
</div>
