<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $code = strtoupper(trim($_POST['code']));
  $discount_type = $_POST['discount_type'];
  $discount_value = floatval($_POST['discount_value']);
  $min_amount = !empty($_POST['min_amount']) ? floatval($_POST['min_amount']) : 0;
  $max_usage = !empty($_POST['max_usage']) ? intval($_POST['max_usage']) : 0;
  $course_applicable = !empty($_POST['course_applicable']) ? $_POST['course_applicable'] : 'All';
  $expiry_date = !empty($_POST['expiry_date']) ? $_POST['expiry_date'] : NULL;

  $sql = "INSERT INTO coupons (code, discount_type, discount_value, min_amount, max_usage, course_applicable, expiry_date, used_count)
          VALUES ('$code','$discount_type','$discount_value','$min_amount','$max_usage','$course_applicable','$expiry_date', 0)";

  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('✅ Coupon created successfully!'); window.location='create_coupon.php';</script>";
  } else {
    echo "❌ Error: " . mysqli_error($conn);
  }
}
?>

<form method="POST" style="max-width:400px;margin:40px auto;font-family:Poppins;">
  <h2>Create Coupon</h2>
  <input type="text" name="code" placeholder="Coupon Code" required>
  
  <select name="discount_type" required>
    <option value="amount">Flat</option>
    <option value="percent">Percentage</option>
  </select>
  
  <input type="number" name="discount_value" step="0.01" placeholder="Discount Value" required>
  <input type="number" name="min_amount" step="0.01" placeholder="Minimum Amount (optional)">
  <input type="number" name="max_usage" placeholder="Max Usage (optional)">
  <input type="text" name="course_applicable" placeholder="Applicable Course (or All)">
  <input type="date" name="expiry_date">
  
  <button type="submit" style="background:#4a63ff;color:white;padding:10px 20px;border:none;border-radius:8px;cursor:pointer;">
    Create Coupon
  </button>
</form>
