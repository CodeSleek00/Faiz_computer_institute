<?php
include '../db/db_connect.php';

// Get course ID safely
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch course
$course_stmt = $conn->prepare("SELECT * FROM university_courses WHERE id = ?");
$course_stmt->bind_param("i", $id);
$course_stmt->execute();
$course_result = $course_stmt->get_result();
$course = $course_result->fetch_assoc();
$course_stmt->close();

if(!$course){
    echo "<p>Course not found.</p>";
    exit;
}

// Fetch syllabus
$syllabus_stmt = $conn->prepare("SELECT * FROM university_course_syllabus WHERE course_id = ?");
$syllabus_stmt->bind_param("i", $id);
$syllabus_stmt->execute();
$syllabus_result = $syllabus_stmt->get_result();
$syllabus_stmt->close();

// Fetch documents
$documents_stmt = $conn->prepare("SELECT * FROM university_course_documents WHERE course_id = ?");
$documents_stmt->bind_param("i", $id);
$documents_stmt->execute();
$documents_result = $documents_stmt->get_result();
$documents_stmt->close();
?>

<h1><?= htmlspecialchars($course['course_name']) ?></h1>
<p><?= nl2br(htmlspecialchars($course['description'])) ?></p>
<p><strong>Duration:</strong> <?= htmlspecialchars($course['duration']) ?></p>

<h2>Syllabus</h2>
<?php if($syllabus_result->num_rows > 0){ ?>
<ul>
    <?php while($s = $syllabus_result->fetch_assoc()){ ?>
        <li><?= htmlspecialchars($s['syllabus_item']) ?></li>
    <?php } ?>
</ul>
<?php } else { echo "<p>No syllabus added yet.</p>"; } ?>

<h2>Documents</h2>

<h2>Syllabus</h2>
<?php if($syllabus_result->num_rows > 0){ ?>
<ul>
    <?php while($s = $syllabus_result->fetch_assoc()){ ?>
        <li><?= htmlspecialchars($s['document_name']) ?></li>
    <?php } ?>
</ul>
<?php } else { echo "<p>No Document added yet.</p>"; } ?>
