<?php
// check_lock_status.php
session_start();
require 'db_connect.php';

// Ensure user is logged in
if (!isset($_SESSION['student_id'])) {
    // Not logged in — return not-locked (or you may return 401)
    header('Content-Type: application/json');
    echo json_encode(['logged_in' => false, 'is_locked' => false]);
    exit();
}

$student_id = $_SESSION['student_id'];

// Prepared statement for safety
$stmt = $conn->prepare("SELECT is_locked, name FROM olevel_enrollments WHERE student_id = ? LIMIT 1");
if (!$stmt) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'db_prepare_failed']);
    exit();
}
$stmt->bind_param("s", $student_id);
$stmt->execute();
$res = $stmt->get_result();

if ($res && $res->num_rows === 1) {
    $row = $res->fetch_assoc();
    // return JSON with is_locked (0/1) and optionally name
    header('Content-Type: application/json');
    echo json_encode([
        'logged_in' => true,
        'is_locked' => (int)$row['is_locked'] === 1 ? true : false,
        'name' => $row['name'] ?? ''
    ]);
    exit();
} else {
    header('Content-Type: application/json');
    echo json_encode(['logged_in' => true, 'is_locked' => false]);
    exit();
}
