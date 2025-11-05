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
<title>Enrollment Successful - Thank You</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #eaf0ff, #ffffff);
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
  margin: 0;
}
.container {
  background: #fff;
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 12px 40px rgba(30,50,120,0.08);
  max-width: 700px;
  width: 100%;
  text-align: left;
  position: relative;
  overflow: hidden;
}
h1 {
  color: #2e48d5;
  font-size: 26px;
  display: flex;
  align-items: center;
  gap: 8px;
}
p {
  color: #555;
  font-size: 15px;
  margin: 6px 0;
}
.details {
  background: #f7f9ff;
  border: 1px solid #e4e9ff;
  padding: 20px;
  border-radius: 15px;
  margin-top: 20px;
}
.details p strong {
  color: #111;
}
.grid {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 12px;
}
.box {
  flex: 1 1 45%;
  background: #fff;
  border: 1px solid #eef2ff;
  border-radius: 12px;
  padding: 12px;
}
.label {
  font-size: 13px;
  color: #777;
}
.value {
  font-weight: 600;
  color: #111;
  margin-top: 4px;
}
.buttons {
  margin-top: 22px;
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
}
button {
  background: #4a63ff;
  color: #fff;
  border: none;
  padding: 10px 18px;
  border-radius: 10px;
  cursor: pointer;
  font-size: 15px;
  font-weight: 600;
  transition: 0.3s;
}
button:hover {
  background: #2e48d5;
}
button.secondary {
  background: #eef3ff;
  color: #2e48d5;
}
.receipt {
  background: linear-gradient(180deg, #fff, #fcfdff);
  border: 1px solid #f0f4ff;
  border-radius: 12px;
  padding: 14px;
  margin-top: 20px;
}
@media (max-width:600px) {
  .box { flex: 1 1 100%; }
}
</style>
</head>
<body>
<div class="container">
  <h1>🎉 Enrollment Successful!</h1>
  <p>Thank you for enrolling, <strong><?= htmlspecialchars($data['name']) ?></strong>!</p>

  <div class="details">
    <div class="grid">
      <div class="box">
        <div class="label">Enrollment ID</div>
        <div class="value"><?= htmlspecialchars($data['student_id']) ?></div>
      </div>
      <div class="box">
        <div class="label">Plan</div>
        <div class="value"><?= htmlspecialchars($data['plan']) ?></div>
      </div>
      <div class="box">
        <div class="label">Amount Paid</div>
        <div class="value">₹<?= htmlspecialchars($data['amount']) ?></div>
      </div>
      <div class="box">
        <div class="label">Login Email</div>
        <div class="value"><?= htmlspecialchars($data['email']) ?></div>
      </div>
      <div class="box">
        <div class="label">Password</div>
        <div class="value"><?= htmlspecialchars($data['password']) ?></div>
      </div>
    </div>

    <div class="receipt">
      <strong>Faiz Computer</strong><br>
      <span style="font-size:13px;color:#777;">Enrollment Receipt • <?= date('d M Y, H:i') ?></span>
      <hr style="margin:10px 0;border:none;border-top:1px solid #eef2ff">
      <p><strong>Name:</strong> <?= htmlspecialchars($data['name']) ?></p>
      <p><strong>Plan:</strong> <?= htmlspecialchars($data['plan']) ?></p>
      <p><strong>Enrollment ID:</strong> <?= htmlspecialchars($data['student_id']) ?></p>
      <p><strong>Amount Paid:</strong> ₹<?= htmlspecialchars($data['amount']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($data['email']) ?></p>
    </div>
  </div>

  <div class="buttons">
    <button onclick="window.print()">🧾 Print / Save Receipt</button>
    <button class="secondary" onclick="window.location.href='index.php'">🏠 Go Home</button>
  </div>
</div>

<script>
// Smooth confetti celebration
(function launchConfetti(){
  const duration = 2.5 * 1000;
  const end = Date.now() + duration;
  (function frame(){
    confetti({
      particleCount: 5,
      angle: 60,
      spread: 55,
      origin: { x: 0 }
    });
    confetti({
      particleCount: 5,
      angle: 120,
      spread: 55,
      origin: { x: 1 }
    });
    if(Date.now() < end) requestAnimationFrame(frame);
  })();
})();
</script>
</body>
</html>
