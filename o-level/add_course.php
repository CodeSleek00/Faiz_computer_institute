<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $type = $_POST['type'];
  $total_videos = $_POST['total_videos'];
  $price = $_POST['price'];
  $description = $_POST['description']; // comma separated

  $image = "";
  if (!empty($_FILES['image']['name'])) {
    $target = "uploads/" . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $image = $target;
  }

  $conn->query("INSERT INTO single_courses (name, type, total_videos, price, description, image) 
  VALUES ('$name','$type','$total_videos','$price','$description','$image')");
  echo "<script>alert('Course Added Successfully!');window.location='add_course.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Single Course</title>
<style>
body{font-family:Poppins,sans-serif;padding:40px;background:#f5f7fa;}
form{background:#fff;padding:30px;border-radius:20px;max-width:600px;margin:auto;box-shadow:0 4px 20px rgba(0,0,0,0.1);}
input,textarea,select{width:100%;padding:10px;margin:10px 0;border:1px solid #ccc;border-radius:8px;}
button{background:#000;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;}
h2{text-align:center;margin-bottom:20px;}
small{display:block;margin-top:-5px;color:#666;font-size:13px;}
</style>
</head>
<body>
<h2>Add Single Course</h2>
<form method="POST" enctype="multipart/form-data">
  <input type="text" name="name" placeholder="Course Name" required>
  <input type="text" name="type" placeholder="Type (Online/Offline)">
  <input type="number" name="total_videos" placeholder="Total Videos (e.g. 25)" required>
  <input type="number" step="0.01" name="price" placeholder="Price (INR)" required>
  <textarea name="description" placeholder="Enter course points separated by commas (e.g. Learn Basics, Practice Exercises, Get Certified)" rows="4"></textarea>
  <input type="file" name="image">
  <button type="submit">Add Course</button>
</form>
</body>
</html>
