<?php
// fetch_feedbacks.php
header('Content-Type: application/json');
require_once 'db_connect.php';


try {
$stmt = $pdo->query('SELECT id, student_name, rating, comment, created_at FROM feedbacks ORDER BY created_at DESC');
$rows = $stmt->fetchAll();
echo json_encode(['status' => 'success', 'data' => $rows]);
} catch (Exception $e) {
http_response_code(500);
echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}