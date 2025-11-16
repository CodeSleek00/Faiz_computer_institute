<?php
session_start();
require '../db_connect.php';
$student_exam_id = $_GET['id'];

$exam_attempt = $conn->query("SELECT se.*, e.exam_name, e.marks_per_question FROM student_exams se JOIN exams e ON se.exam_id=e.id WHERE se.id=$student_exam_id")->fetch_assoc();
$answers = $conn->query("SELECT sa.*, q.question_text, q.option_a, q.option_b, q.option_c, q.option_d, q.correct_option FROM student_answers sa JOIN questions q ON sa.question_id=q.id WHERE sa.student_exam_id=$student_exam_id");
?>

<h2>Exam Result: <?= htmlspecialchars($exam_attempt['exam_name']) ?></h2>
<p>Score: <?= $exam_attempt['score'] ?> / <?= $exam_attempt['total_questions'] * $exam_attempt['marks_per_question'] ?></p>
<p>Correct: <?= $exam_attempt['correct_answers'] ?> | Wrong: <?= $exam_attempt['wrong_answers'] ?></p>

<h3>Question-wise Analysis</h3>
<ol>
<?php while($a=$answers->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($a['question_text']) ?><br>
        Your Answer: <?= $a['selected_option'] ?> (<?= $a['is_correct'] ? '✔' : '❌' ?>)<br>
        Correct Answer: <?= $a['correct_option'] ?>
    </li>
<?php endwhile; ?>
</ol>
