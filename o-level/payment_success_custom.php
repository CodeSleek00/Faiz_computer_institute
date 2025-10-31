<?php
// payment_success_custom.php
header('Content-Type: application/json');
require 'db_connect.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input) { echo json_encode(['status'=>'error','message'=>'No input']); exit; }

$enrollment_id = intval($input['enrollment_id'] ?? 0);
$razorpay_order_id = $input['razorpay_order_id'] ?? '';
$razorpay_payment_id = $input['razorpay_payment_id'] ?? '';
$razorpay_signature = $input['razorpay_signature'] ?? '';

if (!$enrollment_id || !$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature) {
    echo json_encode(['status'=>'error','message'=>'Missing parameters']);
    exit;
}

// get enrollment record
$stmt = mysqli_prepare($conn, "SELECT student_id, coupon_reservation_key FROM custom_enrollments WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $enrollment_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$enr = mysqli_fetch_assoc($res);
if (!$enr) {
    echo json_encode(['status'=>'error','message'=>'Enrollment not found']);
    exit;
}

$RAZORPAY_KEY_SECRET = "XXXXXXXXXXXX"; // replace with same secret used earlier

// verify signature
$generated_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, $RAZORPAY_KEY_SECRET);
if ($generated_signature !== $razorpay_signature) {
    // mark failed
    $u = mysqli_prepare($conn, "UPDATE custom_enrollments SET payment_status='failed', razorpay_payment_id=? WHERE id=?");
    mysqli_stmt_bind_param($u, "si", $razorpay_payment_id, $enrollment_id);
    mysqli_stmt_execute($u);
    echo json_encode(['status'=>'error','message'=>'Signature verification failed']);
    exit;
}

// mark paid
$u = mysqli_prepare($conn, "UPDATE custom_enrollments SET payment_status='paid', razorpay_payment_id=? WHERE id=?");
mysqli_stmt_bind_param($u, "si", $razorpay_payment_id, $enrollment_id);
mysqli_stmt_execute($u);

// confirm coupon reservation (if any)
$reservation_key = $enr['coupon_reservation_key'];
if ($reservation_key) {
    // set reservation status to confirmed
    $q = $conn->prepare("UPDATE coupon_reservations SET status='confirmed' WHERE reservation_key = ?");
    $q->bind_param("s", $reservation_key);
    $q->execute();
    // (used_count already incremented when reserved)
}

// respond success with student_id and (password = phone) info
// fetch phone to return password if needed
$stmt2 = mysqli_prepare($conn, "SELECT student_id, phone FROM custom_enrollments WHERE id = ?");
mysqli_stmt_bind_param($stmt2, "i", $enrollment_id);
mysqli_stmt_execute($stmt2);
$r2 = mysqli_stmt_get_result($stmt2);
$row2 = mysqli_fetch_assoc($r2);

echo json_encode(['status'=>'success', 'student_id' => $row2['student_id'], 'password' => $row2['phone']]);
exit;
