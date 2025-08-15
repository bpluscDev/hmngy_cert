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

$sql = "DELETE FROM certificates WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header('Location: index.php');
    exit;
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
