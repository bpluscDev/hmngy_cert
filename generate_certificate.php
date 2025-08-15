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
// We assume the 'template_type' column has been added to the 'certificates' table
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

// --- Template Router ---
// Get the template type from the certificate data. Default to 'humanergy'.
$template_type = isset($certificate['template_type']) ? $certificate['template_type'] : 'humanergy';

if ($template_type === 'gci-1') {
    include 'template_gci1.php';
} else {
    // Default to the Humanergy template
    include 'template_humanergy.php';
}

?>
