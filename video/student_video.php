<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: ../login/login.php");
    exit();
}

require '../db/db_connect.php';

$student_id = $_SESSION['student_id'];

// ✔ Secure Prepared Statement
$stmt = $conn->prepare("SELECT * FROM videos_assignment WHERE student_id = ?");
$stmt->bind_param("s", $student_id);
$stmt->execute();
$videos = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Student Videos</title>
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
.video-box{
    margin-bottom:20px;
}
video{
    width:100%;
    border-radius:10px;
}
</style>
</head>
<body>

<div class="header">Welcome, <?= $_SESSION['student_name'] ?></div>

<div class="container">

<h2>Your Videos</h2>

<?php if ($videos->num_rows > 0): ?>
    <?php while ($row = $videos->fetch_assoc()): ?>
        <div class="card video-box">
            <h3><?= $row['title'] ?></h3>
            <video controls>
                <source src="../uploads/videos/<?= $row['video_file'] ?>" type="video/mp4">
            </video>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No videos assigned yet.</p>
<?php endif; ?>

</div>

</body>
</html>
