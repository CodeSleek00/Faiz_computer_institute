<?php
require 'db_connect.php';
session_start();

// Student Login Check
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch Student Info
$stu = $conn->query("SELECT * FROM o_level_enrollments WHERE student_id='$student_id'");
$student = $stu->fetch_assoc();

// Fetch Assigned Modules
$assigned = $conn->query("SELECT m.module_name, r.score, r.total_marks 
                          FROM module_results r
                          INNER JOIN modules m ON r.module_id = m.id
                          WHERE r.student_id='$student_id'
                          ORDER BY r.id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Results</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins';
    background: #eef2ff;
    padding: 20px;
}
.container{
    width: 90%;
    max-width: 850px;
    margin: auto;
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.2);
}
h2{
    text-align: center;
    margin-bottom: 15px;
}
.table{
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.table th, .table td{
    padding: 12px;
    border-bottom: 1px solid #ddd;
}
.table th{
    background: #4f46e5;
    color: #fff;
}
.score-pass{
    color: green;
    font-weight: 600;
}
.score-fail{
    color: red;
    font-weight: 600;
}
</style>
</head>
<body>

<div class="container">
    <h2>Your Module Results</h2>

    <p><strong>Name:</strong> <?= $student['name'] ?></p>
    <p><strong>Student ID:</strong> <?= $student['student_id'] ?></p>

    <table class="table">
        <tr>
            <th>Module</th>
            <th>Score</th>
            <th>Total Marks</th>
            <th>Status</th>
        </tr>

        <?php if ($assigned->num_rows > 0): ?>
            <?php while ($row = $assigned->fetch_assoc()): ?>
                <?php 
                    $score = $row['score'];
                    $total = $row['total_marks'];
                    $status = $score >= ($total / 2) ? "Pass" : "Fail";
                ?>
                <tr>
                    <td><?= $row['module_name'] ?></td>
                    <td><?= $score ?></td>
                    <td><?= $total ?></td>
                    <td class="<?= $status == 'Pass' ? 'score-pass' : 'score-fail' ?>">
                        <?= $status ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">No results found yet</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>
