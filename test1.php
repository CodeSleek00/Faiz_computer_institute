<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Homepage 2 | Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f5f6fa;
    margin: 0;
    padding: 0;
}
.container {
    width: 90%;
    margin: 30px auto;
}
.section-title {
    font-size: 26px;
    font-weight: 600;
    color: #333;
    margin: 40px 0 20px;
    position: relative;
}
.section-title::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 60px;
    height: 4px;
    background: #007bff;
    border-radius: 4px;
}
.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
}
.course-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: 0.3s;
}
.course-card:hover {
    transform: translateY(-6px);
}
.course-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}
.course-info {
    padding: 15px;
}
.course-info h4 {
    margin: 0;
    font-size: 18px;
    color: #222;
}
.course-info p {
    font-size: 14px;
    color: #555;
    margin-top: 6px;
}
.badge {
    display: inline-block;
    background: #007bff;
    color: white;
    padding: 3px 8px;
    font-size: 12px;
    border-radius: 6px;
    margin-top: 8px;
}
</style>
</head>
<body>

<div class="container">
    <?php
    // Function to display each section
    function showSection($title, $section, $conn) {
        $res = $conn->query("SELECT * FROM courses WHERE home_section2='$section'");
        if($res->num_rows > 0){
            echo "<h2 class='section-title'>$title</h2>";
            echo "<div class='course-grid'>";
            while($r = $res->fetch_assoc()){
                echo "<div class='course-card'>
                        <img src='../uploads/{$r['image']}' alt='{$r['course_name']}'>
                        <div class='course-info'>
                            <h4>{$r['course_name']}</h4>
                            <p>{$r['company']}</p>
                            <span class='badge'>".ucfirst($section)."</span>
                        </div>
                      </div>";
            }
            echo "</div>";
        }
    }

    // Show all 3 sections
    showSection("Popular Courses", "popular", $conn);
    showSection("Skill Development", "skills", $conn);
    showSection("More Courses", "free", $conn);
    ?>
</div>

</body>
</html>
