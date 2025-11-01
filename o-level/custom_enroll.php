<?php
include 'db_connect.php';
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Custom Enrollment - Faiz Computer</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  * {
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }
  body {
    margin: 0;
    background: linear-gradient(135deg, #eef3ff 0%, #f9fbff 40%, #e3ebff 100%);
    padding: 30px 10px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .card {
    max-width: 850px;
    width: 100%;
    background: #fff;
    padding: 35px 30px;
    border-radius: 18px;
    box-shadow: 0 10px 35px rgba(74,99,255,0.1);
    position: relative;
  }

  h2 {
    text-align: center;
    color: #2e48d5;
    margin-bottom: 25px;
    font-weight: 600;
  }

  h3 {
    color: #4a63ff;
    margin-top: 25px;
    font-weight: 500;
  }

  .row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }

  input, textarea {
    width: 100%;
    padding: 12px 14px;
    margin: 8px 0;
    border-radius: 10px;
    border: 1px solid #d0d6ff;
    transition: all 0.2s;
    font-size: 15px;
  }
  input:focus, textarea:focus {
    border-color: #4a63ff;
    box-shadow: 0 0 0 3px rgba(74,99,255,0.15);
    outline: none;
  }

  .modules, .extras {
    margin-top: 10px;
  }

  .modules label, .extras label {
    display: block;
    margin: 6px 0;
    padding: 8px 10px;
    border-radius: 8px;
    transition: 0.3s;
    background: #f9faff;
  }
  .modules label:hover, .extras label:hover {
    background: #eef3ff;
  }

  .note {
    color: #666;
    font-size: 13px;
    margin-top: 5px;
  }

  button {
    background: #4a63ff;
    color: #fff;
    border: none;
    padding: 12px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    width: 100%;
    transition: all 0.3s;
  }
  button:hover {
    background: #2e48d5;
  }

  .total {
    font-weight: 600;
    font-size: 18px;
    margin: 15px 0;
    text-align: right;
    color: #222;
  }

  .coupon-area {
    background: #f6f8ff;
    border-radius: 10px;
    padding: 10px 15px;
    margin-top: 10px;
    border: 1px dashed #b9c5ff;
  }

  #coupon_status {
    margin: 8px 0;
    font-size: 14px;
    font-weight: 500;
  }

  label input[type="checkbox"] {
    accent-color: #4a63ff;
  }

  .terms {
    margin-top: 10px;
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #444;
    gap: 8px;
  }

  .footer-note {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    color: #777;
  }

  /* Top-right and Bottom-right fixed text */
  .branding {
    position: fixed;
    top: 15px;
    right: 25px;
    font-weight: 600;
    font-size: 18px;
    color: #4a63ff;
  }

  .help-support {
    position: fixed;
    bottom: 20px;
    right: 25px;
    background: #4a63ff;
    color: #fff;
    padding: 10px 18px;
    border-radius: 25px;
    font-size: 14px;
    text-decoration: none;
    box-shadow: 0 5px 20px rgba(74,99,255,0.3);
    transition: all 0.3s;
  }
  .help-support:hover {
    background: #2e48d5;
    transform: translateY(-2px);
  }

  /* Responsive */
  @media(max-width:600px) {
    .card { padding: 25px 20px; }
    .total { text-align: left; }
    .branding { font-size: 16px; right: 15px; top: 10px; }
  }
</style>
</head>
<body>

<div class="branding">Faiz Computer</div>

<div class="card">
  <h2>Build Your Custom Course</h2>

  <div>
    <input id="name" placeholder="Full Name" required>
    <input id="email" type="email" placeholder="Email" required>
    <input id="phone" type="tel" placeholder="Phone Number" required>
    <textarea id="address" placeholder="Full Address" rows="2"></textarea>
  </div>

  <h3>Modules (₹1500 each)</h3>
  <div class="modules">
    <label><input class="module" type="checkbox" value="M1-R5"> M1-R5</label>
    <label><input class="module" type="checkbox" value="M2-R5"> M2-R5</label>
    <label><input class="module" type="checkbox" value="M3-R5"> M3-R5</label>
    <label><input class="module" type="checkbox" value="M4-R5"> M4-R5</label>
    <p class="note">Select as many as you want. Each module costs ₹1500.</p>
  </div>

  <h3>Additional Features</h3>
  <div class="extras">
    <label><input id="extras1" type="checkbox"> Mock Test + Live Sessions + Portal Access (+₹2000)</label>
    <label><input id="extras2" type="checkbox"> Registration + Exam + Certificate (+₹10000)</label>
  </div>

  <h3>Coupon</h3>
  <div class="coupon-area">
    <div class="row">
      <input id="coupon_code" placeholder="Enter coupon code (optional)">
      <button type="button" style="width:auto;padding:10px 15px" onclick="applyCoupon()">Apply</button>
    </div>
    <div id="coupon_status"></div>
  </div>

  <div class="total">Total: ₹<span id="total_amount">0</span></div>

  <div class="terms">
    <input id="agreement" type="checkbox"> <span>I agree to the terms & conditions.</span>
  </div>

  <div style="margin-top:15px">
    <button id="payBtn" onclick="createOrder()">Proceed to Pay</button>
  </div>

  <div id="msg" style="margin-top:12px;color:#b00020;font-weight:500;"></div>
  <div class="footer-note">Your payment is secured via Razorpay.</div>
