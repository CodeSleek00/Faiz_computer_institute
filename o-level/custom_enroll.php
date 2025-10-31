<?php
include 'db_connect.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Custom Enrollment</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
  body{font-family:Poppins, sans-serif;background:#f6f8ff;padding:20px}
  .card{max-width:800px;margin:auto;background:#fff;padding:22px;border-radius:12px;box-shadow:0 8px 30px rgba(0,0,0,0.06)}
  .row{display:flex;gap:12px}
  input,textarea{width:100%;padding:10px;margin:8px 0;border-radius:8px;border:1px solid #ddd}
  .modules label, .extras label{display:block;margin:6px 0}
  button{background:#4a63ff;color:#fff;border:none;padding:12px;border-radius:10px;cursor:pointer}
  .total{font-weight:700;font-size:18px;margin:12px 0}
  .note{color:#666;font-size:13px}
</style>
</head>
<body>
<div class="card">
  <h2>Build Your Custom Course</h2>

  <div>
    <input id="name" placeholder="Full Name" required>
    <input id="email" type="email" placeholder="Email" required>
    <input id="phone" type="tel" placeholder="Phone number" required>
    <textarea id="address" placeholder="Full address" rows="2"></textarea>
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
  <div class="row">
    <input id="coupon_code" placeholder="Enter coupon code (optional)">
    <button type="button" onclick="applyCoupon()">Apply</button>
  </div>
  <div id="coupon_status" style="margin:8px 0;color:green"></div>

  <div class="total">Total: ₹<span id="total_amount">0</span></div>

  <label><input id="agreement" type="checkbox"> I agree to terms & conditions</label>
  <div style="height:10px"></div>

  <button id="payBtn" onclick="createOrder()">Proceed to Pay</button>
  <div id="msg" style="margin-top:12px;color:#b00020"></div>
</div>

<script>
const MODULE_PRICE = 1500;
const EXTRAS1_PRICE = 2000;
const EXTRAS2_PRICE = 10000;

let baseAmount = 0;
let discount = 0;
let couponCode = null;
let reservationKey = null;
let reservationExpiresAt = null;

function calculateBase(){
  baseAmount = 0;
  document.querySelectorAll('.module').forEach(cb => { if(cb.checked) baseAmount += MODULE_PRICE });
  if(document.getElementById('extras1').checked) baseAmount += EXTRAS1_PRICE;
  if(document.getElementById('extras2').checked) baseAmount += EXTRAS2_PRICE;
  return baseAmount;
}

document.querySelectorAll('.module, #extras1, #extras2').forEach(el => el.addEventListener('change', () => {
  discount = 0; couponCode = null; reservationKey = null; reservationExpiresAt = null; 
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
  if(!code) { alert('Enter coupon code'); return; }
  const amountNow = calculateBase();
  if(amountNow <= 0) { alert('Select some modules/extras first'); return; }

  const form = new URLSearchParams();
  form.append('coupon', code); // ✅ correct key
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
    reservationExpiresAt = data.expires_at;
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

  const payload = {
    name, email, phone, address,
    modules: modules.join(','),
    extras: extras.join(','),
    base_amount: calculateBase(),
    discount: discount,
    coupon_code: couponCode,
    reservation_key: reservationKey
  };

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
