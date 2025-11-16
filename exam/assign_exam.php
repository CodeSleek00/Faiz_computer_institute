<?php
require '../db_connect.php';
$exam_id = intval($_GET['exam_id']);

// Fetch students
$students = $conn->query("SELECT id,name FROM students");

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $selected = $_POST['students'] ?? [];
    foreach($selected as $sid){
        $check = $conn->query("SELECT * FROM exam_assignments WHERE exam_id=$exam_id AND student_id=$sid");
        if($check->num_rows == 0){
            $stmt = $conn->prepare("INSERT INTO exam_assignments (exam_id, student_id) VALUES (?,?)");
            $stmt->bind_param("ii",$exam_id,$sid);
            $stmt->execute();
        }
    }
    echo "<p>Exam assigned successfully!</p>";
}
?>

<h2>Assign Exam to Students</h2>
<form method="POST">
<?php while($s=$students->fetch_assoc()): ?>
    <input type="checkbox" name="students[]" value="<?= $s['id'] ?>"> <?= htmlspecialchars($s['name']) ?><br>
<?php endwhile; ?>
<button type="submit">Assign Exam</button>
</form>
