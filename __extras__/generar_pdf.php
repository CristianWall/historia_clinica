<?php
// Archivo: generar_pdf.php
require('fpdf/fpdf.php');
require_once 'db.php';

// Crear una instancia de la clase Database
$database = new Database();
$db = $database->getConnection();

// Crear una instancia de la clase Persona
$persona = new Persona($db);

// Crear una instancia de FPDF
$pdf = new \FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Lista de Personas', 0, 1, 'C');
$pdf->Ln(10);

// Configuración de columnas
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'DNI', 1);
$pdf->Cell(40, 10, 'Nombres', 1);
$pdf->Cell(40, 10, 'Apellido Paterno', 1);
$pdf->Cell(40, 10, 'Apellido Materno', 1);
$pdf->Cell(50, 10, 'Nacionalidad', 1);
$pdf->Ln();

// Consultar la base de datos
$result = $persona->read();

// Agregar datos al PDF
$pdf->SetFont('Arial', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['dni'], 1);
    $pdf->Cell(40, 10, $row['nombres'], 1);
    $pdf->Cell(40, 10, $row['apellidopa'], 1);
    $pdf->Cell(40, 10, $row['apellidoma'], 1);
    $pdf->Cell(50, 10, $row['nacionalidad'], 1);
    $pdf->Ln();
}

// Generar y guardar el PDF en el servidor
$pdf->Output('F', 'personas.pdf');  // Guarda el PDF en el servidor

// Redirigir a la página de visualización del PDF
header('Location: ver.php');
?>
