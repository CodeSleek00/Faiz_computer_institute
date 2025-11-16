<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized Access";
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "
SELECT videos.title, videos.video_file
FROM video_assign
JOIN videos ON video_assign.video_id = videos.id
WHERE video_assign.student_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Videos</title>
    <style>
        body { font-family: Arial; padding:20px; }
        .video-box { margin-bottom:20px; padding:15px; border:1px solid #ddd; }
        video { width:100%; max-width:500px; border-radius:10px; }
    </style>
</head>
<body>

<h2>📚 Your Assigned Videos</h2>

<?php
if ($result->num_rows === 0) {
    echo "<p>No videos assigned.</p>";
} else {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='video-box'>
            <h3>{$row['title']}</h3>
            <video controls>
                <source src='../{$row['video_file']}' type='video/mp4'>
            </video>
        </div>";
    }
}
?>

</body>
</html>
