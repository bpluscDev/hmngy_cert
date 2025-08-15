<?php
// This file is the template for the GCI-2 certificate.
// It expects a $certificate variable to be available with the certificate data.

// Format the end date
$end_date_formatted = date("F j, Y", strtotime($certificate['fecha_fin']));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado - <?php echo htmlspecialchars($certificate['nombre_completo']); ?></title>
    <link rel="stylesheet" href="gci2.css">
</head>
<body>
    <div class="certificate">
        <div class="header">
            <div class="logo-container">
                <div class="network-sphere">
                    <div class="sphere"></div>
                    <div class="network-dots">
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="dot"></div>
                        <div class="connection"></div>
                        <div class="connection"></div>
                        <div class="connection"></div>
                    </div>
                </div>
                <div class="institute-name">
                    <h1 class="global">GLOBAL</h1>
                    <h1 class="certification">CERTIFICATION</h1>
                    <h1 class="institute">INSTITUTE</h1>
                </div>
            </div>
        </div>

        <div class="separator"></div>

        <div class="this-is-to-certify">ESTO ES PARA CERTIFICAR QUE</div>

        <div class="recipient-name"><?php echo htmlspecialchars($certificate['nombre_completo']); ?></div>

        <div class="completion-text">
            POR HABER COMPLETADO CON ÉXITO EL SEMINARIO EN PROCESOS DE RECURSOS HUMANOS Y NÓMINA,<br>
            POR EL PRESENTE SE OTORGA ESTA CERTIFICACIÓN EN RECONOCIMIENTO AL LOGRO SOBRESALIENTE.
        </div>

        <div class="course-title">
            <?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>
        </div>

        <div class="testimony-text">
            EN TESTIMONIO Y CONFIRMACIÓN DE LO ANTERIOR, HEMOS HECHO QUE ESTE INSTRUMENTO SE<br>
            EJECUTE BAJO EL SELLO OFICIAL DEL INSTITUTO.
        </div>

        <div class="footer">
            <div class="qr-code">
                <div class="qr-pattern"></div>
            </div>

            <div class="signature-section">
                <div class="signature">
                    <div class="signature-line"></div>
                </div>
                <div class="signature-text">DIRECTOR DE CERTIFICACIÓN</div>
            </div>

            <div class="seal">
                <div class="seal-inner">
                    SELLO<br>OFICIAL
                </div>
            </div>
        </div>

        <div class="bottom-info">
            <div>Número de Certificado: <?php echo htmlspecialchars($certificate['id']); ?></div>
            <div>Fecha de Certificación: <?php echo $end_date_formatted; ?></div>
        </div>
    </div>
</body>
</html>
