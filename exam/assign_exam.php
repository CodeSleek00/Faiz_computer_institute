<?php
session_start();
require '../db_connect.php';
$exam_id = $_GET['exam_id'];

// Fetch all students
$students = $conn->query("SELECT id, name FROM students"); // your student table

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_students = $_POST['students']; // array of student_ids
    foreach($selected_students as $sid) {
        // Check if already assigned
        $check = $conn->query("SELECT * FROM exam_assignments WHERE exam_id=$exam_id AND student_id='$sid'");
        if($check->num_rows == 0){
            $stmt = $conn->prepare("INSERT INTO exam_assignments (exam_id, student_id) VALUES (?,?)");
            $stmt->bind_param("is", $exam_id, $sid);
            $stmt->execute();
        }
    }
    echo "Exam assigned successfully!";
}
?>

<h2>Assign Exam</h2>
<form method="POST">
    <?php while($s = $students->fetch_assoc()): ?>
        <input type="checkbox" name="students[]" value="<?= $s['id'] ?>"> <?= htmlspecialchars($s['name']) ?><br>
    <?php endwhile; ?>
    <button type="submit">Assign Exam</button>
</form>
