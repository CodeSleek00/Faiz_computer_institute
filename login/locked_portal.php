<?php
session_start();
$student_name = $_SESSION['student_name'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Portal Locked</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #e3f2fd;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  flex-direction: column;
  color: #0d47a1;
}
.lock-box {
  background: white;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 0 20px rgba(0,0,0,0.1);
  max-width: 400px;
}
.lock-box h2 {
  color: #1565c0;
  margin-bottom: 10px;
}
.lock-box p {
  margin-bottom: 20px;
  font-size: 15px;
}
.call-btn {
  background: #1976d2;
  color: white;
  text-decoration: none;
  padding: 12px 20px;
  border-radius: 8px;
  font-weight: 500;
}
.call-btn:hover {
  background: #0d47a1;
}
</style>
</head>
<body>

<div class="lock-box">
  <h2>🔒 The Portal is Locked</h2>
  <p>Dear <?= htmlspecialchars($student_name) ?>, your portal is temporarily locked.<br>
  Please contact the admin to unlock your account.</p>
  <a href="tel:+919876543210" class="call-btn">📞 Call Now</a>
</div>

<script>
// --- Auto check unlock status ---
(function(){
  const CHECK_URL = 'check_lock_status.php';
  const DASHBOARD_URL = 'dashboard.php';
  const POLL_INTERVAL = 3000; // 3 seconds

  async function checkUnlock() {
    try {
      const resp = await fetch(CHECK_URL, {cache: 'no-store'});
      const data = await resp.json();
      if (data.is_locked === false && data.logged_in === true) {
        // Unlocked, redirect to dashboard
        window.location.href = DASHBOARD_URL;
      }
    } catch (err) {
      // ignore network errors
    }
  }

  // Run every 3s
  setInterval(checkUnlock, POLL_INTERVAL);
  checkUnlock();
})();
</script>

</body>
</html>
