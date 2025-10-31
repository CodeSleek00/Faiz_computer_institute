<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $code = strtoupper(trim($_POST['code']));
  $discount_type = $_POST['discount_type'];
  $discount_value = $_POST['discount_value'];
  $min_amount = $_POST['min_amount'];
  $max_usage = $_POST['max_usage'];
  $course_applicable = $_POST['course_applicable'];
  $expiry_date = $_POST['expiry_date'];

  $sql = "INSERT INTO coupons (code, discount_type, discount_value, min_amount, max_usage, course_applicable, expiry_date)
          VALUES ('$code','$discount_type','$discount_value','$min_amount','$max_usage','$course_applicable','$expiry_date')";
  if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Coupon created successfully!'); window.location='create_coupon.php';</script>";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<form method="POST" style="max-width:400px;margin:40px auto;font-family:poppins;">
  <h2>Create Coupon</h2>
  <input type="text" name="code" placeholder="Coupon Code" required>
  <select name="discount_type" required>
    <option value="flat">Flat</option>
    <option value="percent">Percentage</option>
  </select>
  <input type="number" name="discount_value" step="0.01" placeholder="Discount Value" required>
  <input type="number" name="min_amount" step="0.01" placeholder="Minimum Amount">
  <input type="number" name="max_usage" placeholder="Max Usage">
  <input type="text" name="course_applicable" placeholder="Applicable Course (or All)">
  <input type="date" name="expiry_date">
  <button type="submit">Create</button>
</form>
