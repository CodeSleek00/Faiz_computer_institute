<?php
session_start();
require 'db_connect.php';

$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

if(!$email || !$phone){
  header("Location: login.php?error=1");
  exit;
}

// Check if enrolled user exists
$query = "SELECT * FROM olevel_enrollments WHERE email=? AND phone=? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $email, $phone);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows > 0){
  $user = $result->fetch_assoc();
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_name'] = $user['name'];
  header("Location: portal.php");
} else {
  header("Location: login.php?error=1");
}
$stmt->close();
$conn->close();
?>
