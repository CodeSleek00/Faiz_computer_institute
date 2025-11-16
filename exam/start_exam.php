<?php
require 'session_check.php';
require '../db_connect.php';

$student_id = $_SESSION['student_id'];
$exam_id = intval($_GET['exam_id']);

$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id")->fetch_all(MYSQLI_ASSOC);

$total = count($questions);
?>

<h2><?= htmlspecialchars($exam['exam_name']) ?></h2>
<p>Time: <?= $exam['time_minutes'] ?> minutes | Total Questions: <?= $exam['total_questions'] ?></p>

<div id="timer"></div>

<form id="examForm" method="POST" action="submit_exam.php">
    <input type="hidden" name="exam_id" value="<?= $exam_id ?>">
    <?php foreach($questions as $i => $q): ?>
    <div class="question" style="<?= $i==0?'display:block':'display:none' ?>">
        <p><strong>Q<?= $i+1 ?>. <?= htmlspecialchars($q['question_text']) ?></strong></p>
        <input type="radio" name="q<?= $q['id'] ?>" value="A" required> <?= htmlspecialchars($q['option_a']) ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="B"> <?= htmlspecialchars($q['option_b']) ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="C"> <?= htmlspecialchars($q['option_c']) ?><br>
        <input type="radio" name="q<?= $q['id'] ?>" value="D"> <?= htmlspecialchars($q['option_d']) ?><br>
    </div>
    <?php endforeach; ?>

    <button type="button" id="prevBtn">Previous</button>
    <button type="button" id="nextBtn">Next</button>
    <button type="submit" id="submitBtn" style="display:none">Submit Exam</button>
</form>

<script>
let current = 0;
let questions = document.querySelectorAll('.question');
let total = questions.length;

document.getElementById('nextBtn').addEventListener('click', () => {
    if(current < total-1){
        questions[current].style.display='none';
        current++;
        questions[current].style.display='block';
    }
    toggleButtons();
});

document.getElementById('prevBtn').addEventListener('click', () => {
    if(current > 0){
        questions[current].style.display='none';
        current--;
        questions[current].style.display='block';
    }
    toggleButtons();
});

function toggleButtons(){
    document.getElementById('prevBtn').style.display = current==0?'none':'inline';
    document.getElementById('nextBtn').style.display = current==total-1?'none':'inline';
    document.getElementById('submitBtn').style.display = current==total-1?'inline':'none';
}
toggleButtons();

// Timer
let timeLeft = <?= $exam['time_minutes'] ?> * 60;
let timerEl = document.getElementById('timer');
let timerInterval = setInterval(()=>{
    let min = Math.floor(timeLeft/60);
    let sec = timeLeft % 60;
    timerEl.innerText = `Time Left: ${min}m ${sec}s`;
    timeLeft--;
    if(timeLeft<0){
        clearInterval(timerInterval);
        alert('Time over! Exam submitted automatically.');
        document.getElementById('examForm').submit();
    }
},1000);
</script>
