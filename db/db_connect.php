<?php
// Database connection file for all PHP pages

$servername = "localhost";     // Host name
$username   = "u298112699_FAIZ_123";          // MySQL username (change if needed)
$password   = "Faiz2912";              // MySQL password
$database   = "u298112699_Computer_FAIZ";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Optional: set character encoding (important for UTF-8 data)
$conn->set_charset("utf8mb4");
?>
