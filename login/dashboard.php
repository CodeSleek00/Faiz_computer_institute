<?php
session_start();
if (!isset($_SESSION['student_id'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Student Dashboard</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f6ff;
  padding: 40px;
  text-align: center;
}
.dashboard {
  background: #fff;
  padding: 40px;
  border-radius: 10px;
  display: inline-block;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
a {
  display: inline-block;
  margin-top: 20px;
  padding: 10px 15px;
  background: #dc3545;
  color: #fff;
  border-radius: 6px;
  text-decoration: none;
}
a:hover { background: #c82333; }
</style>
</head>
<body>

<div class="dashboard">
  <h2>Welcome, <?= htmlspecialchars($_SESSION['student_name']) ?></h2>
  <p>Your Student ID: <?= htmlspecialchars($_SESSION['student_id']) ?></p>
  <a href="logout.php">Logout</a>
</div>

</body>
</html>
