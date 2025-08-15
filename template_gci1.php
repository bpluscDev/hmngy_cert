<?php
// This file is a template for the GCI-1 certificate.
// It expects a $certificate variable to be available with the certificate data.

// Format the end date
$end_date_formatted = date("F j, Y", strtotime($certificate['fecha_fin']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certificado | <?php echo htmlspecialchars($certificate['nombre_completo']); ?></title>
<link rel="stylesheet" href="certificado.css">
</head>
<body>

<div class="certificate">
    <div class="header">
        <img src="images/logo-dummy.png" alt="Logo">
        <div class="title">Iberoamericano MM11 Certificado | <?php echo htmlspecialchars($certificate['nombre_certificacion']); ?></div>
    </div>

    <div class="certify">THIS IS TO CERTIFY THAT</div>
    <div class="name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></div>

    <div class="description">
        Tras haber completado con éxito una rigurosa evaluación de competencia profesional y haber demostrado la capacidad de obtener resultados ejemplares, se otorga esta certificación en reconocimiento a su destacado desempeño.
        <br><br>
        En testimonio y confirmación de lo anterior, hemos hecho que este instrumento se firme bajo el sello oficial del Instituto.
    </div>

    <div class="footer">
        <div class="qr">
            <img src="images/qr-dummy.png" alt="QR Code">
        </div>
        <div class="signature">
            <img src="images/firma-dummy.png" alt="Firma">
            <p class="name">Jhon Doe</p>
            <p class="role">Academic Director</p>
        </div>
        <div class="seal">
            <img src="images/sello-dummy.png" alt="Sello">
        </div>
    </div>

    <div class="id-cert">Número de identificación del certificado: <?php echo htmlspecialchars($certificate['id']); ?></div>
    <div class="date"><?php echo $end_date_formatted; ?></div>
</div>

</body>
</html>
