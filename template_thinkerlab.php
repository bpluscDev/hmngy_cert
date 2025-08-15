<?php
// This file is the template for the thethinkerlab certificate.
// It expects a $certificate variable to be available with the certificate data.

// Generate 255-character authentication string
$auth_string_raw = $certificate['nombre_certificacion'] . 'www.thethinkerlab.com' . $certificate['id'] . $certificate['fecha_inicio'] . $certificate['fecha_fin'];
$auth_string_base64 = base64_encode($auth_string_raw);
$current_len = strlen($auth_string_base64);
$needed_len = 255 - $current_len;
if ($needed_len > 0) {
    // Generate a random string for padding
    try {
        $padding = bin2hex(random_bytes(ceil($needed_len / 2)));
        $auth_code_display = substr($auth_string_base64 . $padding, 0, 255);
    } catch (Exception $e) {
        // Fallback for random_bytes failure
        $auth_code_display = substr(str_pad($auth_string_base64, 255, '0123456789abcdef'), 0, 255);
    }
} else {
    $auth_code_display = substr($auth_string_base64, 0, 255);
}

// For the "completion-text", we can try to make the date dynamic as well
$completion_date = date("F Y", strtotime($certificate['fecha_inicio']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma de Reconocimiento - ThinkerLab</title>
    <link rel="stylesheet" href="thinkerlab.css">
</head>
<body>
    <div class="diploma">
        <div class="content">
            <div class="logo-section">
                <img src="images/logo-thinkerlab.png" alt="ThinkerLab Logo" class="logo-thinkerlab">
            </div>

            <div class="diploma-title">DIPLOMA</div>
            <div class="decorative-line"></div>
            <div class="subtitle">DE RECONOCIMIENTO</div>
            <div class="decorative-line"></div>
            <div class="granted-to">otorgado a:</div>

            <div class="recipient-name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></div>

            <div class="completion-text">
                Por completar satisfactoriamente el curso de capacitación <span class="course-title">"<?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>"</span> durante el mes de <?php echo $completion_date; ?>
            </div>

            <div class="authentication">
                <div class="auth-title">Autenticación:</div>
                <div class="auth-code"><?php echo htmlspecialchars($auth_code_display); ?></div>
                <div class="website">www.thethinkerlab.com</div>
            </div>
        </div>
    </div>
</body>
</html>
