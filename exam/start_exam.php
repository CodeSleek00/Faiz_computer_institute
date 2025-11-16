<?php
session_start();
require '../db_connect.php';
$student_id = $_SESSION['student_id'];
$exam_id = $_GET['exam_id'];

// Fetch exam details
$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");
?>

<h2><?= htmlspecialchars($exam['exam_name']) ?></h2>
<form method="POST" action="submit_exam.php">
    <input type="hidden" name="exam_id" value="<?= $exam_id ?>">
    <?php $i=1; while($q=$questions->fetch_assoc()): ?>
        <p><?= $i ?>. <?= htmlspecialchars($q['question_text']) ?></p>
        <input type="radio" name="q<?= $q['id'] ?>" value="A" required> <?= $q['option_a'] ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="B"> <?= $q['option_b'] ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="C"> <?= $q['option_c'] ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="D"> <?= $q['option_d'] ?><br>
    <?php $i++; endwhile; ?>
    <button type="submit">Submit Exam</button>
</form>
