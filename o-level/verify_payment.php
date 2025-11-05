<?php
require 'db_connect.php';
require 'src/Razorpay.php';
use Razorpay\Api\Api;

$keyId = "";
$keySecret = "W2wBaETyh0J8UlE55tPSkEPc";

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
