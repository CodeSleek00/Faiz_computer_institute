<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Homepage 2 | Courses</title>
<style>
/* ===== BODY ===== */
body {
    font-family: 'Poppins', sans-serif;
    background: #eef4ff;
    margin: 0;
    padding: 0;
}

/* ===== MAIN CONTAINER ===== */
.course-2-main-container {
    display: flex;
    gap: 20px;
    padding: 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}

/* ===== SECTION ===== */
.course-2-section {
    flex: 1;
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* ===== HEADER ===== */
.course-2-header {
    font-size: 22px;
    font-weight: 600;
    color: #222;
    border-bottom: 2px solid #eef4ff;
    margin-bottom: 15px;
}
.course-2-header span {
    color: #0066ff;
}

/* ===== COURSES CONTAINER ===== */
.course-2-courses-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* ===== COURSE PILL ===== */
.course-2-course-pill {
    display: flex;
    align-items: center;
    padding: 12px 14px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    text-decoration: none;
    color: #000;
    border: 1px solid #f0f0f0;
}
.course-2-course-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-color: #0066ff;
}

/* ===== IMAGE ===== */
.course-2-course-pill img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 12px;
}

/* ===== COURSE INFO ===== */
.course-2-course-info h3 {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 600;
}
.course-2-course-info .course-2-provider {
    font-size: 13px;
    color: #555;
    margin-bottom: 4px;
}
.course-2-course-info .course-2-meta {
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}
.course-2-star { color: #f8b400; }

/* ===== EMPTY MESSAGE ===== */
.course-2-empty-message {
    text-align: center;
    color: #888;
    font-style: italic;
    padding: 20px 0;
}

/* ===== MOBILE RESPONSIVE ===== */
@media (max-width: 768px) {
    .course-2-main-container {
        flex-direction: column;
        padding: 15px 20px;
    }
}
</style>
</head>
<body>

<div class="course-2-main-container">
<?php
function showSection2($title, $section, $conn) {
    echo "<div class='course-2-section'>
            <div class='course-2-header'>{$title} <span>→</span></div>
            <div class='course-2-courses-container'>";
    
    $courses = $conn->query("SELECT * FROM courses WHERE home_section2='$section' ORDER BY id DESC LIMIT 4");
    if($courses->num_rows == 0){
        echo "<div class='course-2-empty-message'>No courses added yet...</div>";
    } else {
        while($c = $courses->fetch_assoc()) {
            $image = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/80';
            $rating = 4.8;
            echo "
            <a class='course-2-course-pill' href='course_detail.php?id={$c['id']}'>
                <img src='{$image}' alt='{$c['course_name']}'>
                <div class='course-2-course-info'>
                    <span class='course-2-provider'>{$c['company']}</span>
                    <h3>{$c['course_name']}</h3>
                    <div class='course-2-meta'>Professional Certificate · <span class='course-2-star'>★</span> {$rating}</div>
                </div>
            </a>";
        }
    }
    echo "</div></div>";
}

// Display all 3 sections
showSection2("Popular Courses", "popular", $conn);
showSection2("Skill Development", "skills", $conn);
showSection2("More Courses", "free", $conn);
?>
</div>

</body>
</html>
