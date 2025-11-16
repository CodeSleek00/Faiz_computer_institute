<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$video_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->bind_param("i", $video_id);
$stmt->execute();
$video = $stmt->get_result()->fetch_assoc();
?>

<h2><?= $video['title'] ?></h2>
<p><?= $video['description'] ?></p>

<video width="100%" controls>
    <source src="uploads/videos/<?= $video['video_file'] ?>" type="video/mp4">
</video>
