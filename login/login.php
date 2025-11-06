<?php
session_start();
if(isset($_SESSION['user_id'])){
  header("Location: portal.php");
  exit;
}
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Login - Student Portal</title>
<style>
  body{font-family:Arial, sans-serif;background:#f3f6ff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
  .box{background:#fff;padding:30px;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,0.08);width:360px}
  input{width:100%;padding:10px;margin:8px 0;border-radius:6px;border:1px solid #ccc}
  button{width:100%;padding:10px;background:#3452ff;color:#fff;border:none;border-radius:6px;cursor:pointer}
  .err{color:#c0392b;margin-top:8px}
</style>
</head>
<body>
<div class="box">
  <h2>Student Login</h2>
  <form action="login_action.php" method="POST">
    <input type="text" name="student_id" placeholder="Student ID (e.g. OLEV20250001)" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
  <?php if($error): ?>
    <p class="err">Invalid Student ID or Password</p>
  <?php endif; ?>
  <p style="margin-top:12px;font-size:14px;">Not enrolled? <a href="enroll.php">Enroll Now</a></p>
</div>
</body>
</html>
