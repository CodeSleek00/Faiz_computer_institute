<?php
$servername = "localhost";
$username   = "u298112699_FAIZ_123";
$password   = "Faiz2912";
$database   = "u298112699_Computer_FAIZ";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
