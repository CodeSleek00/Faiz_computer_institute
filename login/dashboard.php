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
<script>
(function(){
  // Poll interval in milliseconds (3 seconds recommended)
  const POLL_INTERVAL = 3000; // 3000 = 3 seconds

  // URL to check lock status — adjust path if needed
  const CHECK_URL = 'check_lock_status.php';

  // Where to redirect when locked
  const LOCKED_PAGE = 'locked_portal.php';

  // Optionally, phone number to show if you prefer dynamic message (not needed if locked_portal.php has phone)
  // const ADMIN_PHONE = '+919876543210';

  let pollTimer = null;

  async function checkLock() {
    try {
      const resp = await fetch(CHECK_URL, { method: 'GET', cache: 'no-cache' });
      if (!resp.ok) {
        // server error — skip this tick
        return;
      }
      const data = await resp.json();

      // If user is not logged in, stop polling (optional)
      if (data.logged_in === false) {
        clearInterval(pollTimer);
        return;
      }

      if (data.is_locked === true) {
        // Optional: clear session or do client-side cleanup before redirect
        // Redirect immediately to locked page
        window.location.href = LOCKED_PAGE;
      }
      // else nothing to do
    } catch (err) {
      // network error — ignore and try again on next tick
      // console.log('checkLock error', err);
    }
  }

  // Start polling after small delay
  pollTimer = setInterval(checkLock, POLL_INTERVAL);
  // Also run once immediately
  checkLock();

  // Optional: if you want to stop polling when user navigates away
  window.addEventListener('beforeunload', function(){ clearInterval(pollTimer); });
})();
</script>

</body>
</html>
