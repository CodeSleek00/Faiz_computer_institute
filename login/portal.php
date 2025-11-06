<?php
session_start();
if(!isset($_SESSION['user_id'])){
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Student Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  body{font-family:'Poppins',sans-serif;background:#eef3ff;margin:0;padding:0}
  header{background:#3452ff;color:#fff;padding:15px 20px;display:flex;justify-content:space-between;align-items:center}
  header h2{margin:0;font-size:20px}
  .content{padding:30px;text-align:center}
  a.logout{color:#fff;background:#ff4d4d;padding:8px 16px;border-radius:6px;text-decoration:none}
  a.logout:hover{background:#e03d3d}
</style>
</head>
<body>
<header>
  <h2>Welcome, <?= htmlspecialchars($_SESSION['user_name']); ?> 👋</h2>
  <a href="logout.php" class="logout">Logout</a>
</header>

<div class="content">
  <h3>🎉 Enrollment Successful!</h3>
  <p>You have successfully logged in to your student portal.</p>
  <p>More features (like assignments, study material, and tests) will appear here soon.</p>
</div>
</body>
</html>
