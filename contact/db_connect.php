<?php
$servername = "localhost";
$username   = "u298112699_FAIZ_123";
$password   = "Faiz2912";
$database   = "u298112699_Computer_FAIZ";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Set character encoding
$conn->set_charset("utf8mb4");

// Set PHP timezone
date_default_timezone_set("Asia/Kolkata");

// Set MySQL timezone
$conn->query("SET time_zone = '+05:30'");

?>
