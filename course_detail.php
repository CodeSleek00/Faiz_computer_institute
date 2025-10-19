<?php 
include 'db_connect.php';
$id = $_GET['id'] ?? 0;
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();
$syllabus = $conn->query("SELECT * FROM course_syllabus WHERE course_id=$id");
$docs = $conn->query("SELECT * FROM course_documents WHERE course_id=$id");
$reviews = $conn->query("SELECT * FROM course_reviews WHERE course_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?= $course['course_name'] ?></title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f4f9;
    margin: 0;
    padding: 0;
}
.container {
    max-width: 900px;
    margin: 40px auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}
.course-image {
    width: 100%;
    height: 320px;
    border-radius: 10px;
    object-fit: cover;
}
h1 { color: #2b8a3e; }
ul { list-style: none; padding: 0; }
ul li::before {
    content: "✔ ";
    color: #2b8a3e;
}
.enroll-btn {
    background: #2b8a3e;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
}
.enroll-btn:hover { background: #256f33; }
.review-box {
    background: #f2f8f4;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="container">
    <img src="<?= !empty($course['image']) ? $course['image'] : 'https://via.placeholder.com/800x400' ?>" class="course-image">

    <h1><?= $course['course_name'] ?></h1>
    <p><?= nl2br($course['description']) ?></p>
    <p><b>Duration:</b> <?= $course['duration'] ?></p>
    <p><b>Company:</b> <?= $course['company'] ?></p>
    <p><b>Total Exams:</b> <?= $course['total_exams'] ?></p>

    <h3>Syllabus</h3>
    <ul>
    <?php while($s = $syllabus->fetch_assoc()) echo "<li>".$s['syllabus_item']."</li>"; ?>
    </ul>

    <h3>Documents</h3>
    <ul>
    <?php while($d = $docs->fetch_assoc()) echo "<li>".$d['document_name']."</li>"; ?>
    </ul>

    <h3>Reviews</h3>
    <?php 
    if($reviews->num_rows == 0) echo "<p>No reviews yet.</p>";
    while($r = $reviews->fetch_assoc()) {
        echo "<div class='review-box'><b>".$r['reviewer_name']."</b> ⭐".$r['rating']."<br>".$r['review_text']."</div>";
    }
    ?>

    <br>
    <button class="enroll-btn">Enroll Now</button>
</div>

</body>
</html>
