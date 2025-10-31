<?php
include 'db_connect.php';

$coupon = $_POST['coupon'] ?? '';
$amount = floatval($_POST['amount'] ?? 0);
$course = $_POST['course'] ?? '';

$response = ['success' => false, 'message' => 'Invalid coupon code.'];

if ($coupon == '') {
    $response['message'] = "Please enter a coupon code.";
    echo json_encode($response);
    exit;
}

// ✅ Check coupon in database
$stmt = $conn->prepare("SELECT * FROM coupons WHERE coupon_code = ? AND (course_name = ? OR course_name = 'ALL') LIMIT 1");
$stmt->bind_param("ss", $coupon, $course);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $discount = floatval($row['discount_amount']);
    $max_uses = intval($row['max_uses']);
    $used_count = intval($row['used_count']);

    if ($used_count >= $max_uses) {
        $response['message'] = "Sorry! This coupon has reached its usage limit.";
    } else {
        $newAmount = max($amount - $discount, 0); // 👈 prevent negative amount
        $response = [
            'success' => true,
            'message' => "Coupon '{$coupon}' applied successfully!",
            'discount' => $discount,
            'newAmount' => $newAmount
        ];

        // Update usage
        $conn->query("UPDATE coupons SET used_count = used_count + 1 WHERE coupon_code = '$coupon'");
    }
} else {
    $response['message'] = "No such coupon found.";
}

echo json_encode($response);
?>
