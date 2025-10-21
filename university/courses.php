<?php
include '../db/db_connect.php';
$courses = $conn->query("SELECT * FROM university_courses ORDER BY id DESC");
?>
<h1>University Courses</h1>
<div class="courses-list">
<?php while($row = $courses->fetch_assoc()){ ?>
    <div class="course-card">
        <img src="<?= $row['image'] ?>" width="150"><br>
        <strong><?= $row['course_name'] ?></strong><br>
        <em><?= $row['duration'] ?></em><br>
        <a href="view.php?id=<?= $row['id'] ?>">View Details</a>
    </div>
<?php } ?>
</div>
