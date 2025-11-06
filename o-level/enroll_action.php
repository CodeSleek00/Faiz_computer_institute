<?php
require 'db_connect.php';

// Retrieve data
$name        = $_POST['name']        ?? '';
$email       = $_POST['email']       ?? '';
$phone       = $_POST['phone']       ?? '';
$address     = $_POST['address']     ?? '';
$plan        = $_POST['plan']        ?? '';
$price       = $_POST['price']       ?? 0;
$payment_id  = $_POST['payment_id']  ?? '';
$emi_mode    = $_POST['emi_mode']    ?? 'no';
$emi_months  = $_POST['emi_months']  ?? 0;
$emi_remaining = $_POST['emi_remaining'] ?? 0;

// Validate inputs
if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($plan) || empty($payment_id)) {
    echo "Missing fields";
    exit;
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO olevel_enrollments 
    (name, email, phone, address, plan, price, payment_id, emi_mode, emi_months, emi_remaining, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

$stmt->bind_param(
    "sssssdssdd",
    $name, $email, $phone, $address, $plan, $price, $payment_id, $emi_mode, $emi_months, $emi_remaining
);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Database Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
