<?php
require('fpdf/fpdf.php');
include_once 'db.php';
require('phpqrcode/qrlib.php'); // Asegúrate de incluir la biblioteca QR

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Información de la Persona'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Página ') . $this->PageNo(), 0, 0, 'C');
    }

    function PersonaInfo($row)
    {
        $this->SetFont('Arial', '', 12);
        foreach ($row as $key => $value) {
            $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', ucfirst($key) . ': ' . $value), 0, 1);
        }
    }
}

function generarQR($dni)
{
    $contenido = "DNI: " . $dni; // Contenido del QR
    $rutaQR = 'qrs/' . $dni . '.png'; // Ruta donde se guardará el QR
    QRcode::png($contenido, $rutaQR, QR_ECLEVEL_L, 4); // Genera el QR
    return $rutaQR; // Retorna la ruta del QR
}

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];

    // Crear la carpeta qrs si no existe
    if (!file_exists('qrs')) {
        mkdir('qrs', 0777, true);
    }

    // Obtener datos de la persona con el DNI
    $database = new Database();
    $db = $database->getConnection();
    $persona = new Persona($db);
    $result = $persona->readOne($dni); // Método que retorna los datos de una persona específica

    if ($result) {
        // Generar QR
        $qrPath = generarQR($dni);
        if (!$qrPath) {
            echo "Error al generar el código QR.";
            exit;
        }

        // Crear el PDF
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->PersonaInfo($result); // Llenar el PDF con la información de la persona

        // Ajustar la posición del QR (arriba a la derecha, 50x50 px)
        $pdf->Image($qrPath, 160, 10, 50, 50); // Ajusta la posición y tamaño según sea necesario

        // Salida del PDF
        $pdf->Output('I', 'informacion_persona.pdf'); // Mostrar el PDF en el navegador
    } else {
        echo "No se encontraron datos para el DNI: $dni";
    }
} else {
    echo "DNI no proporcionado.";
}
?>
