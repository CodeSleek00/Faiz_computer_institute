<?php
include 'db_connect.php';
$plan = $_GET['plan'] ?? 'N/A';
$price = $_GET['price'] ?? '0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Enroll Now - O Level</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7ff;
      padding: 40px;
    }
    .container {
      max-width: 600px;
      background: #fff;
      margin: auto;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 5px 25px rgba(0,0,0,0.1);
    }
    h2 {text-align:center; margin-bottom:20px;}
    .plan-info {
      background:#eef3ff;
      padding:15px;
      border-radius:10px;
      margin-bottom:20px;
    }
    input, textarea {
      width:100%;
      padding:12px;
      margin:10px 0;
      border-radius:8px;
      border:1px solid #ccc;
      font-size:14px;
    }
    button {
      background:#4a63ff;
      color:white;
      border:none;
      padding:12px 20px;
      border-radius:10px;
      width:100%;
      font-size:16px;
      cursor:pointer;
    }
    button:hover {
      background:#2e48d5;
    }
    label {
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Enroll for O Level Course</h2>

  <div class="plan-info">
    <p><strong>Selected Plan:</strong> <?= htmlspecialchars($plan) ?></p>
    <p><strong>Amount:</strong> ₹<?= htmlspecialchars($price) ?></p>
  </div>

  <form id="enrollForm">
    <input type="hidden" id="plan" value="<?= htmlspecialchars($plan) ?>">
    <input type="hidden" id="price" value="<?= htmlspecialchars($price) ?>">

    <input type="text" id="name" placeholder="Full Name" required>
    <input type="email" id="email" placeholder="Email Address" required>
    <input type="text" id="phone" placeholder="Phone Number" required>
    <textarea id="address" placeholder="Full Address" required></textarea>

    <label><input type="checkbox" id="agreement" required> I agree to the terms and conditions.</label>

    <button type="button" onclick="startPayment()">Proceed to Pay</button>
  </form>
</div>

<script>
function startPayment() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();
  const plan = document.getElementById('plan').value;
  const price = document.getElementById('price').value;
  const agree = document.getElementById('agreement').checked;

  if (!agree) {
    alert('You must agree to the terms and conditions.');
    return;
  }

  if (!name || !email || !phone || !address) {
    alert('Please fill all the fields.');
    return;
  }

  var options = {
    "key": "YOUR_RAZORPAY_KEY_ID", // Replace with your Razorpay Key
    "amount": price * 100,
    "currency": "INR",
    "name": "O Level Enrollment",
    "description": plan + " Payment",
    "handler": function (response){
      saveEnrollment(name, email, phone, address, plan, price, response.razorpay_payment_id);
    },
    "prefill": {
        "name": name,
        "email": email,
        "contact": phone
    },
    "theme": {
        "color": "#4a63ff"
    }
  };
  var rzp = new Razorpay(options);
  rzp.open();
}

function saveEnrollment(name, email, phone, address, plan, price, payment_id){
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "enroll_action.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function() {
    if (xhr.status === 200) {
      alert("Enrollment successful! Check your email for login details.");
      window.location.href = "index.php";
    }
  };
  xhr.send(`name=${name}&email=${email}&phone=${phone}&address=${address}&plan=${plan}&price=${price}&payment_id=${payment_id}`);
}
</script>

</body>
</html>
