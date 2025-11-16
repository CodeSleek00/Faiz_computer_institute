<?php
session_start();
require '../db_connect.php';

// Fetch all videos
$videos = $conn->query("SELECT * FROM videos");

// Fetch all students
$students = $conn->query("SELECT student_id, name FROM olevel_enrollments");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $video_id = $_POST['video_id'];
    $assigned_students = $_POST['student_ids']; // array

    foreach ($assigned_students as $student_id) {
        $stmt = $conn->prepare("INSERT INTO video_assign (video_id, student_id) VALUES (?, ?)");
        $stmt->bind_param("is", $video_id, $student_id);
        $stmt->execute();
    }

    echo "Video assigned successfully!";
}
?>

<form method="POST">
    <select name="video_id" required>
        <option value="">Select Video</option>
        <?php while($v = $videos->fetch_assoc()): ?>
            <option value="<?= $v['id'] ?>"><?= $v['title'] ?></option>
        <?php endwhile; ?>
    </select>

    <select name="student_ids[]" multiple required>
        <?php while($s = $students->fetch_assoc()): ?>
            <option value="<?= $s['student_id'] ?>"><?= $s['name'] ?></option>
        <?php endwhile; ?>
    </select>

    <button type="submit">Assign Video</button>
</form>
