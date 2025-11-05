<?php
require 'db_connect.php';
$res = mysqli_query($conn, "SELECT * FROM olevel_enrollments ORDER BY created_at DESC");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - Enrollments</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Poppins', sans-serif;
  padding: 20px;
  background: #f4f6ff;
  color: #333;
}
h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #222;
}
table {
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 3px 10px rgba(0,0,0,0.05);
  border-radius: 8px;
  overflow: hidden;
}
th, td {
  padding: 12px 10px;
  border-bottom: 1px solid #e6e6e6;
  text-align: left;
  font-size: 14px;
}
th {
  background: #f0f2f5;
  text-transform: uppercase;
  font-weight: 600;
}
tr:hover {
  background: #fafafa;
}
.status {
  color: #fff;
  padding: 4px 10px;
  border-radius: 6px;
  font-size: 13px;
  text-transform: uppercase;
}
.paid { background: #28a745; }
.pending { background: #ffc107; color: #000; }
.failed { background: #dc3545; }
td:nth-child(1),
td:nth-child(2),
td:nth-child(3),
td:nth-child(4) {
  font-weight: 500;
}
</style>
</head>
<body>
<h2>O-Level Enrollments</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Plan</th>
    <th>Amount</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Payment</th>
    <th> Password</th>
    <th>Created At</th>
  </tr>

  <?php if (mysqli_num_rows($res) > 0): ?>
    <?php while($r = mysqli_fetch_assoc($res)): ?>
      <tr>
        <td><?= htmlspecialchars($r['id']) ?></td>
        <td><?= htmlspecialchars($r['student_id']) ?></td>
        <td><?= htmlspecialchars($r['plan_name']) ?></td>
        <td>₹<?= htmlspecialchars($r['amount']) ?></td>
        <td><?= htmlspecialchars($r['name']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars($r['phone']) ?></td>
        <td><?= nl2br(htmlspecialchars($r['address'])) ?></td>
        <td><span class="status <?= htmlspecialchars($r['payment_status']) ?>"><?= strtoupper($r['payment_status']) ?></span></td>
        <td><?= htmlspecialchars($r['password']) ?></td>
        <td><?= htmlspecialchars($r['created_at']) ?></td>
      </tr>
    <?php endwhile; ?>
  <?php else: ?>
    <tr><td colspan="11" style="text-align:center; padding:15px;">No enrollments found.</td></tr>
  <?php endif; ?>
</table>

</body>
</html>
