<?php
include '../db/db_connect.php';

$categories = ['Graduation', 'Post Graduation', 'Diploma'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Courses</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
    * {margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
    body {background:#f7f8fa;color:#333;}
    .container {max-width:1200px;margin:60px auto;padding:0 20px;}
    h1 {text-align:center;font-size:2rem;margin-bottom:40px;}
    .course-section {margin-bottom:60px;}
    .section-header {display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
    .section-header h2 {font-size:1.5rem;color:#333;}
    .course-grid {display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;}
    .course-card {
        background:white;
        border-radius:16px;
        box-shadow:0 3px 10px rgba(0,0,0,0.1);
        padding:20px;
        transition:all 0.3s ease;
    }
    .course-card:hover {transform:translateY(-5px);box-shadow:0 5px 15px rgba(0,0,0,0.15);}
    .course-card h3 {font-size:1.1rem;margin-bottom:10px;color:#222;}
    .course-card p {font-size:0.9rem;color:#555;margin-bottom:10px;}
    .course-card .duration {font-size:0.85rem;color:#777;}
    .show-more-btn {
        background:#007bff;
        color:white;
        padding:10px 20px;
        border:none;
        border-radius:8px;
        font-size:0.9rem;
        cursor:pointer;
        transition:0.3s;
    }
    .show-more-btn:hover {background:#0056b3;}
    @media(max-width:600px){
        h1{font-size:1.6rem;}
        .course-card{padding:15px;}
    }
</style>
</head>
<body>

<div class="container">
    <h1>Explore Our Courses</h1>

    <?php foreach($categories as $category): 
        $courses = $conn->query("SELECT * FROM university_courses WHERE category='$category' LIMIT 3");
    ?>
    <div class="course-section">
        <div class="section-header">
            <h2><?= $category ?></h2>
            <button class="show-more-btn" onclick="window.location.href='courses.php?category=<?= urlencode($category) ?>'">Show More</button>
        </div>

        <div class="course-grid">
            <?php while($c = $courses->fetch_assoc()): ?>
            <div class="course-card">
                <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                <p><?= substr($c['description'], 0, 80) ?>...</p>
                <p class="duration"><strong>Duration:</strong> <?= $c['duration'] ?></p>
                <a href="course_detail.php?id=<?= $c['id'] ?>" style="color:#007bff;text-decoration:none;">View Details →</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>
