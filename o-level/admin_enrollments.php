<?php
require 'db_connect.php';
$res = mysqli_query($conn, "SELECT * FROM enrollments ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - Enrollments</title>
<style>
body{font-family:Poppins, sans-serif;padding:20px;background:#f4f6ff}
table{width:100%;border-collapse:collapse;background:#fff}
th,td{padding:10px;border:1px solid #e6e6e6;text-align:left}
th{background:#f0f0f0}
.bad{color:#fff;padding:4px 8px;border-radius:6px}
.paid{background:green}
.pending{background:orange}
.failed{background:red}
</style>
</head>
<body>
<h2>Enrollments</h2>
<table>
<tr><th>ID</th><th>Cust ID</th><th>Plan</th><th>Price</th><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Payment</th><th>Razorpay Payment ID</th><th>Created At</th></tr>
<?php while($r = mysqli_fetch_assoc($res)): ?>
<tr>
  <td><?= $r['id'] ?></td>
  <td><?= htmlspecialchars($r['custom_id']) ?></td>
  <td><?= htmlspecialchars($r['plan_name']) ?></td>
  <td><?= htmlspecialchars($r['price']) ?></td>
  <td><?= htmlspecialchars($r['user_name']) ?></td>
  <td><?= htmlspecialchars($r['email']) ?></td>
  <td><?= htmlspecialchars($r['phone']) ?></td>
  <td><?= nl2br(htmlspecialchars($r['address'])) ?></td>
  <td><span class="bad <?= $r['payment_status'] ?>"><?= strtoupper($r['payment_status']) ?></span></td>
  <td><?= htmlspecialchars($r['razorpay_payment_id']) ?></td>
  <td><?= $r['created_at'] ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
