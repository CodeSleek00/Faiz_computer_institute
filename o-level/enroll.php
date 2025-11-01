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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    * {
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      margin: 0;
      background: linear-gradient(
          rgba(255,255,255,0.7),
          rgba(255,255,255,0.7)
        ),
        url('../images/background.png') no-repeat center center/cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow-x: hidden;
    }

    /* Accent Blue Gradient */
    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(74,99,255,0.2), rgba(255,255,255,0.7));
      z-index: 0;
    }

    .container {
      position: relative;
      z-index: 1;
      max-width: 600px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      width: 90%;
      backdrop-filter: blur(10px);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #2e48d5;
      font-weight: 600;
    }

    .plan-info {
      background: #eef3ff;
      padding: 15px;
      border-radius: 10px;
      margin-bottom: 20px;
      border-left: 4px solid #4a63ff;
    }

    input, textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 14px;
      outline: none;
      transition: 0.3s;
    }
    input:focus, textarea:focus {
      border-color: #4a63ff;
      box-shadow: 0 0 4px rgba(74,99,255,0.3);
    }

    button {
      background: #4a63ff;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 10px;
      width: 100%;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: #2e48d5;
    }

    label {
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      color: #333;
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

    /* Top Right Branding */
    .branding {
      position: fixed;
      top: 15px;
      right: 25px;
      font-weight: 600;
      font-size: 18px;
      color: #4a63ff;
      z-index: 2;
      letter-spacing: 0.5px;
    }

    /* Bottom Right Help */
    .help-support {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background: #4a63ff;
      color: #fff;
      padding: 10px 20px;
      border-radius: 30px;
      font-size: 14px;
      text-decoration: none;
      box-shadow: 0 5px 15px rgba(74,99,255,0.3);
      z-index: 2;
      transition: all 0.3s ease;
    }
    .help-support:hover {
      background: #2e48d5;
      transform: translateY(-3px);
    }

    /* Responsive */
    @media(max-width:600px){
      body { padding: 20px; }
      .branding { font-size: 16px; right: 15px; top: 10px; }
      .container { padding: 20px; }
      h2 { font-size: 20px; }
    }
  </style>
</head>
<body>

  <div class="branding">Faiz Computer</div>

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

      <div class="coupon-section">
        <input type="text" id="couponCode" placeholder="Enter Coupon Code">
        <button type="button" onclick="applyCoupon()">Apply</button>
        <p id="couponMsg"></p>
      </div>

      <label><input type="checkbox" id="agreement" style="width:5%" required> I agree to the terms and conditions.</label>
      <button type="button" onclick="startPayment()">Proceed to Pay</button>
    </form>
  </div>

  <a href="support.php" class="help-support">Help & Support</a>

<script>
let finalAmount = parseFloat(document.getElementById('price').value);

function applyCoupon() {
  const coupon = document.getElementById('couponCode').value.trim();
  const amount = document.getElementById('price').value;
  const course = document.getElementById('plan').value;

  if (!coupon) {
    alert("Please enter a coupon code.");
    return;
  }

  fetch('apply_coupon.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `coupon=${coupon}&amount=${amount}&course=${course}`
  })
  .then(res => res.json())
  .then(data => {
    const msg = document.getElementById('couponMsg');
    if (data.success) {
      document.getElementById('price').value = data.newAmount;
      document.getElementById('displayPrice').innerText = data.newAmount.toFixed(2);
      finalAmount = data.newAmount;
      msg.style.color = "green";
      msg.innerHTML = `
        ✅ <b>${data.message}</b><br>
        Coupon Applied: <b>${coupon}</b><br>
        Discount: ₹${data.discount}<br>
        New Payable Amount: ₹${data.newAmount.toFixed(2)}
      `;
    } else {
      msg.style.color = "red";
      msg.innerHTML = "❌ " + data.message;
    }
  })
  .catch(() => alert("Error applying coupon"));
}

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
    "key": "YOUR_RAZORPAY_KEY_ID",
    "amount": price * 100,
    "currency": "INR",
    "name": "O Level Enrollment",
    "description": plan + " Payment",
    "handler": function (response){
      saveEnrollment(name, email, phone, address, plan, price, response.razorpay_payment_id);
    },
    "prefill": { name, email, contact: phone },
    "theme": { color: "#4a63ff" }
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
