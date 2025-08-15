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
$start_date_formatted = date("d F Y", strtotime($certificate['fecha_inicio']));
$end_date_formatted = date("d F Y", strtotime($certificate['fecha_fin']));

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
                <p id="recognition-text">In recognition of her amazing performance and great efforts during the month of January 2024.</p>
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
                    <!-- Aquí irá el QR Code -->
                    <div class="qr-placeholder"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/certificate.js"></script>
</body>
</html>
