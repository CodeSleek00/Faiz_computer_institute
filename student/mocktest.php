<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

require 'db_connect.php';

if (!isset($_GET['module_id'])) {
    echo "Module not found!";
    exit();
}

$module_id = intval($_GET['module_id']);

// Fetch module name
$module = $conn->query("SELECT * FROM modules WHERE id='$module_id' LIMIT 1");
if ($module->num_rows == 0) {
    echo "Invalid Module!";
    exit();
}
$m = $module->fetch_assoc();

// Fetch mock tests of this module
$mockTests = $conn->query("
    SELECT * FROM module_mocktests 
    WHERE module_id='$module_id'
    ORDER BY id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $m['module_name'] ?> - Mock Tests</title>
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
}
.container{
    padding:20px;
}
.test-box{
    background:#fff;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.test-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:8px;
}
.test-info{
    color:#333;
    margin-bottom:10px;
}
.start-btn{
    display:inline-block;
    padding:10px 14px;
    background:#007bff;
    color:#fff;
    border-radius:6px;
    text-decoration:none;
    font-weight:600;
}
</style>
</head>

<body>

<div class="header"><?= $m['module_name'] ?> - Mock Tests</div>

<div class="container">

    <?php if ($mockTests->num_rows > 0) { 
        while($t = $mockTests->fetch_assoc()) { ?>

            <div class="test-box">
                <div class="test-title"><?= $t['test_name'] ?></div>

                <div class="test-info">
                    <b>Total Questions:</b> <?= $t['total_questions'] ?><br>
                    <b>Duration:</b> <?= $t['duration'] ?> Minutes
                </div>

                <a class="start-btn" 
                   href="mocktest_start.php?test_id=<?= $t['id'] ?>">
                   Start Test →
                </a>
            </div>

    <?php }} else { ?>

        <div class="test-box">
            <p>No mock tests uploaded for this module.</p>
        </div>

    <?php } ?>

</div>

</body>
</html>
