<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f4f9;
    margin: 0;
    padding: 0;
}
.header {
    text-align: center;
    padding: 30px;
    background: #2b8a3e;
    color: white;
    font-size: 26px;
    font-weight: bold;
}
.pill-strip {
    display: flex;
    overflow-x: auto;
    gap: 10px;
    background: white;
    padding: 15px 20px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
.pill {
    flex: 0 0 auto;
    background: #e7f3ec;
    color: #2b8a3e;
    padding: 8px 16px;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 500;
    border: 1px solid #2b8a3e;
    transition: 0.3s;
}
.pill:hover {
    background: #2b8a3e;
    color: white;
}
.course-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    padding: 40px;
}
.course-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    overflow: hidden;
    transition: transform 0.3s;
}
.course-card:hover {
    transform: translateY(-5px);
}
.course-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.card-body {
    padding: 15px;
}
h3 {
    margin: 0;
    font-size: 20px;
}
.rating {
    color: gold;
}
.enroll-btn {
    background: #2b8a3e;
    color: white;
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    margin-top: 10px;
    cursor: pointer;
}
</style>
</head>
<body>

<div class="header">Our Courses</div>

<div class="pill-strip">
<?php
$courses = $conn->query("SELECT * FROM courses ORDER BY id DESC");
while($c = $courses->fetch_assoc()) {
    echo '<a class="pill" href="course_detail.php?id='.$c['id'].'">'.$c['course_name'].'</a>';
}
?>
</div>

<div class="course-list">
<?php
$courses->data_seek(0);
while($row = $courses->fetch_assoc()) {
    $image = !empty($row['image']) ? $row['image'] : 'https://via.placeholder.com/400x250';
    echo "
    <div class='course-card'>
        <img src='{$image}' alt='{$row['course_name']}'>
        <div class='card-body'>
            <h3>{$row['course_name']}</h3>
            <p>{$row['description']}</p>
            <a href='course_detail.php?id={$row['id']}'><button class='enroll-btn'>View Details</button></a>
        </div>
    </div>";
}
?>
</div>

</body>
</html>
