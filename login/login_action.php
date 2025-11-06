<?php
session_start();
require 'db_connect.php';

$student_id = $_POST['student_id'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($student_id) || empty($password)) {
  header("Location: login.php?error=Please fill all fields");
  exit();
}

$stmt = $conn->prepare("SELECT id, student_id, name, password, is_locked FROM olevel_enrollments WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();

  if ((int)$row['is_locked'] === 1) {
    $_SESSION['locked'] = true;
    $_SESSION['student_name'] = $row['name'];
    header("Location: locked_portal.php");
    exit();
}


  // If you are storing plain text passwords (not recommended)
  if ($password === $row['password']) {
    $_SESSION['student_id'] = $row['student_id'];
    $_SESSION['student_name'] = $row['name'];
    header("Location: dashboard.php");
    exit();
  } else {
    header("Location: login.php?error=Incorrect+Password");
    exit();
  }

} else {
  header("Location: login.php?error=Student+ID+not+found");
  exit();
}
