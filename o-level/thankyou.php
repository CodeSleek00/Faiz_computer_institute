<?php
// thankyou.php - robust version (prevents "undefined variable" warnings)
// Make sure this file is in same folder and db_connect.php sets $conn (mysqli)

include 'db_connect.php';

$student_id = isset($_GET['cid']) ? trim($_GET['cid']) : '';
$name = 'Student';
$phone = '';
$amount = null;
$payment_id = null;
$plan_name = '';
$found = false;

if ($student_id !== '') {
    // Try main table first
    $sid_safe = mysqli_real_escape_string($conn, $student_id);
    $q = "SELECT * FROM olevel_enrollments WHERE student_id = '$sid_safe' LIMIT 1";
    $res = mysqli_query($conn, $q);
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'] ?? $name;
        $phone = $row['phone'] ?? '';
        $amount = isset($row['amount']) ? $row['amount'] : ($row['price'] ?? $row['amount_paid'] ?? null);
        $payment_id = $row['payment_id'] ?? null;
        $plan_name = $row['plan_name'] ?? ($row['plan'] ?? '');
        $found = true;
    } else {
        // Try custom_enrollments if main not found
        $q2 = "SELECT * FROM custom_enrollments WHERE student_id = '$sid_safe' LIMIT 1";
        $res2 = mysqli_query($conn, $q2);
        if ($res2 && mysqli_num_rows($res2) > 0) {
            $row = mysqli_fetch_assoc($res2);
            $name = $row['name'] ?? $name;
            $phone = $row['phone'] ?? '';
            $amount = $row['final_amount'] ?? $row['total_amount'] ?? null;
            $payment_id = $row['razorpay_payment_id'] ?? $row['payment_id'] ?? null;
            $plan_name = ($row['selected_modules'] ?? '') . ($row['extras'] ? ' + ' . $row['extras'] : '');
            $found = true;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Enrollment Successful - Thank you</title>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
  body{font-family:'Poppins',sans-serif;background:linear-gradient(135deg,#eaf0ff,#ffffff);margin:0;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
  .card{background:#fff;border-radius:16px;padding:28px;box-shadow:0 12px 40px rgba(30,50,120,0.08);max-width:760px;width:100%;text-align:left;position:relative;overflow:hidden}
  .head{display:flex;align-items:center;gap:16px}
  .emoji{font-size:48px}
  h1{margin:0;color:#2e48d5}
  p{margin:6px 0;color:#444}
  .grid{display:flex;gap:12px;margin-top:16px;flex-wrap:wrap}
  .box{flex:1;min-width:200px;background:#f7f9ff;padding:12px;border-radius:10px;border:1px solid #eef2ff}
  .label{font-size:13px;color:#666}
  .val{font-weight:700;color:#111;margin-top:6px}
  .actions{margin-top:18px;display:flex;gap:10px;flex-wrap:wrap}
  .btn{background:#4a63ff;color:#fff;padding:10px 14px;border-radius:10px;border:none;cursor:pointer;font-weight:600}
  .btn.secondary{background:#eef3ff;color:#234}
  .small{font-size:13px;color:#666;margin-top:8px}
  .receipt{margin-top:18px;border-radius:10px;padding:14px;background:linear-gradient(180deg,#fff,#fcfdff);border:1px solid #f0f4ff}
  @media(max-width:600px){.grid{flex-direction:column}}
</style>
</head>
<body>
  <div class="card" role="main" aria-live="polite">
    <div class="head">
      <div class="emoji">🎉</div>
      <div>
        <h1>Payment Successful!</h1>
        <p>Thank you <?php echo htmlspecialchars($name); ?> — your enrollment is confirmed.</p>
      </div>
    </div>

    <?php if ($found): ?>
      <div class="grid">
        <div class="box">
          <div class="label">Student ID</div>
          <div class="val"><?php echo htmlspecialchars($student_id); ?></div>
        </div>

        <div class="box">
          <div class="label">Login Password</div>
          <div class="val"><?php echo htmlspecialchars($phone ?: 'hidden'); ?></div>
        </div>

        <div class="box">
          <div class="label">Plan / Modules</div>
          <div class="val"><?php echo htmlspecialchars($plan_name ?: 'O Level / Custom'); ?></div>
        </div>

        <div class="box">
          <div class="label">Amount Paid</div>
          <div class="val"><?php echo $amount !== null ? '₹'.number_format((float)$amount,2) : '—'; ?></div>
        </div>

       
      </div>

      <div class="receipt" id="receipt">
        <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
          <div>
            <strong>Faiz Computer</strong>
            <div class="small">Enrollment Receipt</div>
          </div>
          <div class="small"><?php echo date('d M Y'); ?></div>
        </div>

        <hr style="margin:12px 0;border:none;border-top:1px solid #f1f4ff">

        <p style="margin:6px 0"><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
        <p style="margin:6px 0"><strong>Student ID:</strong> <?php echo htmlspecialchars($student_id); ?></p>
        <p style="margin:6px 0"><strong>Plan:</strong> <?php echo htmlspecialchars($plan_name ?: 'O Level / Custom'); ?></p>
        <p style="margin:6px 0"><strong>Amount Paid:</strong> <?php echo $amount !== null ? '₹'.number_format((float)$amount,2) : '—'; ?></p>
       
      </div>

      <div class="actions">
        <button class="btn" onclick="window.print()">🧾 Print / Save Receipt</button>
        <button class="btn secondary" onclick="location.href='index.php'">🏠 Go to Home</button>
      </div>

    <?php else: ?>
      <p style="margin-top:18px;color:#b00020">We couldn't find enrollment details for <strong><?php echo htmlspecialchars($student_id ?: 'N/A'); ?></strong>. Please contact admin with your payment ID.</p>
      <div class="actions">
        <button class="btn secondary" onclick="location.href='index.php'">🏠 Go to Home</button>
      </div>
    <?php endif; ?>
  </div>

<script>
(function launchConfetti(){
  // small continuous confetti for 2.5s
  const duration = 2.5 * 1000;
  const end = Date.now() + duration;
  (function frame() {
    window.confetti && window.confetti({
      particleCount: 5,
      angle: 60,
      spread: 55,
      origin: { x: 0 }
    });
    window.confetti && window.confetti({
      particleCount: 5,
      angle: 120,
      spread: 55,
      origin: { x: 1 }
    });
    if (Date.now() < end) requestAnimationFrame(frame);
  })();
})();
</script>
</body>
</html>
