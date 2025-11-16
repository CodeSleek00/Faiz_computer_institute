<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    // video upload
    $file = time() . "_" . $_FILES['video']['name'];
    $path = "uploads/videos/" . $file;
    move_uploaded_file($_FILES['video']['tmp_name'], $path);

    $stmt = $conn->prepare("INSERT INTO videos (title, description, video_file) VALUES (?,?,?)");
    $stmt->bind_param("sss", $title, $description, $file);
    $stmt->execute();

    echo "Video Uploaded Successfully!";
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Video Title" required><br>
    <textarea name="description" placeholder="Description"></textarea><br>
    <input type="file" name="video" required><br><br>
    <button type="submit">Upload Video</button>
</form>
