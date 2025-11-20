<?php 
include 'db/db_connect.php';

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses ORDER BY id DESC");
?>
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
        padding: 20px;
    }
    .course-card {
        background: #fff;
        padding: 18px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: flex;
        gap: 20px;
        align-items: center;
    }
    .course-card img {
        width: 180px;
        height: 120px;
        border-radius: 10px;
        object-fit: cover;
    }
    .course-info h2 {
        margin: 0;
        color: #2b8a3e;
        font-size: 22px;
    }
    .company {
        color: #555;
        margin-top: 5px;
        font-size: 15px;
    }
    .btn {
        display: inline-block;
        background: #2b8a3e;
        color: white;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        margin-top: 10px;
    }
    .btn:hover {
        background: #256f33;
    }
</style>

</head>
<body>

<h1 style="text-align:center; color:#2b8a3e;">All Courses</h1>
<br>

<?php while($row = $courses->fetch_assoc()) { ?>

<div class="course-card">

    <!-- Course Image -->
    <img src="uploads/<?php echo $row['image']; ?>" alt="Course Image">

    <!-- Course Info -->
    <div class="course-info">
        <h2><?php echo $row['course_name']; ?></h2>

        <div class="company">Company: <b><?php echo $row['company']; ?></b></div>

        <!-- View Details Button -->
        <a href="course_details.php?id=<?php echo $row['id']; ?>" class="btn">
            View Details
        </a>
    </div>

</div>

<?php } ?>

</body>
</html>
