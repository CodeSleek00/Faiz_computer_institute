<?php
session_start();
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['exam_name'];
    $total = $_POST['total_questions'];
    $time = $_POST['time_minutes'];
    $marks = $_POST['marks_per_question'];

    $stmt = $conn->prepare("INSERT INTO exams (exam_name, total_questions, time_minutes, marks_per_question) VALUES (?,?,?,?)");
    $stmt->bind_param("siii", $name, $total, $time, $marks);
    $stmt->execute();
    $exam_id = $stmt->insert_id;

    header("Location: add_questions.php?exam_id=$exam_id");
    exit();
}
?>

<form method="POST">
    <input name="exam_name" placeholder="Exam Name" required><br>
    <input type="number" name="total_questions" placeholder="Total Questions" required><br>
    <input type="number" name="time_minutes" placeholder="Time (Minutes)" required><br>
    <input type="number" name="marks_per_question" placeholder="Marks per Question" required><br>
    <button type="submit">Create Exam</button>
</form>
