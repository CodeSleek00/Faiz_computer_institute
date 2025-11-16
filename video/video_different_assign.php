<?php
require 'db_connect.php';
session_start();

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit;
}

$me = $_SESSION['student_id']; // olevel_enrollments.id

// Fetch my assigned videos
$myVideos = $conn->query("
    SELECT v.id, v.title 
    FROM videos v 
    INNER JOIN video_assignments a ON a.video_id = v.id 
    WHERE a.assigned_to = $me
");

// Fetch all students except me
$students = $conn->query("
    SELECT id, name, student_id 
    FROM olevel_enrollments 
    WHERE id != $me
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = $_POST['video_id'];
    $assign_to = $_POST['student_id'];

    $stmt = $conn->prepare("
        INSERT INTO video_assignments (video_id, assigned_to, assigned_by, role)
        VALUES (?, ?, ?, 'student')
    ");

    $stmt->bind_param("iii", $video_id, $assign_to, $me);
    $stmt->execute();

    echo "Video Assigned Successfully!";
}
?>

<form method="POST">
    <select name="video_id" required>
        <option>Select Your Video</option>
        <?php while($v = $myVideos->fetch_assoc()) { ?>
            <option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
        <?php } ?>
    </select>

    <select name="student_id" required>
        <option>Select Student</option>
        <?php while($s = $students->fetch_assoc()) { ?>
            <option value="<?= $s['id'] ?>"><?= $s['name'] ?> (<?= $s['student_id'] ?>)</option>
        <?php } ?>
    </select>

    <button>Assign</button>
</form>
