<?php
// lock_action.php
session_start();
require 'db_connect.php';

// Optional: check admin login here (if you have an admin session).
// if (!isset($_SESSION['admin_logged_in'])) { header('Location: login.php'); exit; }

$student_id = $_POST['student_id'] ?? '';
$action = $_POST['action'] ?? '';

if (empty($student_id) || empty($action)) {
    header("Location: admin_enrollments.php?msg=Invalid+request");
    exit();
}

if ($action === 'lock') {
    $new = 1;
} elseif ($action === 'unlock') {
    $new = 0;
} else {
    header("Location: admin_enrollments.php?msg=Invalid+action");
    exit();
}

// Update statement using prepared stmt
$stmt = $conn->prepare("UPDATE olevel_enrollments SET is_locked = ? WHERE student_id = ?");
if (!$stmt) {
    // handle prepare error
    header("Location: admin_enrollments.php?msg=DB+error");
    exit();
}
$stmt->bind_param("is", $new, $student_id);
if ($stmt->execute()) {
    $stmt->close();
    header("Location: admin_enrollments.php?msg=Updated+successfully");
    exit();
} else {
    $stmt->close();
    header("Location: admin_enrollments.php?msg=Update+failed");
    exit();
}
