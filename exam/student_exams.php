<?php
require 'session_check.php';
require '../db_connect.php';

$student_id = $_SESSION['student_id'];

$exams = $conn->query("
    SELECT e.*
    FROM exams e
    JOIN exam_assignments ea ON e.id = ea.exam_id
    WHERE ea.student_id = '$student_id'
");
?>

<h2>Assigned Exams</h2>
<ul>
<?php while($exam = $exams->fetch_assoc()): ?>
    <li>
        <?= htmlspecialchars($exam['exam_name']) ?> -
        <a href="start_exam.php?exam_id=<?= $exam['id'] ?>">Start Exam</a>
    </li>
<?php endwhile; ?>
</ul>
