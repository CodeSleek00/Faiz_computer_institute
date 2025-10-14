<?php
include '../db/db_connect.php';

if (isset($_POST['add_course'])) {
    $name = $_POST['course_name'];
    $duration = $_POST['duration'];
    $details = $_POST['details'];
    $fees = $_POST['fees'];
    $topics = $_POST['topics'];
    $total_videos = $_POST['total_videos'];
    $assessments = $_POST['assessments'];

    // Upload image
    $target_dir = "uploads/";
    if (!file_exists($target_dir)) mkdir($target_dir);
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert into DB
    $sql = "INSERT INTO courses (course_name, duration, details, image, fees, topics, total_videos, assessments)
            VALUES ('$name', '$duration', '$details', '$target_file', '$fees', '$topics', '$total_videos', '$assessments')";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Course added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Course</title>
<style>
body {
  font-family: "Poppins", sans-serif;
  background: #f7f9fc;
  padding: 40px;
}
form {
  background: white;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(0,0,0,0.1);
  max-width: 500px;
  margin: auto;
}
input, textarea {
  width: 100%;
  margin: 10px 0;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
}
button {
  background: #2563eb;
  color: white;
  border: none;
  padding: 12px 18px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
}
button:hover {
  background: #1d4ed8;
}
</style>
</head>
<body>
  <h2 align="center">Add New Course</h2>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="course_name" placeholder="Course Name" required>
    <input type="text" name="duration" placeholder="Duration (e.g., 3 Months)" required>
    <textarea name="details" placeholder="Course Details" required></textarea>
    <input type="number" step="0.01" name="fees" placeholder="Course Fees" required>
    <textarea name="topics" placeholder="Topics (comma separated)" required></textarea>
    <input type="number" name="total_videos" placeholder="Total Videos" required>
    <input type="number" name="assessments" placeholder="No. of Assessments" required>
    <input type="file" name="image" accept="image/*" required>
    <button type="submit" name="add_course">Add Course</button>
  </form>
</body>
</html>
