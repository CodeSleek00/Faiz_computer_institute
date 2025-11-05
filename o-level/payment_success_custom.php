<?php
require 'db_connect.php';
header('Content-Type: application/json');

// Read JSON input
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(['status'=>'error','message'=>'Invalid input']);
    exit;
}

$enrollment_id = intval($input['enrollment_id'] ?? 0);
$razorpay_order_id = $input['razorpay_order_id'] ?? '';
$razorpay_payment_id = $input['razorpay_payment_id'] ?? '';
$razorpay_signature = $input['razorpay_signature'] ?? '';

if (!$enrollment_id || !$razorpay_order_id || !$razorpay_payment_id || !$razorpay_signature) {
    echo json_encode(['status'=>'error','message'=>'Missing parameters']);
    exit;
}

// Keys
$RAZORPAY_KEY_ID = "rzp_test_Rc7TynjHcNrEfB"; // replace for live
$RAZORPAY_KEY_SECRET = "W2wBaETyh0J8UlE55tPSkEPc"; // replace for live

// Verify signature
$generated_signature = hash_hmac('sha256', $razorpay_order_id . "|" . $razorpay_payment_id, $RAZORPAY_KEY_SECRET);

if ($generated_signature !== $razorpay_signature) {
    echo json_encode(['status'=>'error','message'=>'Signature verification failed']);
    exit;
}

// Fetch enrollment
$res = mysqli_query($conn, "SELECT * FROM custom_enrollments WHERE id = $enrollment_id LIMIT 1");
if (!$res || mysqli_num_rows($res) == 0) {
    echo json_encode(['status'=>'error','message'=>'Enrollment not found']);
    exit;
}
$enroll = mysqli_fetch_assoc($res);

// Update payment status
mysqli_query($conn, "UPDATE custom_enrollments SET payment_status='Paid', razorpay_payment_id='$razorpay_payment_id' WHERE id=$enrollment_id");

// Also insert into your main table (olevel_enrollments) if needed:
$student_id = $enroll['student_id'];
$name = $enroll['name'];
$email = $enroll['email'];
$phone = $enroll['phone'];
$address = $enroll['address'];
$plan = "Custom Course (" . $enroll['selected_modules'] . ($enroll['extras'] ? ' + ' . $enroll['extras'] : '') . ")";
$price = $enroll['final_amount'];
$payment_id = $razorpay_payment_id;
$password = $enroll['password'];

// Insert into main enrollment table (optional, for consolidated tracking)
mysqli_query($conn, "INSERT INTO olevel_enrollments (student_id, name, email, phone, address, plan_name, amount, payment_status, password)
VALUES ('$student_id','$name','$email','$phone','$address','$plan','$price','Paid','$password')");

echo json_encode([
    'status' => 'success',
    'student_id' => $student_id,
    'message' => 'Payment successful and enrollment recorded'
]);
?>
