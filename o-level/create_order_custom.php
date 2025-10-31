<?php
// create_order_custom.php
header('Content-Type: application/json');
require 'db_connect.php';

// READ JSON POST
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) { echo json_encode(['status'=>'error','message'=>'Invalid input']); exit; }

$name = $input['name'] ?? '';
$email = $input['email'] ?? '';
$phone = $input['phone'] ?? '';
$address = $input['address'] ?? '';
$modules = $input['modules'] ?? '';
$extras = $input['extras'] ?? '';
$base_amount = floatval($input['base_amount'] ?? 0);
$discount = floatval($input['discount'] ?? 0);
$coupon_code = $input['coupon_code'] ?? null;
$reservation_key = $input['reservation_key'] ?? null;

if (!$name || !$email || !$phone) { echo json_encode(['status'=>'error','message'=>'Missing required']); exit; }

$final_amount = max(0, $base_amount - $discount);
$student_password = $phone; // as requested

// generate student_id: Faiz-Custom-<id>
$next_num = 1001;
$res = mysqli_query($conn, "SELECT MAX(id) as mx FROM custom_enrollments");
if ($res) {
    $row = mysqli_fetch_assoc($res);
    if ($row && $row['mx'] !== null) $next_num = intval($row['mx']) + 1001;
}
$student_id = "Faiz-Custom-" . $next_num;

// Insert pending enrollment
$stmt = mysqli_prepare($conn, "INSERT INTO custom_enrollments (student_id, name, email, phone, address, selected_modules, extras, total_amount, coupon_code, coupon_reservation_key, discount_amount, final_amount, payment_status, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?)");
mysqli_stmt_bind_param($stmt, "ssssssssssdds", $student_id, $name, $email, $phone, $address, $modules, $extras, $base_amount, $coupon_code, $reservation_key, $discount, $final_amount, $student_password);
$ok = mysqli_stmt_execute($stmt);
if (!$ok) {
    echo json_encode(['status'=>'error','message'=>'DB insert failed: '.mysqli_error($conn)]);
    exit;
}
$enrollment_id = mysqli_insert_id($conn);

// create razorpay order
$RAZORPAY_KEY_ID = "rzp_test_XXXXXXXXXX"; // replace
$RAZORPAY_KEY_SECRET = "XXXXXXXXXXXX"; // replace

$amount_paise = intval(round($final_amount * 100));

// prepare payload
$orderPayload = [
    'amount' => $amount_paise,
    'currency' => 'INR',
    'receipt' => $student_id,
    'notes' => [
        'student_id' => $student_id,
        'enrollment_id' => strval($enrollment_id)
    ]
];

$ch = curl_init('https://api.razorpay.com/v1/orders');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $RAZORPAY_KEY_ID . ":" . $RAZORPAY_KEY_SECRET);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($orderPayload));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
$result = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if (curl_errno($ch)) {
    $err = curl_error($ch);
    echo json_encode(['status'=>'error','message'=>'Razorpay error: '.$err]);
    exit;
}
curl_close($ch);

$resp = json_decode($result, true);
if (!isset($resp['id'])) {
    echo json_encode(['status'=>'error','message'=>'Razorpay create order failed', 'resp'=>$resp]);
    exit;
}

$razorpay_order_id = $resp['id'];
// update enrollment with razorpay_order_id
$u = mysqli_prepare($conn, "UPDATE custom_enrollments SET razorpay_order_id = ? WHERE id = ?");
mysqli_stmt_bind_param($u, "si", $razorpay_order_id, $enrollment_id);
mysqli_stmt_execute($u);

// return created response
echo json_encode([
    'status' => 'created',
    'enrollment_id' => $enrollment_id,
    'student_id' => $student_id,
    'amount' => $amount_paise,
    'razorpay_order_id' => $razorpay_order_id,
    'razorpay_key' => $RAZORPAY_KEY_ID
]);
exit;
