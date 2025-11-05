<?php
session_start();
if (!isset($_SESSION['enroll_success'])) {
    header("Location: index.php");
    exit;
}
$data = $_SESSION['enroll_success'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enrollment Successful</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #edf0ff, #ffffff);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
}
.container {
  background: #fff;
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  max-width: 600px;
  width: 100%;
  text-align: center;
  position: relative;
}
h1 {
  color: #2e48d5;
  font-size: 26px;
}
p {
  color: #555;
  font-size: 15px;
}
.details {
  background: #f7f9ff;
  border: 1px solid #e4e9ff;
  padding: 20px;
  border-radius: 15px;
  text-align: left;
  margin-top: 20px;
}
.details strong {
  color: #333;
}
button {
  background: #4a63ff;
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 10px;
  margin-top: 20px;
  cursor: pointer;
  font-size: 15px;
  transition: 0.3s;
}
button:hover {
  background: #2e48d5;
}
</style>
</head>
<body>
<div class="container">
  <h1>🎉 Enrollment Successful!</h1>
  <p>Thank you for enrolling, <strong><?= htmlspecialchars($data['name']) ?></strong>!</p>
  
  <div class="details">
    <p><strong>Enrollment ID:</strong> <?= htmlspecialchars($data['student_id']) ?></p>
    <p><strong>Plan:</strong> <?= htmlspecialchars($data['plan']) ?></p>
    <p><strong>Amount Paid:</strong> ₹<?= htmlspecialchars($data['amount']) ?></p>
    <p><strong>Payment ID:</strong> <?= htmlspecialchars($data['payment_id']) ?></p>
    <p><strong>Login Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
    <p><strong>Password:</strong> <?= htmlspecialchars($data['password']) ?></p>
  </div>

  <button onclick="window.print()">🧾 Print Receipt</button>
  <button onclick="window.location.href='index.php'">🏠 Go Home</button>
</div>

<script>
// Confetti burst
function confettiBurst() {
  var duration = 3 * 1000;
  var end = Date.now() + duration;
  (function frame() {
    confetti({
      particleCount: 4,
      angle: 60,
      spread: 55,
      origin: { x: 0 },
    });
    confetti({
      particleCount: 4,
      angle: 120,
      spread: 55,
      origin: { x: 1 },
    });
    if (Date.now() < end) requestAnimationFrame(frame);
  })();
}
confettiBurst();
</script>
</body>
</html>
