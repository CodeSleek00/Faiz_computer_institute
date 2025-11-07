<?php
include 'db_connect.php';
session_start();

// Ensure student is logged in
if (!isset($_SESSION['enrollment_id'])) {
    header("Location: login.php");
    exit;
}

// Validate inputs
$exam_id = intval($_POST['exam_id'] ?? 0);
$answers = $_POST['answers'] ?? [];

if ($exam_id <= 0 || empty($answers)) {
    die("Invalid exam submission.");
}

// Get student_id securely
$stmt = $conn->prepare("SELECT student_id FROM students WHERE enrollment_id = ?");
$stmt->bind_param("s", $_SESSION['enrollment_id']);
$stmt->execute();
$res = $stmt->get_result();
$student = $res->fetch_assoc();

if (!$student) {
    die("Student not found.");
}

$student_id = $student['student_id'];

// Fetch correct answers
$correct_q = $conn->prepare("SELECT question_id, correct_option FROM exam_questions WHERE exam_id = ?");
$correct_q->bind_param("i", $exam_id);
$correct_q->execute();
$result = $correct_q->get_result();

$correct_map = [];
while ($row = $result->fetch_assoc()) {
    $correct_map[$row['question_id']] = $row['correct_option'];
}

// Calculate score
$score = 0;
foreach ($answers as $qid => $ans) {
    if (isset($correct_map[$qid]) && $correct_map[$qid] == $ans) {
        $score++;
    }
}

// Prevent multiple submissions
$check = $conn->prepare("SELECT * FROM exam_submissions WHERE exam_id = ? AND student_id = ?");
$check->bind_param("ii", $exam_id, $student_id);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    header("Location: exam_result_student.php?exam_id=$exam_id&already_submitted=1");
    exit;
}

// Insert submission
$insert = $conn->prepare("INSERT INTO exam_submissions (exam_id, student_id, score, submitted_at) VALUES (?, ?, ?, NOW())");
$insert->bind_param("iii", $exam_id, $student_id, $score);
$insert->execute();

// Redirect to result page
header("Location: exam_result_student.php?exam_id=$exam_id");
exit;
?>
