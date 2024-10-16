<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['dni'])) {
    include_once 'db.php';
    $database = new Database();
    $db = $database->getConnection();

    $persona = new Persona($db);
    $persona->dni = $_GET['dni'];

    if ($persona->delete()) {
        header("Location: index.php?message=deleted");
    } else {
        header("Location: index.php?message=error");
    }
}
