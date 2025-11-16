<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connect.php';

if (!isset($_GET['test_id'])) {
    echo "Test not found!";
    exit();
}

$test_id = intval($_GET['test_id']);
$student_id = $_SESSION['student_id'];

// Fetch test info
$test = $conn->query("SELECT * FROM module_mocktests WHERE id='$test_id' LIMIT 1");
if ($test->num_rows == 0) {
    echo "Invalid test!";
    exit();
}
$t = $test->fetch_assoc();

// Fetch questions
$questions = $conn->query("SELECT * FROM mocktest_questions WHERE test_id='$test_id' ORDER BY id ASC");

// If submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $qid => $ans) {
        if (strpos($qid, 'q_') !== false) {
            $question_id = str_replace('q_', '', $qid);

            $ans = mysqli_real_escape_string($conn, $ans);

            // Insert answer
            $conn->query("
                INSERT INTO mocktest_answers (student_id, test_id, question_id, answer)
                VALUES ('$student_id', '$test_id', '$question_id', '$ans')
                ON DUPLICATE KEY UPDATE answer='$ans'
            ");
        }
    }

    // Mark test completed
    $conn->query("
        INSERT INTO mocktest_results (student_id, test_id, status)
        VALUES ('$student_id', '$test_id', 'completed')
        ON DUPLICATE KEY UPDATE status='completed'
    ");

    header("Location: result.php?test_id=$test_id");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $t['test_name'] ?> - Mock Test</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Poppins',sans-serif;
    background:#f4f6ff;
    margin:0;
}
.header{
    background:#007bff;
    color:#fff;
    padding:18px;
    font-size:20px;
    font-weight:600;
    display:flex;
    justify-content:space-between;
}
.container{
    padding:20px;
}
.question-box{
    background:#fff;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.submit-btn{
    padding:12px 20px;
    background:#007bff;
    color:#fff;
    border:none;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}
.options label{
    display:block;
    margin:6px 0;
}
.timer{
    font-size:18px;
    background:#fff;
    padding:6px 15px;
    border-radius:6px;
    color:#007bff;
}
</style>

<script>
// Timer system
let timeLeft = <?= $t['duration'] * 60 ?>;

function startTimer() {
    let timer = setInterval(function() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        if (seconds < 10) seconds = "0" + seconds;

        document.getElementById("timer").innerHTML = minutes + ":" + seconds;

        if (timeLeft <= 0) {
            clearInterval(timer);
            document.getElementById("testForm").submit();
        }

        timeLeft -= 1;

    }, 1000);
}

window.onload = startTimer;
</script>

</head>

<body>

<div class="header">
    <div><?= $t['test_name'] ?></div>
    <div class="timer" id="timer"></div>
</div>

<div class="container">

<form method="POST" id="testForm">

<?php 
$qno = 1;
while($q = $questions->fetch_assoc()) { ?>
    
    <div class="question-box">
        <b>Q<?= $qno ?>. <?= $q['question'] ?></b>

        <div class="options">
            <label><input type="radio" name="q_<?= $q['id'] ?>" value="A"> <?= $q['option_a'] ?></label>
            <label><input type="radio" name="q_<?= $q['id'] ?>" value="B"> <?= $q['option_b'] ?></label>
            <label><input type="radio" name="q_<?= $q['id'] ?>" value="C"> <?= $q['option_c'] ?></label>
            <label><input type="radio" name="q_<?= $q['id'] ?>" value="D"> <?= $q['option_d'] ?></label>
        </div>
    </div>

<?php $qno++; } ?>

<button type="submit" class="submit-btn">Submit Test</button>

</form>

</div>

</body>
</html>
