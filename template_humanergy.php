<?php
// This file is a template for the Humanergy certificate.
// It expects a $certificate variable to be available with the certificate data.

// Format dates for display
$start_date_formatted = date("d F Y", strtotime($certificate['fecha_inicio']));
$end_date_formatted = date("d F Y", strtotime($certificate['fecha_fin']));
$recognition_date = date("F Y", strtotime($certificate['fecha_inicio']));
$recognition_text = "In recognition of their amazing performance and great efforts during the month of " . $recognition_date . ".";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificación en Ciencia de Datos - Humanergy</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="certificate-container">
        <div class="certificate">
            <!-- Banda azul derecha -->
            <div class="blue-band"></div>

            <!-- Header con logo Humanergy -->
            <header class="certificate-header">
                <img src="images/logo-humanergy.png" alt="Humanergy" class="logo">
            </header>

            <!-- Título del certificado -->
            <div class="certificate-title">
                <h1>CERTIFICACIÓN</h1>
                <h2 class="subtitle">EN CIENCIA DE DATOS</h2>
            </div>

            <!-- Nombre del participante -->
            <div class="recipient-name">
                <h3 id="recipient-name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></h3>
                <div class="underline"></div>
            </div>

            <!-- Texto de reconocimiento -->
            <div class="recognition-text">
                <p id="recognition-text"><?php echo $recognition_text; ?></p>
            </div>

            <!-- Footer con información -->
            <div class="certificate-footer">
                <div class="footer-content">
                    <div class="left-info">
                        <p class="validity">Vigencia: <span id="start-date"><?php echo $start_date_formatted; ?></span> a <span id="end-date"><?php echo $end_date_formatted; ?></span></p>
                    </div>

                    <div class="center-seal">
                        <img src="images/sello-humanergy.png" alt="Sello Humanergy" class="official-seal">
                    </div>

                    <div class="right-info">
                        <p class="program">Programa de certificación <span id="program-name">HMNGY</span></p>
                    </div>
                </div>
            </div>

            <!-- QR Code -->
            <div class="qr-section">
                <div class="qr-dummy">
                    <?php
                    $qr_image_to_display = 'images/qr/' . $certificate['id'] . '.jpg';
                    if (file_exists($qr_image_to_display)) {
                        echo '<img src="' . $qr_image_to_display . '" alt="QR Code" style="width: 100%; height: 100%;">';
                    } else {
                        // Display the placeholder if the QR code has not been generated yet
                        echo '<!-- Aquí irá el QR Code --><div class="qr-placeholder"></div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="js/certificate.js"></script>
</body>
</html>
