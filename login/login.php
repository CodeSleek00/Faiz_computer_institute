<?php
session_start();
if(isset($_SESSION['user_id'])){
  header("Location: portal.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Student Portal</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  body{font-family:'Poppins',sans-serif;background:#f3f6ff;display:flex;justify-content:center;align-items:center;height:100vh;margin:0}
  .login-box{background:#fff;padding:35px;border-radius:15px;box-shadow:0 8px 30px rgba(0,0,0,0.1);width:350px;text-align:center}
  h2{color:#3452ff;margin-bottom:20px}
  input{width:100%;padding:12px;margin:10px 0;border-radius:8px;border:1px solid #ccc;font-size:15px;outline:none}
  button{background:#3452ff;color:#fff;border:none;padding:12px;width:100%;border-radius:8px;font-size:16px;cursor:pointer}
  button:hover{background:#253bcc}
  .msg{color:red;font-size:14px}
  .footer{margin-top:15px;font-size:13px}
  a{text-decoration:none;color:#3452ff}
</style>
</head>
<body>
<div class="login-box">
  <h2>Student Login</h2>
  <form action="login_action.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <button type="submit">Login</button>
  </form>
  <?php
  if(isset($_GET['error'])){
    echo '<p class="msg">Invalid email or phone number</p>';
  }
  ?>
  <div class="footer">
    <p>Not enrolled yet? <a href="enroll.php">Enroll Now</a></p>
  </div>
</div>
</body>
</html>
