<?php
// This file is the new template for the GCI-1 certificate.
// It expects a $certificate variable to be available with the certificate data.

// Format the end date
$end_date_formatted = date("F j, Y", strtotime($certificate['fecha_fin']));
// The header date seems static in the design, but we can make it dynamic if needed
$header_date_formatted = date("n/j/y, g:i a");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado SAP MM-11 | <?php echo htmlspecialchars($certificate['nombre_completo']); ?></title>
    <link rel="stylesheet" href="certificado.css">
</head>
<body>
    <div class="certificate-container">
        <!-- Header -->
        <div class="header">
            <div class="header-left"><?php echo $header_date_formatted; ?></div>
            <div class="header-right">Iberoamericano MM-11 Certificado</div>
        </div>

        <!-- Logo and Institute Name -->
        <div class="logo-section">
            <div class="logo-placeholder">
                LOGO
            </div>
            <div class="institute-name">GLOBAL</div>
            <div class="certification-text">CERTIFICATION</div>
            <div class="institute-text">INSTITUTE</div>
        </div>

        <!-- Course Title -->
        <div class="course-title">
            Iberoamericano MM-11 Certificado | <?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>
        </div>

        <!-- Certification Section -->
        <div class="certify-section">
            <div class="certify-text">THIS IS TO CERTIFY THAT</div>
            <div class="recipient-name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></div>
        </div>

        <!-- Description -->
        <div class="description">
            Tras haber completado con éxito una rigurosa evaluación de competencia profesional y haber demostrado la capacidad de obtener resultados ejemplares, se otorga esta certificación en reconocimiento a su destacado desempeño.
        </div>

        <!-- Testimony -->
        <div class="testimony">
            En testimonio y confirmación de lo anterior, hemos hecho que este instrumento se firme bajo el sello oficial del Instituto.
        </div>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="qr-placeholder"></div>

            <div class="signature-area">
                <div class="signature-line"></div>
                <div class="signatory-name">Jhon Doe</div>
                <div class="signatory-title">Academic Director</div>
            </div>

            <div class="seal-placeholder">
                SEAL
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="certificate-id">
                Número de identificación del certificado: &nbsp;&nbsp;<?php echo htmlspecialchars($certificate['id']); ?>
            </div>
            <div class="footer-right">
                <div class="date"><?php echo $end_date_formatted; ?></div>
                <div class="page-number">1/1</div>
            </div>
        </div>
    </div>
</body>
</html>
