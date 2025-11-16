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

// Fetch notes
$notes = $conn->query("SELECT * FROM module_notes WHERE module_id='$module_id' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $m['module_name'] ?> - Notes</title>
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
.note-box{
    background:#fff;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.note-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:5px;
}
a.download-btn{
    background:#007bff;
    padding:8px 12px;
    border-radius:6px;
    color:#fff;
    text-decoration:none;
    font-size:14px;
    display:inline-block;
    margin-top:8px;
}
</style>
</head>

<body>

<div class="header"><?= $m['module_name'] ?> - Notes</div>

<div class="container">

    <?php if ($notes->num_rows > 0) { 
        while($n = $notes->fetch_assoc()) { ?>

            <div class="note-box">
                <div class="note-title"><?= $n['title'] ?></div>

                <?php if (!empty($n['description'])) { ?>
                    <p><?= $n['description'] ?></p>
                <?php } ?>

                <a class="download-btn" 
                   href="uploads/notes/<?= $n['file'] ?>" 
                   download>
                   📥 Download Notes
                </a>
            </div>

    <?php }} else { ?>

        <div class="note-box">
            <p>No notes uploaded for this module.</p>
        </div>

    <?php } ?>

</div>

</body>
</html>
