<?php
require 'db_connect.php';
require 'vendor/autoload.php';
use Razorpay\Api\Api;

$keyId = "rzp_live_pA6jgjncp78sq7";
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
