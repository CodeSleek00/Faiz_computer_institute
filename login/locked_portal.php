<?php
session_start();
// Optional: keep student_name for showing message, then destroy session
$student_name = $_SESSION['student_name'] ?? '';
// Do NOT destroy if you want them to be able to return without login after unlocking
// But it's safer to destroy session so they must re-login after unlock
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<!-- the rest of your locked_portal HTML -->

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Portal Locked</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #e9f3ff;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
}
.container {
  text-align: center;
  background: #fff;
  padding: 40px 30px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  max-width: 400px;
}
.icon {
  font-size: 60px;
  color: #007bff;
}
h2 {
  color: #007bff;
  margin-bottom: 10px;
}
p {
  color: #333;
  margin-bottom: 25px;
  font-size: 16px;
}
a.call-btn {
  display: inline-block;
  padding: 12px 20px;
  background: #007bff;
  color: #fff;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: background 0.3s;
}
a.call-btn:hover {
  background: #0056b3;
}
</style>
</head>
<body>

<div class="container">
  <div class="icon">🔒</div>
  <h2>Portal Locked</h2>
  <p>Dear <?= htmlspecialchars($name) ?>,<br>The portal is currently locked.<br>Please contact the administrator for assistance.</p>
  <a href="tel:+919876543210" class="call-btn">📞 Call Admin: +91 98765 43210</a>
</div>

</body>
</html>
