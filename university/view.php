<?php
include '../db/db_connect.php';
$id = $_GET['id'];
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();

$syllabus = $conn->query("SELECT * FROM course_syllabus WHERE course_id=$id");
$documents = $conn->query("SELECT * FROM course_documents WHERE course_id=$id");
?>

<h1><?= $course['course_name'] ?></h1>
<p><?= $course['description'] ?></p>
<p><strong>Duration:</strong> <?= $course['duration'] ?></p>

<h2>Syllabus</h2>
<ul>
<?php while($s = $syllabus->fetch_assoc()){ ?>
    <li><?= $s['syllabus_item'] ?></li>
<?php } ?>
</ul>

<h2>Documents</h2>
<ul>
<?php while($d = $documents->fetch_assoc()){ ?>
    <li><a href="uploads/documents/<?= $d['document_name'] ?>" target="_blank"><?= $d['document_name'] ?></a></li>
<?php } ?>
</ul>
