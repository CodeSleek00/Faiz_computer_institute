<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../login/login.php");
    exit();
}

require '../db/db_connect.php';

$student_id = $_SESSION['student_id'];

// Fetch O-Level Fee Details
$fee = $conn->query("SELECT * FROM olevel_enrollments WHERE student_id='$student_id' LIMIT 1");
$feeData = ($fee->num_rows > 0) ? $fee->fetch_assoc() : null;

// Fee calculations
$paid_fee   = $feeData['amount'] ?? 0;
$remaining  = 0; // Paid = full amount, so remaining = 0
$months     = $feeData['emi_months'] ?? 0;

// Fetch Assigned Modules
$modules = $conn->query("
    SELECT m.* FROM modules m
    JOIN module_assignments a ON a.module_id = m.id
    WHERE a.student_id='$student_id'
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
body{
    font-family: 'Poppins', sans-serif;
    background:#f4f6ff;
    margin:0;
    padding:0;
}
.header{
    background:#007bff;
    color:#fff;
    padding:18px;
    font-size:22px;
    font-weight:600;
}
.container{
    padding:20px;
}
.card{
    background:#fff;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.card h3{
    margin:0 0 10px 0;
}
.modules a{
    display:block;
    padding:12px;
    background:#e8eeff;
    margin-bottom:8px;
    border-radius:6px;
    text-decoration:none;
    color:#000;
}
</style>
</head>

<body>

<div class="header">Welcome, <?= $_SESSION['student_name'] ?></div>

<div class="container">

    <!-- Profile -->
    <div class="card">
        <h3>Profile</h3>
        <p><b>Student ID:</b> <?= $_SESSION['student_id'] ?></p>
        <?= isset($_SESSION['plan_name']) ? $_SESSION['plan_name'] : 'No Plan Found' ?>

    </div>

    <!-- Fees -->
    <div class="card">
        <h3>Fee Status</h3>
        <p><b>Paid:</b> ₹<?= $paid_fee ?></p>
        <p><b>Remaining:</b> ₹<?= $remaining ?></p>
        <p><b>EMI Months:</b> <?= $months ?> Months</p>
    </div>

    <!-- Assigned Modules -->
    <div class="card">
        <h3>Assigned Modules</h3>
        <div class="modules">
            <?php if ($modules->num_rows > 0) { 
                while($m = $modules->fetch_assoc()) { ?>
                    <a href="module_view.php?module_id=<?= $m['id'] ?>">
                        <?= $m['module_name'] ?>
                    </a>
            <?php }} else { ?>
                <p>No modules assigned.</p>
            <?php } ?>
        </div>
    </div>

</div>

</body>
</html>
