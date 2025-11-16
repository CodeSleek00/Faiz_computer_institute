<?php
session_start();
require '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $video_file = $_FILES['video_file'];

    $target_dir = "../uploads/videos/";
    $target_file = $target_dir . basename($video_file['name']);
    move_uploaded_file($video_file['tmp_name'], $target_file);

    $stmt = $conn->prepare("INSERT INTO videos (title, video_file) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $target_file);
    $stmt->execute();

    echo "Video added successfully!";
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Video Title" required>
    <input type="file" name="video_file" accept="video/*" required>
    <button type="submit">Add Video</button>
</form>
