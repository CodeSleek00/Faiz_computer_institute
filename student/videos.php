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

// Fetch videos
$videos = $conn->query("SELECT * FROM module_videos WHERE module_id='$module_id' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $m['module_name'] ?> - Videos</title>
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
.video-box{
    background:#fff;
    padding:15px;
    border-radius:10px;
    margin-bottom:20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.video-title{
    font-size:18px;
    font-weight:600;
    margin-bottom:10px;
}
iframe, video{
    width:100%;
    border-radius:10px;
}
</style>
</head>

<body>

<div class="header"><?= $m['module_name'] ?> - Videos</div>

<div class="container">

    <?php if ($videos->num_rows > 0) { 
        while($v = $videos->fetch_assoc()) { ?>

            <div class="video-box">
                <div class="video-title"><?= $v['title'] ?></div>

                <?php if (!empty($v['youtube_link'])) { ?>
                    <!-- YouTube Embed -->
                    <iframe height="250" src="<?= $v['youtube_link'] ?>" frameborder="0" allowfullscreen></iframe>
                
                <?php } else if (!empty($v['video_file'])) { ?>
                    <!-- MP4 Video -->
                    <video height="250" controls>
                        <source src="uploads/videos/<?= $v['video_file'] ?>" type="video/mp4">
                    </video>
                <?php } ?>

                <?php if (!empty($v['description'])) { ?>
                    <p><?= $v['description'] ?></p>
                <?php } ?>
            </div>

    <?php }} else { ?>

        <div class="video-box">
            <p>No videos uploaded for this module.</p>
        </div>

    <?php } ?>

</div>

</body>
</html>
