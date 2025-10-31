<?php
// apply_coupon.php
header('Content-Type: application/json');
require 'db_connect.php';

$code = strtoupper(trim($_POST['code'] ?? ''));
$amount = floatval($_POST['amount'] ?? 0);
$user_identifier = trim($_POST['user'] ?? ''); // optional phone/email

if (!$code) {
    echo json_encode(['success'=>false,'message'=>'No coupon code provided']);
    exit;
}

$now = date('Y-m-d');

$sql = "SELECT * FROM coupons WHERE code = ? AND status = 'active' LIMIT 1";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$coupon = mysqli_fetch_assoc($res);

if (!$coupon) {
    echo json_encode(['success'=>false,'message'=>'Invalid or inactive coupon code']);
    exit;
}

// expiry check
if (!empty($coupon['expiry_date']) && $now > $coupon['expiry_date']) {
    echo json_encode(['success'=>false,'message'=>'Coupon expired']);
    exit;
}

// min amount check
if ($amount < floatval($coupon['min_amount'])) {
    echo json_encode(['success'=>false,'message'=>'Minimum purchase ₹'.$coupon['min_amount'].' required to use this coupon']);
    exit;
}

// usage limit check
if (intval($coupon['used_count']) >= intval($coupon['max_usage'])) {
    echo json_encode(['success'=>false,'message'=>'Sorry, this coupon has reached its usage limit']);
    exit;
}

// All good -> compute discount
$discount = 0.0;
if ($coupon['discount_type'] === 'amount') {
    $discount = floatval($coupon['discount_value']);
} else {
    $discount = ($amount * floatval($coupon['discount_value'])) / 100.0;
}
$final_amount = max(0, $amount - $discount);

// Reserve one usage: create coupon_reservations row, increment used_count
$reservation_key = bin2hex(random_bytes(12));
$expires_at = date('Y-m-d H:i:s', strtotime('+30 minutes')); // reservation valid for 30 minutes

$conn->begin_transaction();

try {
    // insert reservation
    $ins = $conn->prepare("INSERT INTO coupon_reservations (coupon_id, reservation_key, user_identifier, status, expires_at) VALUES (?, ?, ?, 'reserved', ?)");
    $ins->bind_param("isss", $coupon['id'], $reservation_key, $user_identifier, $expires_at);
    $ins->execute();

    // increment used_count
    $upd = $conn->prepare("UPDATE coupons SET used_count = used_count + 1 WHERE id = ?");
    $upd->bind_param("i", $coupon['id']);
    $upd->execute();

    $conn->commit();

    echo json_encode([
        'success' => true,
        'discount' => round($discount,2),
        'final_amount' => round($final_amount,2),
        'reservation_key' => $reservation_key,
        'expires_at' => $expires_at,
        'message' => 'Coupon applied and reserved for 30 minutes. Complete payment to confirm.'
    ]);
    exit;
} catch (Exception $e) {
    $conn->rollback();
    echo json_encode(['success'=>false,'message'=>'Server error while reserving coupon: '.$e->getMessage()]);
    exit;
}
