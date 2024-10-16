<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Persona</title>
    <link
        href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
        rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Crear Persona</h1>
        <form action="create.php" method="post" class="bg-white p-6 rounded shadow-md">
            <label for="dni" class="block">DNI:</label>
            <input type="text" id="dni" name="dni" class="border p-2 w-full mb-4" required>
            <label for="nombres" class="block">Nombres:</label>
            <input type="text" id="nombres" name="nombres" class="border p-2 w-full mb-4" required>

            <label for="apellidopa" class="block">Apellido Paterno:</label>
            <input type="text" id="apellidopa" name="apellidopa" class="border p-2 w-full mb-4" required>

            <label for="apellidoma" class="block">Apellido Materno:</label>
            <input type="text" id="apellidoma" name="apellidoma" class="border p-2 w-full mb-4" required>

            <label for="nombrepa" class="block">Nombre del Padre:</label>
            <input type="text" id="nombrepa" name="nombrepa" class="border p-2 w-full mb-4">

            <label for="nombrema" class="block">Nombre de la Madre:</label>
            <input type="text" id="nombrema" name="nombrema" class="border p-2 w-full mb-4">

            <label for="nacionalidad" class="block">Nacionalidad:</label>
            <input type="text" id="nacionalidad" name="nacionalidad" class="border p-2 w-full mb-4">

            <label for="sexo" class="block">Sexo:</label>
            <select id="sexo" name="sexo" class="border p-2 w-full mb-4" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>

            <label for="fechanac" class="block">Fecha de Nacimiento:</label>
            <input type="date" id="fechanac" name="fechanac" class="border p-2 w-full mb-4" required>

            <label for="lugarnac" class="block">Lugar de Nacimiento:</label>
            <input type="text" id="lugarnac" name="lugarnac" class="border p-2 w-full mb-4" required>

            <label for="lugarresi" class="block">Lugar de Residencia:</label>
            <input type="text" id="lugarresi" name="lugarresi" class="border p-2 w-full mb-4" required>

            <h2 class="text-2xl font-bold mb-4">Selecciona tu Ubicación</h2>

            <div class="mb-4"> <label for="departamento" class="block text-gray-700">Departamento</label> <select id="departamento" name="departamento" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Seleccione un departamento</option>
                </select> </div>
            <div class="mb-4"> <label for="provincia" class="block text-gray-700">Provincia</label> <select id="provincia" name="provincia" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Seleccione una provincia</option>
                </select> </div>
            <div class="mb-4"> <label for="distrito" class="block text-gray-700">Distrito</label> <select id="distrito" name="distrito" class="w-full mt-1 p-2 border border-gray-300 rounded-md">
                    <option value="">Seleccione un distrito</option>
                </select> </div>


            <label for="direccion" class="block">Dirección:</label>
            <input type="text" id="direccion" name="direccion" class="border p-2 w-full mb-4" required>

            <label for="gradoins" class="block">Grado de Instrucción:</label>
            <input type="text" id="gradoins" name="gradoins" class="border p-2 w-full mb-4" required>

            <label for="estadoci" class="block">Estado Civil:</label>
            <select id="estadoci" name="estadoci" class="border p-2 w-full mb-4">
                <option value="Soltero">Soltero</option>
                <option value="Casado">Casado</option>
                <option value="Divorciado">Divorciado</option>
            </select>

            <label for="ocupacion" class="block">Ocupación:</label>
            <input type="text" id="ocupacion" name="ocupacion" class="border p-2 w-full mb-4" required>

            <label for="religion" class="block">Religión:</label>
            <select id="religion" name="religion" class="border p-2 w-full mb-4">
                <option value="Ateo">Ateo</option>
                <option value="Cristiano">Cristiano</option>
                <option value="Catolico">Católico</option>
                <option value="Islámico">Islámico</option>
            </select>

            <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear</button>
            </form>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        include_once 'db.php';
        $database = new Database();
        $db = $database->getConnection();
        $persona = new Persona($db);
        $persona->dni = $_POST['dni'];
        $persona->nombres = $_POST['nombres'];
        $persona->apellidopa = $_POST['apellidopa'];
        $persona->apellidoma = $_POST['apellidoma'];
        $persona->nombrepa = $_POST['nombrepa'];
        $persona->nombrema = $_POST['nombrema'];
        $persona->nacionalidad = $_POST['nacionalidad'];
        $persona->sexo = $_POST['sexo'];
        $persona->fechanac = $_POST['fechanac'];
        $persona->lugarnac = $_POST['lugarnac'];
        $persona->lugarresi = $_POST['lugarresi'];
        $persona->departamento = $_POST['departamento'];
        $persona->provincia = $_POST['provincia'];
        $persona->distrito = $_POST['distrito'];
        $persona->direccion = $_POST['direccion'];
        $persona->gradoins = $_POST['gradoins'];
        $persona->estadoci = $_POST['estadoci'];
        $persona->ocupacion = $_POST['ocupacion'];
        $persona->religion = $_POST['religion'];
        if ($persona->create()) {
            echo "Mensaje de prueba";
            header("Location: index.php?message=created");
            echo "Mensaje de prueba 2";
            exit();
        } else {
            echo "<div class='mt-4 p-2 bg-red-500 text-white'>No se pudo crear la persona.</div>";
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="historiaclinica.js"></script>
</body>

</html>