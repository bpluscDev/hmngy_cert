<?php
// This file is the new template for the GCI-1 certificate.
// It expects a $certificate variable to be available with the certificate data.

// Format dates and parse course name
$end_date_formatted = date("F j, Y", strtotime($certificate['fecha_fin']));
$course_name_parts = explode(' | ', $certificate['nombre_certificacion']);
$header_course_name = trim($course_name_parts[0]);
$header_start_date = date("n/j/y", strtotime($certificate['fecha_inicio']));
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
            <div class="header-left"><?php echo htmlspecialchars($header_course_name); ?></div>
            <div class="header-right"><?php echo $header_start_date; ?></div>
        </div>

        <!-- Logo and Institute Name -->
        <div class="logo-section">
            <img src="images/logo-global.png" alt="Logo Global" class="logo-gci">
        </div>

        <!-- Course Title -->
        <div class="course-title">
            <?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>
        </div>

        <!-- Certification Section -->
        <div class="certify-section">
            <div class="certify-text">SE CERTIFICA QUE</div>
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
            <img src="images/qr-global.png" alt="QR Code" class="qr-gci">

            <div class="signature-area">
                <img src="images/firma-global.png" alt="Firma" class="signature-gci">
                <div class="signatory-name">James Carter</div>
                <div class="signatory-title">Director Académico</div>
            </div>

            <img src="images/sello-global.png" alt="Sello Global" class="seal-gci">
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
