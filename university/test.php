<?php
include '../db/db_connect.php';

function showCourseSection($conn, $category, $limit = 3) {
    $courses = $conn->query("SELECT * FROM university_courses WHERE category='$category' LIMIT $limit");
    ?>

    <div class="course-section">
        <div class="section-header">
            <h2><?= htmlspecialchars($category) ?></h2>
            <button class="show-more-btn" onclick="window.location.href='courses.php?category=<?= urlencode($category) ?>'">Show More</button>
        </div>

        <div class="course-grid">
            <?php while($c = $courses->fetch_assoc()): 
                $imagePath = !empty($c['image']) && file_exists("../uploads/".$c['image']) 
                    ? "../uploads/".$c['image'] 
                    : "../uploads/default.jpg";
            ?>
            <div class="course-card">
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($c['course_name']) ?>">
                <div class="course-content">
                    <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                    <p><?= substr($c['description'], 0, 80) ?>...</p>
                    <p class="duration"><strong>Duration:</strong> <?= $c['duration'] ?></p>
                    <a href="view.php?id=<?= $c['id'] ?>" class="view-link">View Details →</a>
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
.container {max-width:1200px;margin:60px auto;padding:0 20px;}
h1 {text-align:center;font-size:2rem;margin-bottom:40px;}
.course-section {margin-bottom:60px;}
.section-header {display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;}
.section-header h2 {font-size:1.5rem;color:#333;}
.course-grid {
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:20px;
}
.course-card {
    background:white;
    border-radius:16px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    overflow:hidden;
    transition:all 0.3s ease;
}
.course-card:hover {
    transform:translateY(-5px);
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
}
.course-card img {
    width:100%;
    height:180px;
    object-fit:cover;
}
.course-content {padding:20px;}
.course-content h3 {font-size:1.1rem;margin-bottom:10px;color:#222;}
.course-content p {font-size:0.9rem;color:#555;margin-bottom:10px;}
.duration {font-size:0.85rem;color:#777;}
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
a.view-link {
    color:#007bff;
    text-decoration:none;
    font-weight:500;
}
a.view-link:hover {text-decoration:underline;}
@media(max-width:600px){
    h1{font-size:1.6rem;}
}
 .path {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #fff;
      padding: 40px;
    }

    .path-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1000px;
      width: 100%;
      flex-wrap: wrap;
      gap: 40px;
    }

    .path-left {
      flex: 1;
      min-width: 280px;
    }

    .path-left h1 {
      font-size: 3.2rem;
      font-weight: 700;
      line-height: 1.2;
      color: #000;
    }

    .path-left p {
      margin-top: 10px;
      color: #555;
      font-size: 0.95rem;
    }

    .path-right {
      flex: 1;
      min-width: 280px;
    }

    .path-right p {
      color: #555;
      line-height: 1.6;
      font-size: 1rem;
      margin-bottom: 25px;
    }

    .path-btn {
      background-color: #000;
      color: #fff;
      padding: 12px 28px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .path-btn:hover {
      background-color: #333;
      transform: translateY(-2px);
    }

    @media (max-width: 768px) {
      .path-container {
        flex-direction: column;
        text-align: center;
      }

      .path-left h1 {
        font-size: 2.2rem;
      }
    }
</style>
</head>
<body>

<div class="container">
    <h1>Explore Our Courses</h1>

    <?php 
    // You can freely reorder or add more categories here
    showCourseSection($conn, 'Graduation'); 

    echo '
    <div class="path">
  <div class="path-container">
    <div class="path-left">
      <h1>Your Path<br>to Wellness</h1>
      <p>Explore your inner world and gain insights</p>
    </div>

    <div class="path-right">
      <p>We believe in the transformative power of therapy. Our compassionate team of experienced therapists is here to guide you on your journey toward healing, growth, and self-discovery.</p>
      <button class="path-btn">Book Appointment</button>
    </div>
  </div></div>'; // This line now properly stays inside the container

    showCourseSection($conn, 'Diploma'); 
    showCourseSection($conn, 'Post Graduation'); 
    ?>
</div>

</body>
</html>
