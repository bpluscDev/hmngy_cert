<?php
session_start();
require_once 'includes/auth.php';
require_login();

require_once 'includes/db.php';

// Get certificate ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];

// Fetch certificate data
$sql = "SELECT * FROM certificates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$certificate = $result->fetch_assoc();

// If no certificate is found, redirect
if (!$certificate) {
    header('Location: index.php');
    exit;
}

// Format dates for display
$start_date_formatted = date("d \d\e F", strtotime($certificate['fecha_inicio']));
$end_date_formatted = date("d \d\e F \d\e Y", strtotime($certificate['fecha_fin']));
$certificate_date_formatted = date("d \d\e F \d\e Y", strtotime($certificate['fecha_fin']));

// Generate verification code
$verification_code = 'CERT-' . date("Y") . '-' . str_pad($certificate['id'], 6, '0', STR_PAD_LEFT);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado de Participación</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="certificate-container">
        <div class="certificate">
            <!-- Header con logo -->
            <header class="certificate-header">
                <img src="images/logo-empresa.png" alt="Logo Institucional" class="logo">
                <div class="institution-info">
                    <h1>INSTITUTO DE EDUCACIÓN SUPERIOR</h1>
                    <p>Centro de Capacitación Profesional</p>
                </div>
            </header>

            <!-- Título del certificado -->
            <div class="certificate-title">
                <h2>CERTIFICADO</h2>
                <p class="subtitle">DE PARTICIPACIÓN</p>
            </div>

            <!-- Contenido principal -->
            <div class="certificate-content">
                <div class="certification-text">
                    <p class="intro-text">Por medio del presente documento se</p>
                    <h3 class="action-word">CERTIFICA</h3>
                    <p class="recipient-intro">que</p>
                </div>

                <div class="recipient-name">
                    <h4 id="recipient-name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></h4>
                    <div class="underline"></div>
                </div>

                <div class="course-info">
                    <p class="course-text">
                        Ha participado exitosamente en el curso de
                        <strong id="course-name">"<?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>"</strong>
                        con una duración de <strong id="course-hours">40 horas académicas</strong>,
                        realizado del <strong id="start-date"><?php echo $start_date_formatted; ?></strong>
                        al <strong id="end-date"><?php echo $end_date_formatted; ?></strong>.
                    </p>
                </div>

                <div class="additional-info">
                    <p>
                        Este certificado es otorgado en reconocimiento a su dedicación
                        y aprovechamiento durante el desarrollo del programa académico.
                    </p>
                </div>
            </div>

            <!-- Fecha y lugar -->
            <div class="certificate-footer">
                <div class="date-location">
                    <p>
                        <span id="city">Ciudad de México</span>,
                        <span id="certificate-date"><?php echo $certificate_date_formatted; ?></span>
                    </p>
                </div>

                <!-- Firmas y sellos -->
                <div class="signatures">
                    <div class="signature-block">
                        <img src="images/firma-director.png" alt="Firma del Director" class="signature-image">
                        <div class="signature-line"></div>
                        <p class="signature-name">Dr. Juan Pérez González</p>
                        <p class="signature-title">Director Académico</p>
                    </div>

                    <div class="seal-section">
                        <img src="images/sello-oficial.png" alt="Sello Oficial" class="official-seal">
                        <p class="seal-text">Sello Oficial</p>
                    </div>
                </div>

                <!-- Código de verificación -->
                <div class="verification">
                    <p class="verification-code">
                        Código de verificación: <strong id="verification-code"><?php echo $verification_code; ?></strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script src="js/certificate.js"></script>
</body>
</html>
