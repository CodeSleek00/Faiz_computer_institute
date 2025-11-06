<?php
session_start();
if (isset($_SESSION['student_id'])) {
  header("Location: dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Student Login - O Level</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f6ff;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
.login-box {
  background: #fff;
  padding: 30px;
  width: 350px;
  border-radius: 10px;
  box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}
h2 {
  text-align: center;
  margin-bottom: 20px;
}
input {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}
button {
  width: 100%;
  padding: 10px;
  border: none;
  background: #007bff;
  color: #fff;
  font-weight: 600;
  border-radius: 6px;
  cursor: pointer;
}
button:hover {
  background: #0056b3;
}
.error {
  color: red;
  text-align: center;
  margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="login-box">
  <h2>Student Login</h2>
  <?php if (isset($_GET['error'])): ?>
    <div class="error"><?= htmlspecialchars($_GET['error']) ?></div>
  <?php endif; ?>
  <form method="POST" action="login_action.php">
    <input type="text" name="student_id" placeholder="Enter Student ID" required>
    <input type="password" name="password" placeholder="Enter Password" required>
    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>