</div>

<a href="support.php" class="help-support">Help & Support</a>

<script>
const MODULE_PRICE = 1500;
const EXTRAS1_PRICE = 2000;
const EXTRAS2_PRICE = 10000;
let baseAmount = 0, discount = 0, couponCode = null, reservationKey = null;

function calculateBase(){
  baseAmount = 0;
  document.querySelectorAll('.module').forEach(cb => { if(cb.checked) baseAmount += MODULE_PRICE });
  if(document.getElementById('extras1').checked) baseAmount += EXTRAS1_PRICE;
  if(document.getElementById('extras2').checked) baseAmount += EXTRAS2_PRICE;
  return baseAmount;
}

document.querySelectorAll('.module, #extras1, #extras2').forEach(el => el.addEventListener('change', () => {
  discount = 0; couponCode = null; reservationKey = null; 
  document.getElementById('coupon_status').innerText = '';
  updateUI();
}));

function updateUI(){
  const total = Math.max(0, calculateBase() - discount);
  document.getElementById('total_amount').innerText = total.toFixed(2);
}
updateUI();

async function applyCoupon(){
  const code = document.getElementById('coupon_code').value.trim();
  if(!code) return alert('Enter coupon code');
  const amountNow = calculateBase();
  if(amountNow <= 0) return alert('Select some modules/extras first');

  const form = new URLSearchParams();
  form.append('coupon', code);
  form.append('amount', amountNow);
  form.append('course', 'custom_enroll');

  const resp = await fetch('apply_coupon.php', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: form.toString()
  });

  const data = await resp.json();
  const status = document.getElementById('coupon_status');
  if(data.success){
    discount = parseFloat(data.discount);
    couponCode = code;
    reservationKey = data.reservation_key;
    status.style.color = "green";
    status.innerHTML = `
      ✅ ${data.message}<br>
      Coupon: <b>${code}</b><br>
      Discount: ₹${discount}<br>
      New Payable: ₹${data.newAmount}
    `;
    updateUI();
  } else {
    discount = 0;
    status.style.color = "red";
    status.innerText = data.message || "Coupon could not be applied";
    updateUI();
  }
}

async function createOrder(){
  document.getElementById('msg').innerText = '';
  if(!document.getElementById('agreement').checked){ alert('Please accept terms'); return; }

  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();
  if(!name || !email || !phone || !address){ alert('Fill all details'); return; }

  const modules = Array.from(document.querySelectorAll('.module:checked')).map(i => i.value);
  const extras = [];
  if(document.getElementById('extras1').checked) extras.push('mock_live_portal');
  if(document.getElementById('extras2').checked) extras.push('reg_exam_cert');

  const payload = { name, email, phone, address, modules: modules.join(','), extras: extras.join(','), base_amount: calculateBase(), discount, coupon_code: couponCode, reservation_key: reservationKey };

  document.getElementById('payBtn').disabled = true;
  document.getElementById('payBtn').innerText = 'Please wait...';

  const resp = await fetch('create_order_custom.php', {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify(payload)
  });
  const data = await resp.json();
  if(!data || data.status !== 'created'){
    document.getElementById('msg').innerText = data.message || 'Server error creating order';
    document.getElementById('payBtn').disabled = false;
    document.getElementById('payBtn').innerText = 'Proceed to Pay';
    return;
  }

  const options = {
    key: data.razorpay_key,
    amount: data.amount,
    currency: "INR",
    name: "Custom Course - Faiz",
    description: "Custom course payment",
    order_id: data.razorpay_order_id,
    handler: async function(response) {
      const verifyResp = await fetch('payment_success_custom.php', {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({
          enrollment_id: data.enrollment_id,
          razorpay_order_id: response.razorpay_order_id,
          razorpay_payment_id: response.razorpay_payment_id,
          razorpay_signature: response.razorpay_signature
        })
      });
      const vdata = await verifyResp.json();
      if(vdata.status === 'success'){
        alert('Payment successful! Your ID: ' + vdata.student_id + ' Password: (your phone)');
        window.location.href = 'thankyou.php?cid=' + encodeURIComponent(vdata.student_id);
      } else {
        alert('Payment verification failed: ' + (vdata.message || 'Contact admin'));
        window.location.href = 'index.php';
      }
    },
    prefill: { name, email, contact: phone },
    theme: { color: "#4a63ff" }
  };
  const rzp = new Razorpay(options);
  rzp.on('payment.failed', function(){
    alert('Payment failed or cancelled');
    window.location.href = 'index.php';
  });
  rzp.open();

  document.getElementById('payBtn').disabled = false;
  document.getElementById('payBtn').innerText = 'Proceed to Pay';
}
</script>
</body>
</html>
