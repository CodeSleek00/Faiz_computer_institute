<?php
// payment_success.php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (!$data) {
    echo json_encode(['status'=>'error','message'=>'No data received']);
    exit;
}

$enroll_id = intval($data['enroll_id'] ?? 0);
$razorpay_order_id = $data['razorpay_order_id'] ?? '';
$razorpay_payment_id = $data['razorpay_payment_id'] ?? '';
$razorpay_signature = $data['razorpay_signature'] ?? '';

if (!$enroll_id || !$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature) {
    echo json_encode(['status'=>'error','message'=>'Missing parameters']);
    exit;
}

require 'db_connect.php';

// fetch stored order id for that enrollment
$stmt = mysqli_prepare($conn, "SELECT custom_id, razorpay_order_id, phone FROM enrollments WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $enroll_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
if (!$row) {
    echo json_encode(['status'=>'error','message'=>'Enrollment record not found']);
    exit;
}

if ($row['razorpay_order_id'] !== $razorpay_order_id) {
    echo json_encode(['status'=>'error','message'=>'Order id mismatch']);
    exit;
}

// verify signature using razorpay secret (same secret used earlier)
$RAZORPAY_KEY_SECRET = "XXXXXXXXXXXXXXXXXXXXXXXX"; // same secret as enroll_action.php - replace

$generated_signature = hash_hmac('sha256', $razorpay_order_id . '|' . $razorpay_payment_id, $RAZORPAY_KEY_SECRET);

if ($generated_signature !== $razorpay_signature) {
    // signature mismatch
    // update as failed
    $u = mysqli_prepare($conn, "UPDATE enrollments SET payment_status = 'failed', razorpay_payment_id = ?, razorpay_signature = ? WHERE id = ?");
    mysqli_stmt_bind_param($u, "ssi", $razorpay_payment_id, $razorpay_signature, $enroll_id);
    mysqli_stmt_execute($u);

    echo json_encode(['status'=>'error','message'=>'Signature verification failed']);
    exit;
}

// signature correct -> mark paid
$u = mysqli_prepare($conn, "UPDATE enrollments SET payment_status = 'paid', razorpay_payment_id = ?, razorpay_signature = ? WHERE id = ?");
mysqli_stmt_bind_param($u, "ssi", $razorpay_payment_id, $razorpay_signature, $enroll_id);
mysqli_stmt_execute($u);

// return success and the generated custom id and phone (password)
echo json_encode(['status'=>'success', 'custom_id' => $row['custom_id'], 'password' => $row['phone']]);
exit;
?>
