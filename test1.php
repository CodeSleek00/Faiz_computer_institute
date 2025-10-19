<?php include '../db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Homepage 2 | Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #eef4ff;
    margin: 0;
    padding: 0;
}
.main-container {
    display: flex;
    gap: 20px;
    padding: 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}
.section {
    flex: 1;
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.header {
    font-size: 22px;
    font-weight: 600;
    color: #222;
    border-bottom: 2px solid #eef4ff;
    margin-bottom: 15px;
}
.header span { color: #0066ff; }
.courses-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.course-pill {
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
.course-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-color: #0066ff;
}
.course-pill img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 12px;
}
.course-info h3 {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 600;
}
.course-info .provider {
    font-size: 13px;
    color: #555;
    margin-bottom: 4px;
}
.course-info .meta {
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}
.star { color: #f8b400; }
.empty-message {
    text-align: center;
    color: #888;
    font-style: italic;
    padding: 20px 0;
}

/* Mobile Styles */
@media (max-width: 768px) {
    .main-container {
        flex-direction: column;
        padding: 15px 20px;
    }
}
</style>
</head>
<body>

<div class="main-container">
<?php
function showSection2($title, $section, $conn) {
    echo "<div class='section'>
            <div class='header'>{$title} <span>→</span></div>
            <div class='courses-container'>";
    
    $courses = $conn->query("SELECT * FROM courses WHERE home_section2='$section' ORDER BY id DESC LIMIT 4");
    if($courses->num_rows == 0){
        echo "<div class='empty-message'>No courses added yet...</div>";
    } else {
        while($c = $courses->fetch_assoc()) {
            $image = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/80';
            $rating = 4.8;
            echo "
            <a class='course-pill' href='course_detail.php?id={$c['id']}'>
                <img src='{$image}' alt='{$c['course_name']}'>
                <div class='course-info'>
                    <span class='provider'>{$c['company']}</span>
                    <h3>{$c['course_name']}</h3>
                    <div class='meta'>Professional Certificate · <span class='star'>★</span> {$rating}</div>
                </div>
            </a>";
        }
    }
    echo "</div></div>";
}

// Show the 3 sections
showSection2("Popular Courses", "popular", $conn);
showSection2("Skill Development", "skills", $conn);
showSection2("More Courses", "free", $conn);
?>
</div>

</body>
</html>
