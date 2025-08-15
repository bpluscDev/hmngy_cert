<?php
session_start();
require_once 'includes/auth.php';
require_login();

require_once 'includes/db.php';

function generate_unique_id($conn) {
    do {
        $id = mt_rand(10000000, 99999999);
        $sql = "SELECT id FROM certificates WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    } while ($result->num_rows > 0);
    return $id;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = generate_unique_id($conn);
    $nombre_completo = $_POST['nombre_completo'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $nombre_certificacion = $_POST['nombre_certificacion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $template_type = $_POST['template_type'];

    $sql = "INSERT INTO certificates (id, nombre_completo, nombre_empresa, nombre_certificacion, fecha_inicio, fecha_fin, template_type) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $id, $nombre_completo, $nombre_empresa, $nombre_certificacion, $fecha_inicio, $fecha_fin, $template_type);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
}

require_once 'templates/header.php';
?>

<h2>Add Certificate</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
    </div>
    <div class="mb-3">
        <label for="nombre_empresa" class="form-label">Company</label>
        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" required>
    </div>
    <div class="mb-3">
        <label for="nombre_certificacion" class="form-label">Certification</label>
        <input type="text" class="form-control" id="nombre_certificacion" name="nombre_certificacion" required>
    </div>
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
    </div>
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">End Date</label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ente certificador</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="template_type" id="template_humanergy" value="humanergy" checked>
            <label class="form-check-label" for="template_humanergy">
                Humanergy
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="template_type" id="template_gci1" value="gci-1">
            <label class="form-check-label" for="template_gci1">
                GCI-1
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add Certificate</button>
</form>

<?php require_once 'templates/footer.php'; ?>
