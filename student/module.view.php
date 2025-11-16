<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

require '../db/db_connect.php';

if (!isset($_GET['module_id'])) {
    echo "Module not found!";
    exit();
}

$module_id = intval($_GET['module_id']);

// Fetch module data
$module = $conn->query("SELECT * FROM modules WHERE id='$module_id' LIMIT 1");

if ($module->num_rows == 0) {
    echo "Invalid Module!";
    exit();
}

$m = $module->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $m['module_name'] ?> - Module</title>
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
.box{
    background:#fff;
    padding:15px;
    margin:10px 0;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.box a{
    text-decoration:none;
    color:#007bff;
    font-size:18px;
    font-weight:600;
}
</style>
</head>

<body>

<div class="header"><?= $m['module_name'] ?> - Module</div>

<div class="container">

    <div class="box">
        <a href="videos.php?module_id=<?= $module_id ?>">🎥 Videos</a>
    </div>

    <div class="box">
        <a href="notes.php?module_id=<?= $module_id ?>">📘 Notes</a>
    </div>

    <div class="box">
        <a href="mocktest.php?module_id=<?= $module_id ?>">📝 Mock Test</a>
    </div>

    <div class="box">
        <a href="result.php?module_id=<?= $module_id ?>">📊 Result</a>
    </div>

</div>

</body>
</html>
