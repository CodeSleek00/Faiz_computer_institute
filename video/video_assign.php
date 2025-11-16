<?php
require 'db_connect.php';

// Fetch all videos
$videos = $conn->query("SELECT * FROM videos ORDER BY id DESC");

// Fetch all students from olevel_enrollments
$students = $conn->query("SELECT id, name, student_id FROM olevel_enrollments ORDER BY name ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = $_POST['video_id'];
    $student_id = $_POST['student_id'];

    // assigned_by = 0 (admin without login)
    $stmt = $conn->prepare("
        INSERT INTO video_assignments (video_id, assigned_to, assigned_by, assigned_role) 
        VALUES (?, ?, 0, 'admin')
    ");

    $stmt->bind_param("ii", $video_id, $student_id);
    $stmt->execute();

    echo "Video Assigned Successfully!";
}
?>

<form method="POST">
    <select name="video_id" required>
        <option>Select Video</option>
        <?php while($v = $videos->fetch_assoc()) { ?>
            <option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
        <?php } ?>
    </select>

    <select name="student_id" required>
        <option>Select Student</option>
        <?php while($s = $students->fetch_assoc()) { ?>
            <option value="<?= $s['id'] ?>">(<?= $s['student_id'] ?>) <?= $s['name'] ?></option>
        <?php } ?>
    </select>

    <button>Assign Video</button>
</form>
