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
      transition:0.3s;
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
    .coupon-section {
      background: #f7f9ff;
      border: 1px dashed #b9c5ff;
      border-radius: 10px;
      padding: 15px;
      margin-top: 10px;
    }
    .coupon-section input {
      width: calc(100% - 110px);
      display: inline-block;
      margin-right: 10px;
    }
    .coupon-section button {
      width: 90px;
      background: #3a53ff;
    }
    #couponMsg {
      font-size: 13px;
      margin-top: 8px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Enroll for O Level Course</h2>

  <div class="plan-info">
    <p><strong>Selected Plan:</strong> <?= htmlspecialchars($plan) ?></p>
    <p><strong>Amount:</strong> ₹<span id="displayPrice"><?= htmlspecialchars($price) ?></span></p>
  </div>

  <form id="enrollForm">
    <input type="hidden" id="plan" value="<?= htmlspecialchars($plan) ?>">
    <input type="hidden" id="price" value="<?= htmlspecialchars($price) ?>">

    <input type="text" id="name" placeholder="Full Name" required>
    <input type="email" id="email" placeholder="Email Address" required>
    <input type="text" id="phone" placeholder="Phone Number" required>
    <textarea id="address" placeholder="Full Address" required></textarea>

    <!-- ✅ Coupon Section -->
    <div class="coupon-section">
      <label><strong>Have a Coupon Code?</strong></label>
      <input type="text" id="couponCode" placeholder="Enter coupon code">
      <button type="button" id="applyCoupon">Apply</button>
      <p id="couponMsg"></p>
    </div>

    <label><input type="checkbox" id="agreement" required> I agree to the terms and conditions.</label>

    <button type="button" onclick="startPayment()">Proceed to Pay</button>
  </form>
</div>

<script>
let finalAmount = parseFloat(document.getElementById('price').value);

document.getElementById('applyCoupon').addEventListener('click', function() {
  const code = document.getElementById('couponCode').value.trim();
  const course = document.getElementById('plan').value;
  const amount = finalAmount;

  if (!code) return alert('Please enter a coupon code.');

  fetch('apply_coupon.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: `coupon_code=${code}&course=${course}&amount=${amount}`
  })
  .then(res => res.json())
  .then(data => {
    const msg = document.getElementById('couponMsg');
    if (data.success) {
      msg.style.color = 'green';
      msg.innerText = data.message + " Discount: ₹" + data.discount;
      finalAmount = data.new_amount;
      document.getElementById('displayPrice').innerText = finalAmount.toFixed(2);
      document.getElementById('price').value = finalAmount;
    } else {
      msg.style.color = 'red';
      msg.innerText = data.message;
    }
  });
});

function startPayment() {
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();
  const plan = document.getElementById('plan').value;
  const price = finalAmount;
  const agree = document.getElementById('agreement').checked;

  if (!agree) return alert('You must agree to the terms and conditions.');
  if (!name || !email || !phone || !address) return alert('Please fill all the fields.');

  const options = {
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
  const rzp = new Razorpay(options);
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
