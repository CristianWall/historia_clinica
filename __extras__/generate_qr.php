<?php
require('phpqrcode/qrlib.php');
require_once 'db.php';
function generarQRCode($dni) {
    // Verifica que el DNI tenga 8 dígitos
    if (strlen($dni) == 8 && ctype_digit($dni)) {
        // Establece la ruta del archivo QR
        $rutaArchivoQR = 'qr_codes/qr_' . $dni . '.png';

        // Genera el código QR
        QRcode::png($dni, $rutaArchivoQR, QR_ECLEVEL_L, 4);
        
        // Retorna la ruta del archivo QR
        return $rutaArchivoQR;
    } else {
        return "El DNI debe tener exactamente 8 dígitos.";
    }
}

// Ejemplo de uso
$dni = "12345678"; // Cambia esto por el DNI que desees
$rutaQR = generarQRCode($dni);

if (file_exists($rutaQR)) {
    echo "<img src='$rutaQR' alt='Código QR para DNI: $dni' />";
} else {
    echo $rutaQR; // Mensaje de error si no se pudo generar el QR
}
?>
