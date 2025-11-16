<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login/login.php");
    exit;
}

$me = $_SESSION['student_id'];

$query = $conn->query("
    SELECT v.* FROM videos v
    INNER JOIN video_assignments a ON a.video_id = v.id
    WHERE a.assigned_to = $me
    ORDER BY a.assigned_at DESC
");
?>

<h2>Your Videos</h2>

<?php while($v = $query->fetch_assoc()) { ?>
    <div style="margin:10px 0;">
        <h3><?= $v['title'] ?></h3>
        <a href="student_playback.php?id=<?= $v['id'] ?>">Watch Now</a>
    </div>
<?php } ?>
