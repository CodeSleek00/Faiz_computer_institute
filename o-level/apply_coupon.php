<?php
include 'db_connect.php';

$code = strtoupper(trim($_POST['coupon'] ?? ''));
$amount = $_POST['amount'] ?? 0;
$course = $_POST['course'] ?? '';

if ($code == '') {
  echo json_encode(["success" => false, "message" => "Please enter a coupon code."]);
  exit;
}

$sql = "SELECT * FROM coupons WHERE code='$code' AND status='active'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
  echo json_encode(["success" => false, "message" => "No coupon found."]);
  exit;
}

$coupon = mysqli_fetch_assoc($result);

// check expiry
if (strtotime($coupon['expiry_date']) < time()) {
  echo json_encode(["success" => false, "message" => "Coupon expired."]);
  exit;
}

// usage limit check
if ($coupon['used_count'] >= $coupon['max_usage']) {
  echo json_encode(["success" => false, "message" => "Coupon usage limit reached."]);
  exit;
}

// course check
if ($coupon['course_applicable'] !== 'All' && $coupon['course_applicable'] !== $course) {
  echo json_encode(["success" => false, "message" => "Coupon not valid for this course."]);
  exit;
}

// minimum amount
if ($amount < $coupon['min_amount']) {
  echo json_encode(["success" => false, "message" => "Minimum amount not met."]);
  exit;
}

// discount calculate
if ($coupon['discount_type'] === 'flat') {
  $discount = $coupon['discount_value'];
} else {
  $discount = ($amount * $coupon['discount_value']) / 100;
}

$newAmount = max(0, $amount - $discount);

// increase usage
mysqli_query($conn, "UPDATE coupons SET used_count = used_count + 1 WHERE id = {$coupon['id']}");

echo json_encode([
  "success" => true,
  "discount" => $discount,
  "newAmount" => $newAmount,
  "message" => "Coupon applied successfully!"
]);
