<?php
session_start();
include '../db_connect.php';

// Check Login
if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized Access!";
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch videos where student_id exists in assigned_students
$sql = "SELECT * FROM videos 
        WHERE FIND_IN_SET('$student_id', assigned_students) > 0";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Videos</title>
<style>
    body { font-family: Arial; background: #f5f5f5; padding: 20px; }
    .video-card {
        background: white; padding: 15px; margin-bottom: 15px;
        border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    video {
        width: 100%; max-height: 350px; border-radius: 8px;
    }
</style>
</head>
<body>

<h2>📚 My Assigned Videos</h2>

<?php if ($result->num_rows > 0): ?>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="video-card">
            <h3><?php echo $row['title']; ?></h3>

            <video controls>
                <source src="<?php echo $row['video_path']; ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>

            <p><?php echo $row['description']; ?></p>
        </div>
    <?php endwhile; ?>

<?php else: ?>
    <p>No videos assigned yet.</p>
<?php endif; ?>

</body>
</html>
