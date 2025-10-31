<?php
include 'db_connect.php';

$code = strtoupper(trim($_POST['code']));
$amount = floatval($_POST['amount']);

$sql = "SELECT * FROM coupons WHERE code='$code'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo json_encode(["success" => false, "message" => "Invalid coupon code"]);
    exit;
}

$coupon = mysqli_fetch_assoc($result);

$today = date("Y-m-d");
if ($today > $coupon['expiry_date']) {
    echo json_encode(["success" => false, "message" => "Coupon expired"]);
    exit;
}

if ($amount < $coupon['min_amount']) {
    echo json_encode(["success" => false, "message" => "Minimum amount ₹{$coupon['min_amount']} required"]);
    exit;
}

$discount = 0;
if ($coupon['discount_type'] == 'amount') {
    $discount = $coupon['discount_value'];
} else {
    $discount = ($amount * $coupon['discount_value']) / 100;
}

$new_amount = max(0, $amount - $discount);

echo json_encode([
    "success" => true,
    "discount" => $discount,
    "final_amount" => $new_amount,
    "message" => "Coupon applied successfully!"
]);
?>
