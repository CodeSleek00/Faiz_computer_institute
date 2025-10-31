<?php
$cid = isset($_GET['cid']) ? htmlspecialchars($_GET['cid']) : '';
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Thank you</title></head>
<body style="font-family: Poppins, sans-serif; padding:30px; text-align:center;">
  <h2>Thank you for enrolling!</h2>
  <?php if($cid): ?>
    <p>Your Enrollment ID: <strong><?= $cid ?></strong></p>
    <p>Your password is the phone number you used while enrolling. Login details sent to your email too (if configured).</p>
  <?php else: ?>
    <p>We received your payment. We will contact you soon.</p>
  <?php endif; ?>
  <p><a href="index.php">Back to home</a></p>
</body>
</html>
