<?php
require 'session_check.php';
require '../db_connect.php';
$student_id = $_SESSION['student_id'];

// Fetch all assigned exams
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

        <?php
        // Fetch all attempts of this student for this exam
        $attempts = $conn->query("
            SELECT * FROM student_exams 
            WHERE student_id='$student_id' AND exam_id=".$exam['id']."
            ORDER BY id ASC
        ");
        if($attempts->num_rows > 0){
            echo " | Attempts: ";
            while($att = $attempts->fetch_assoc()){
                echo "<a href='exam_result.php?id=".$att['id']."'>#".$att['id']."</a> ";
            }
        }
        ?>
    </li>
<?php endwhile; ?>
</ul>
