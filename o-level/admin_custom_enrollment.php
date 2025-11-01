<?php
require 'db_connect.php';
$res = mysqli_query($conn, "SELECT * FROM custom_enrollments ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin - Enrollments</title>
<style>
body{
  font-family: Poppins, sans-serif;
  padding: 20px;
  background: #f4f6ff;
}
h2{
  margin-bottom: 20px;
  color: #333;
}
table{
  width: 100%;
  border-collapse: collapse;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}
th, td{
  padding: 10px 12px;
  border: 1px solid #e6e6e6;
  text-align: left;
  font-size: 14px;
}
th{
  background: #f0f0f0;
  text-transform: uppercase;
  font-weight: 600;
}
tr:nth-child(even){
  background: #fafafa;
}
tr:hover{
  background: #f1f7ff;
}
.bad{
  color: #fff;
  padding: 4px 8px;
  border-radius: 6px;
  font-size: 13px;
}
.paid{background: green;}
.pending{background: orange;}
.failed{background: red;}
</style>
</head>
<body>
<h2>Enrollments</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Extras</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Total Amount</th>
    <th>Coupon Code</th>
    <th>Discount Amount</th>
    <th>Final Amount</th>
    <th>Password</th>
    <th>Address</th>
    <th>Payment Status</th>
    <th>Razorpay Payment ID</th>
    <th>Created At</th>
  </tr>

  <?php while($r = mysqli_fetch_assoc($res)): ?>
  <tr>
    <td><?= $r['id'] ?></td>
    <td><?= htmlspecialchars($r['student_id']) ?></td>
    <td><?= htmlspecialchars($r['name']) ?></td>
    <td><?= htmlspecialchars($r['price']) ?></td>
    <td><?= htmlspecialchars($r['extras']) ?></td>
    <td><?= htmlspecialchars($r['email']) ?></td>
    <td><?= htmlspecialchars($r['phone']) ?></td>
    <td><?= htmlspecialchars($r['total_amount']) ?></td>
    <td><?= htmlspecialchars($r['coupon_code']) ?></td>
    <td><?= htmlspecialchars($r['discount_amount']) ?></td>
    <td><?= htmlspecialchars($r['final_amount']) ?></td>
    <td><?= htmlspecialchars($r['password']) ?></td>
    <td><?= nl2br(htmlspecialchars($r['address'])) ?></td>
    <td><span class="bad <?= $r['payment_status'] ?>"><?= strtoupper($r['payment_status']) ?></span></td>
    <td><?= htmlspecialchars($r['razorpay_payment_id']) ?></td>
    <td><?= htmlspecialchars($r['created_at']) ?></td>
  </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
