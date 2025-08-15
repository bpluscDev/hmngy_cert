<?php
session_start();
require_once 'includes/auth.php';
require_login();

// Get certificate ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = $_GET['id'];

// --- QR Code Generation ---

// 1. Set the data for the QR code (the validation URL)
$validation_url = "https://certification.humanergy.app/validate.php?id=" . urlencode($id);

// 2. Set the QR code API endpoint
// We use api.qrserver.com, a free QR code generator API
$qr_api_url = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($validation_url) . "&size=100x100&format=jpg";

// 3. Fetch the QR code image data from the API
$qr_image_data = file_get_contents($qr_api_url);

// 4. Save the QR code image to the server
if ($qr_image_data !== false) {
    $qr_image_path = 'images/qr/' . $id . '.jpg';
    file_put_contents($qr_image_path, $qr_image_data);
}

// 5. Redirect back to the main list
// Optionally, you could add a success message to the session to display on index.php
header('Location: index.php');
exit;
?>
