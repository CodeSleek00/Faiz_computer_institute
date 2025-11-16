<?php
session_start();
require '../db_connect.php';

// Only allow logged-in students
if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized Access";
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch assigned videos for this student
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
    <meta charset="UTF-8">
    <title>My Videos</title>
    <style>
        body { font-family: Arial; padding: 20px; background: #f9f9f9; }
        h2 { color: #333; }
        .video-box { 
            margin-bottom: 20px; 
            padding: 15px; 
            border: 1px solid #ddd; 
            border-radius: 8px; 
            background: #fff;
        }
        video { 
            width: 100%; 
            max-width: 500px; 
            border-radius: 8px; 
            outline: none;
        }
    </style>
</head>
<body>

<h2>📚 Your Assigned Videos</h2>

<?php if ($result->num_rows === 0): ?>
    <p>No videos assigned.</p>
<?php else: ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="video-box">
            <h3><?= htmlspecialchars($row['title']) ?></h3>
            <video controls>
                <source src="../<?= htmlspecialchars($row['video_file']) ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

</body>
</html>
