<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $code = strtoupper(trim($_POST['code']));
    $discount_type = $_POST['discount_type'];
    $discount_value = $_POST['discount_value'];
    $min_amount = $_POST['min_amount'];
    $expiry_date = $_POST['expiry_date'];
    $course_type = $_POST['course_type'];

    $sql = "INSERT INTO coupons (code, discount_type, discount_value, min_amount, expiry_date, course_type)
            VALUES ('$code', '$discount_type', '$discount_value', '$min_amount', '$expiry_date', '$course_type')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Coupon Created Successfully!');</script>";
    } else {
        echo "<script>alert('Error creating coupon: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Create Coupon</title>
  <style>
    body { font-family: Poppins, sans-serif; padding: 40px; background: #f7f9ff;}
    form { background: white; padding: 25px; border-radius: 10px; max-width: 500px; margin: auto;}
    input, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 8px;}
    button { background: #4a63ff; color: white; border: none; padding: 10px 15px; border-radius: 8px; cursor: pointer;}
  </style>
</head>
<body>
  <h2 style="text-align:center;">Create a New Coupon Code</h2>
  <form method="POST">
    <input type="text" name="code" placeholder="Coupon Code (e.g. OLEVEL50)" required>
    <select name="discount_type" required>
      <option value="amount">Flat Amount Off</option>
      <option value="percent">Percentage Off</option>
    </select>
    <input type="number" name="discount_value" placeholder="Discount Value (e.g. 500 or 10)" required>
    <input type="number" name="min_amount" placeholder="Min Purchase Amount to Apply" required>
    <input type="date" name="expiry_date" required>
    <select name="course_type">
      <option value="custom_enroll">Custom Enrollment</option>
      <option value="o_level">O Level</option>
    </select>
    <button type="submit">Create Coupon</button>
  </form>
</body>
</html>
