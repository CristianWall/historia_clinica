<!-- Archivo: ver_pdf.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF en 2/3 del Navegador</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .container {
            display: flex;
            height: 100%;
        }
        .pdf-section {
            width: 66.66%; /* 2/3 del ancho de la página */
            height: 100%;
        }
        .side-section {
            width: 33.33%; /* 1/3 del ancho de la página */
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Sección para mostrar el PDF -->
    <div class="pdf-section">
        <iframe src="personas.pdf" style="width:100%; height:100%;" frameborder="0"></iframe>
    </div>

    <!-- Sección lateral (1/3 del navegador), puede tener contenido adicional -->
    <div class="side-section">
        <h2>Información Adicional</h2>
        <p>Aquí puedes mostrar otras cosas como enlaces, información, etc.</p>
    </div>
</div>

</body>
</html>
