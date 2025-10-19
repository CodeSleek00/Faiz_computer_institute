<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Our Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #eef4ff;
    margin: 0;
    padding: 0;
}
.section {
    margin-bottom: 50px;
}
.header {
    text-align: left;
    padding: 25px 40px;
    font-size: 26px;
    font-weight: 600;
    color: #222;
}
.header span {
    color: #0066ff;
}
.scroll-container {
    display: flex;
    overflow-x: auto;
    gap: 18px;
    padding: 20px 40px;
    scroll-snap-type: x mandatory;
}
.scroll-container::-webkit-scrollbar {
    display: none;
}
.course-pill {
    flex: 0 0 auto;
    width: 340px;
    background: #fff;
    border-radius: 16px;
    display: flex;
    align-items: center;
    padding: 12px 14px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    scroll-snap-align: start;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: #000;
}
.course-pill:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.course-pill img {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    object-fit: cover;
    margin-right: 14px;
}
.course-info {
    display: flex;
    flex-direction: column;
}
.course-info h3 {
    margin: 0;
    font-size: 17px;
    font-weight: 600;
}
.course-info .provider {
    color: #555;
    font-size: 14px;
}
.course-info .meta {
    font-size: 13px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}
.star {
    color: #f8b400;
    font-size: 15px;
}
</style>
</head>
<body>

<?php
function showSection($title, $section, $conn) {
    echo "<div class='section'>
            <div class='header'>{$title} <span>→</span></div>
            <div class='scroll-container'>";
    
    $courses = $conn->query("SELECT * FROM courses WHERE home_section='$section' ORDER BY id DESC");
    if($courses->num_rows == 0){
        echo "<p style='padding: 0 40px; color: gray;'>No courses added yet...</p>";
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
?>

<?php
showSection("Popular Courses", "popular", $conn);
showSection("Skill Development", "skills", $conn);
showSection("Free Courses", "free", $conn);
?>

</body>
</html>
