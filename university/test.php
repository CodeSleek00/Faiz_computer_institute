<?php
include '../db/db_connect.php';

function showCourseSection($conn, $category, $limit = 4) {
    $courses = $conn->query("SELECT * FROM university_courses WHERE category='$category' LIMIT $limit");
    ?>
    <div class="courses-university-section">
        <div class="courses-university-header">
            <h2><?= htmlspecialchars($category) ?></h2>
            <button class="courses-university-show-more-btn" onclick="window.location.href='courses.php?category=<?= urlencode($category) ?>'">Show More</button>
        </div>

        <div class="courses-university-carousel">
            <?php while($c = $courses->fetch_assoc()):
                $imagePath = !empty($c['image']) && file_exists("../uploads/".$c['image']) 
                    ? "../uploads/".$c['image'] 
                    : "../uploads/default.jpg";
            ?>
            <div class="courses-university-card">
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($c['course_name']) ?>">
                <div class="courses-university-content">
                    <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                    <p><?= substr($c['description'], 0, 80) ?>...</p>
                    <p class="courses-university-duration"><strong>Duration:</strong> <?= $c['duration'] ?></p>
                    <a href="view.php?id=<?= $c['id'] ?>" class="courses-university-view-link">View Details →</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
}
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
.courses-university-container {max-width:1200px;margin:60px auto;padding:0 20px;}
.courses-university-title {text-align:center;font-size:2rem;margin-bottom:40px;}

/* Course Section */
.courses-university-section {margin-bottom:60px;}
.courses-university-header {display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.courses-university-header h2 {font-size:1.5rem;color:#333;}
.courses-university-show-more-btn {
    background:#007bff;color:white;padding:10px 20px;border:none;border-radius:8px;font-size:0.9rem;cursor:pointer;transition:0.3s;
}
.courses-university-show-more-btn:hover {background:#0056b3;}

/* Carousel */
.courses-university-carousel {
    display:flex;
    gap:20px;
    overflow-x:auto;
    scroll-behavior:smooth;
    padding-bottom:10px;
}
.courses-university-carousel::-webkit-scrollbar {height:8px;}
.courses-university-carousel::-webkit-scrollbar-thumb {background:#ccc;border-radius:4px;}
.courses-university-carousel::-webkit-scrollbar-track {background:#f0f0f0;border-radius:4px;}

/* Card - 4 per view */
.courses-university-card {
    flex: 0 0 calc((100% - 60px)/4); /* 4 cards per row + 3 gaps */
    background:white;
    border-radius:16px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    overflow:hidden;
    transition:all 0.3s ease;
}
.courses-university-card:hover {transform:translateY(-5px);box-shadow:0 5px 15px rgba(0,0,0,0.15);}
.courses-university-card img {width:100%;height:160px;object-fit:cover;}
.courses-university-content {padding:20px;}
.courses-university-content h3 {font-size:1.1rem;margin-bottom:10px;color:#222;}
.courses-university-content p {font-size:0.9rem;color:#555;margin-bottom:10px;}
.courses-university-duration {font-size:0.85rem;color:#777;}
.courses-university-view-link {color:#007bff;text-decoration:none;font-weight:500;}
.courses-university-view-link:hover {text-decoration:underline;}

/* Path Section */
.courses-university-path-container {
    display:flex;
    flex-wrap:wrap;
   
    border-radius:16px;
    padding:40px;}
.courses-university-path-left {flex:1;min-width:280px;margin-right:20px;}
.courses-university-path-left h1 {font-size:2rem;margin-bottom:10px;}
.courses-university-path-left p {font-size:1rem;color:#555;}
.courses-university-path-right {flex:1;min-width:280px;}
.courses-university-path-right p {font-size:1rem;color:#333;margin-bottom:20px;}
.courses-university-path-btn {
    background:#007bff;color:white;padding:10px 20px;border:none;border-radius:25px;font-size:1rem;cursor:pointer;transition:0.3s;
}
.courses-university-path-btn:hover {background:#0056b3;}

/* Responsive */
@media(max-width:900px){
    .courses-university-card { flex: 0 0 calc((100% - 40px)/2); } /* 2 cards */
}
@media(max-width:600px){
    .courses-university-title{font-size:1.6rem;}
    .courses-university-card { flex: 0 0 100%; } /* 1 card */
    .courses-university-path-container {flex-direction:column;}
    .courses-university-path-left, .courses-university-path-right {margin-right:0;margin-bottom:20px;}
}
</style>
</head>
<body>

<div class="courses-university-container">
    <h1 class="courses-university-title">Explore Our Courses</h1>

    <?php 
    showCourseSection($conn, 'Graduation'); 
    ?>

    <div class="courses-university-path-container">
        <div class="courses-university-path-left">
            <h1>Your Path<br>to Wellness</h1>
            <p>Explore your inner world and gain insights</p>
        </div>
        <div class="courses-university-path-right">
            <p>We believe in the transformative power of therapy. Our compassionate team of experienced therapists is here to guide you on your journey toward healing, growth, and self-discovery.</p>
            <button class="courses-university-path-btn">Book Appointment</button>
        </div>
    </div>

    <?php 
    showCourseSection($conn, 'Diploma'); 
    showCourseSection($conn, 'Post Graduation'); 
    ?>
</div>

</body>
</html>
