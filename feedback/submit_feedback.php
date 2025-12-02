<?php
// submit_feedback.php
header('Content-Type: application/json');
require_once 'db_connect.php';


// Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
http_response_code(405);
echo json_encode(['status' => 'error', 'message' => 'Only POST allowed']);
exit;
}


// Get input (POST)
$input = $_POST;
$student_name = trim($input['student_name'] ?? '');
$rating = intval($input['rating'] ?? 0);
$comment = trim($input['comment'] ?? '');


// Basic validation
$errors = [];
if ($student_name === '') $errors[] = 'Name is required.';
if ($rating < 1 || $rating > 5) $errors[] = 'Rating must be between 1 and 5.';
if ($comment === '') $errors[] = 'Feedback comment is required.';


if (!empty($errors)) {
echo json_encode(['status' => 'error', 'errors' => $errors]);
exit;
}


try {
$stmt = $pdo->prepare('INSERT INTO feedbacks (student_name, rating, comment) VALUES (:name, :rating, :comment)');
$stmt->execute([':name' => $student_name, ':rating' => $rating, ':comment' => $comment]);
echo json_encode(['status' => 'success', 'message' => 'Feedback submitted.']);
} catch (Exception $e) {
http_response_code(500);
echo json_encode(['status' => 'error', 'message' => 'Insert failed: ' . $e->getMessage()]);
}