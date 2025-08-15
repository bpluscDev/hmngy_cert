<?php
require_once 'config.php';

// Connect to MySQL server
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

// Select the database
$conn->select_db(DB_NAME);

// SQL to create users table
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'users' created successfully\n";
    // Insert a default user
    $username = 'admin';
    $password = password_hash('password', PASSWORD_DEFAULT);
    $insert_sql = "INSERT INTO users (username, password) VALUES ('$username', '$password') ON DUPLICATE KEY UPDATE password = VALUES(password)";
    if ($conn->query($insert_sql) === TRUE) {
        echo "Default user 'admin' created/updated successfully\n";
    } else {
        echo "Error creating default user: " . $conn->error . "\n";
    }
} else {
    echo "Error creating table 'users': " . $conn->error . "\n";
}

// SQL to create certificates table
$sql = "CREATE TABLE IF NOT EXISTS certificates (
    id INT(8) PRIMARY KEY,
    nombre_completo VARCHAR(255) NOT NULL,
    nombre_empresa VARCHAR(255) NOT NULL,
    nombre_certificacion VARCHAR(255) NOT NULL,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'certificates' created successfully\n";
} else {
    echo "Error creating table 'certificates': " . $conn->error . "\n";
}

$conn->close();
?>
