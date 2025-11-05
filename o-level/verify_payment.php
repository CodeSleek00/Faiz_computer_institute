<?php
require 'db_connect.php';
require 'src/Razorpay.php';
use Razorpay\Api\Api;

$keyId = "rzp_test_Rc7TynjHcNrEfB";
$keySecret = "YOUR_RAZORPAY_SECRET";

$api = new Api($keyId, $keySecret);

if(isset($_POST['payment_id']) && isset($_POST['course_id'])){
  $payment = $api->payment->fetch($_POST['payment_id']);
  if($payment && $payment->status == 'captured'){
    echo "✅ Payment Successful for Course ID: ".$_POST['course_id'];
  } else {
    echo "❌ Payment failed or not verified.";
  }
}
?>
