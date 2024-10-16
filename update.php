<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Persona</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Actualizar Persona</h1>

        <?php
        include_once 'db.php';
        $database = new Database();
        $db = $database->getConnection();

        $persona = new Persona($db);

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['dni'])) {
            $persona->dni = $_GET['dni'];
            $result = $persona->read($_GET['dni'], 0, 1);
            $row = $result->fetch_assoc();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            // Asignar todos los atributos de la clase Persona
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
            $persona->direccion = $_POST['direccion'];
            $persona->gradoins = $_POST['gradoins'];
            $persona->estadoci = $_POST['estadoci'];
            $persona->ocupacion = $_POST['ocupacion'];
            $persona->religion = $_POST['religion'];

            if ($persona->update()) {
                echo "<div class='mt-4 p-2 bg-green-500 text-white'>Persona actualizada exitosamente.</div>";
                header("Location: index.php?message=updated");
                exit();
            } else {
                echo "<div class='mt-4 p-2 bg-red-500 text-white'>No se pudo actualizar la persona.</div>";
            }
        }
        ?>

        <form action="update.php" method="post" class="bg-white p-6 rounded shadow-md">
            <input type="hidden" id="dni" name="dni" value="<?php echo isset($row['dni']) ? $row['dni'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="nombres" class="block">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="<?php echo isset($row['nombres']) ? $row['nombres'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="apellidopa" class="block">Apellido Paterno:</label>
            <input type="text" id="apellidopa" name="apellidopa" value="<?php echo isset($row['apellidopa']) ? $row['apellidopa'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="apellidoma" class="block">Apellido Materno:</label>
            <input type="text" id="apellidoma" name="apellidoma" value="<?php echo isset($row['apellidoma']) ? $row['apellidoma'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="nombrepa" class="block">Nombre Padre:</label>
            <input type="text" id="nombrepa" name="nombrepa" value="<?php echo isset($row['nombrepa']) ? $row['nombrepa'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="nombrema" class="block">Nombre Madre:</label>
            <input type="text" id="nombrema" name="nombrema" value="<?php echo isset($row['nombrema']) ? $row['nombrema'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="nacionalidad" class="block">Nacionalidad:</label>
            <input type="text" id="nacionalidad" name="nacionalidad" value="<?php echo isset($row['nacionalidad']) ? $row['nacionalidad'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="sexo" class="block">Sexo:</label>
            <input type="text" id="sexo" name="sexo" value="<?php echo isset($row['sexo']) ? $row['sexo'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="fechanac" class="block">Fecha de Nacimiento:</label>
            <input type="date" id="fechanac" name="fechanac" value="<?php echo isset($row['fechanac']) ? $row['fechanac'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="lugarnac" class="block">Lugar de Nacimiento:</label>
            <input type="text" id="lugarnac" name="lugarnac" value="<?php echo isset($row['lugarnac']) ? $row['lugarnac'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="lugarresi" class="block">Lugar de Residencia:</label>
            <input type="text" id="lugarresi" name="lugarresi" value="<?php echo isset($row['lugarresi']) ? $row['lugarresi'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="direccion" class="block">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo isset($row['direccion']) ? $row['direccion'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="gradoins" class="block">Grado de Instrucción:</label>
            <input type="text" id="gradoins" name="gradoins" value="<?php echo isset($row['gradoins']) ? $row['gradoins'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="estadoci" class="block">Estado Civil:</label>
            <input type="text" id="estadoci" name="estadoci" value="<?php echo isset($row['estadoci']) ? $row['estadoci'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="ocupacion" class="block">Ocupación:</label>
            <input type="text" id="ocupacion" name="ocupacion" value="<?php echo isset($row['ocupacion']) ? $row['ocupacion'] : ''; ?>" class="border p-2 w-full mb-4">

            <label for="religion" class="block">Religión:</label>
            <input type="text" id="religion" name="religion" value="<?php echo isset($row['religion']) ? $row['religion'] : ''; ?>" class="border p-2 w-full mb-4">

            <button type="submit" name="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        </form>
    </div>
</body>

</html>
