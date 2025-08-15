<?php
session_start();
require_once 'includes/auth.php';
require_login();

require_once 'includes/db.php';

$id = $_GET['id'];
if (!$id) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_completo = $_POST['nombre_completo'];
    $nombre_empresa = $_POST['nombre_empresa'];
    $nombre_certificacion = $_POST['nombre_certificacion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];
    $template_type = $_POST['template_type'];

    $sql = "UPDATE certificates SET nombre_completo = ?, nombre_empresa = ?, nombre_certificacion = ?, fecha_inicio = ?, fecha_fin = ?, template_type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $nombre_completo, $nombre_empresa, $nombre_certificacion, $fecha_inicio, $fecha_fin, $template_type, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Error: " . $stmt->error;
    }
} else {
    $sql = "SELECT * FROM certificates WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $certificate = $result->fetch_assoc();

    if (!$certificate) {
        header('Location: index.php');
        exit;
    }
}

require_once 'templates/header.php';
?>

<h2>Edit Certificate</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label for="nombre_completo" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="<?php echo htmlspecialchars($certificate['nombre_completo']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="nombre_empresa" class="form-label">Company</label>
        <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa" value="<?php echo htmlspecialchars($certificate['nombre_empresa']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="nombre_certificacion" class="form-label">Certification</label>
        <input type="text" class="form-control" id="nombre_certificacion" name="nombre_certificacion" value="<?php echo htmlspecialchars($certificate['nombre_certificacion']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Start Date</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $certificate['fecha_inicio']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">End Date</label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo $certificate['fecha_fin']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Ente certificador</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="template_type" id="template_humanergy" value="humanergy" <?php echo (isset($certificate['template_type']) && $certificate['template_type'] === 'humanergy') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="template_humanergy">
                Humanergy
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="template_type" id="template_gci1" value="gci-1" <?php echo (isset($certificate['template_type']) && $certificate['template_type'] === 'gci-1') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="template_gci1">
                GCI-1
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="template_type" id="template_gci2" value="gci-2" <?php echo (isset($certificate['template_type']) && $certificate['template_type'] === 'gci-2') ? 'checked' : ''; ?>>
            <label class="form-check-label" for="template_gci2">
                GCI-2
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update Certificate</button>
</form>

<?php require_once 'templates/footer.php'; ?>
