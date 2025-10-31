<?php
// create_coupon.php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = strtoupper(trim($_POST['code']));
    $discount_type = $_POST['discount_type'];
    $discount_value = floatval($_POST['discount_value']);
    $min_amount = floatval($_POST['min_amount']);
    $max_usage = intval($_POST['max_usage']);
    $expiry_date = $_POST['expiry_date'];
    $course_applicable = $_POST['course_applicable'] ?? 'custom_enroll';

    $sql = "INSERT INTO coupons (code, discount_type, discount_value, min_amount, max_usage, course_applicable, expiry_date)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssdiiss", $code, $discount_type, $discount_value, $min_amount, $max_usage, $course_applicable, $expiry_date);
    if (mysqli_stmt_execute($stmt)) {
        $msg = "Coupon created successfully.";
    } else {
        $msg = "Error: " . mysqli_error($conn);
    }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create Coupon</title>
<style>body{font-family:Poppins, sans-serif;padding:30px;background:#f7f9ff}form{background:#fff;padding:20px;border-radius:10px;max-width:600px;margin:auto}input,select{width:100%;padding:10px;margin:8px 0;border-radius:6px;border:1px solid #ccc}button{background:#4a63ff;color:#fff;padding:10px;border-radius:8px;border:none;cursor:pointer}</style>
</head>
<body>
<h2 style="text-align:center">Create Coupon</h2>
<?php if(!empty($msg)): ?><p style="text-align:center;color:green;"><?=htmlspecialchars($msg)?></p><?php endif; ?>
<form method="post">
  <input name="code" placeholder="Coupon Code (e.g. OLEVEL100)" required>
  <select name="discount_type" required>
    <option value="amount">Flat Amount Off</option>
    <option value="percent">Percentage Off</option>
  </select>
  <input name="discount_value" type="number" step="0.01" placeholder="Discount value (e.g. 1500 or 10)" required>
  <input name="min_amount" type="number" step="0.01" placeholder="Minimum order amount to apply (e.g. 2000)" value="0">
  <input name="max_usage" type="number" placeholder="Maximum uses (e.g. 50)" value="10" required>
  <input name="expiry_date" type="date" required>
  <select name="course_applicable">
    <option value="custom_enroll">Custom Enroll</option>
    <option value="o_level">O Level</option>
  </select>
  <button type="submit">Create Coupon</button>
</form>
</body>
</html>
