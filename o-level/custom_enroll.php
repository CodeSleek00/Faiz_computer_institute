<?php
include 'db_connect.php';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Custom Enrollment</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

  body{
    font-family:'Poppins',sans-serif;
    background:
               url('../images/background.png') center/cover no-repeat;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:20px;
  }

  .card{
    width:100%;
    max-width:850px;
    background:rgba(255,255,255,0.9);
    backdrop-filter:blur(10px);
    border-radius:16px;
    box-shadow:0 8px 35px rgba(0,0,0,0.2);
    padding:32px 26px;
    color:#222;
  }

  h2,h3{
    margin-bottom:10px;
    color:#333;
  }

  input,textarea{
    width:100%;
    padding:12px;
    margin:8px 0;
    border-radius:10px;
    border:1px solid #ccc;
    outline:none;
    font-size:15px;
  }

  input:focus,textarea:focus{
    border-color:#4a63ff;
    box-shadow:0 0 0 2px rgba(74,99,255,0.2);
  }

  .modules label,
  .extras label{
    display:flex;
    align-items:center;
    gap:10px;
    background:#f7f8ff;
    padding:10px 14px;
    border-radius:10px;
    margin:6px 0;
    border:1px solid #e0e0e0;
    transition:all .2s;
    cursor:pointer;
  }

  .modules label:hover,
  .extras label:hover{
    background:#ebedff;
    border-color:#c4c8ff;
  }

  .modules input[type=checkbox],
  .extras input[type=checkbox]{
    width:18px;
    height:18px;
    accent-color:#4a63ff;
    cursor:pointer;
  }

  button{
    background:#4a63ff;
    color:#fff;
    border:none;
    padding:14px 20px;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    font-size:15px;
    transition:.2s;
  }

  button:hover{
    background:#384be0;
  }

  .row{
    display:flex;
    gap:10px;
  }

  .total{
    font-weight:700;
    font-size:18px;
    margin:15px 0;
  }

  .note{
    color:#555;
    font-size:13px;
  }

  #coupon_status{
    font-size:14px;
    margin-top:6px;
  }

  @media(max-width:600px){
    .row{flex-direction:column;}
    .card{padding:20px;}
  }
</style>
</head>
<body>
<div class="card">
  <h2>🎓 Build Your Custom Course</h2>
  <p style="color:#666;margin-bottom:18px;">Select modules and features you want — pay only for what you choose.</p>

  <input id="name" placeholder="Full Name" required>
  <input id="email" type="email" placeholder="Email" required>
  <input id="phone" type="tel" placeholder="Phone number" required>
  <textarea id="address" placeholder="Full address" rows="2"></textarea>

  <h3>Modules (₹1500 each)</h3>
  <div class="modules">
    <label><input class="module" type="checkbox" value="M1-R5"> <span>M1-R5</span></label>
    <label><input class="module" type="checkbox" value="M2-R5"> <span>M2-R5</span></label>
    <label><input class="module" type="checkbox" value="M3-R5"> <span>M3-R5</span></label>
    <label><input class="module" type="checkbox" value="M4-R5"> <span>M4-R5</span></label>
    <p class="note">Each module costs ₹1500 — select one or multiple.</p>
  </div>

  <h3>Additional Features</h3>
  <div class="extras">
    <label><input id="extras1" type="checkbox"> <span>Mock Test + Live Sessions + Portal Access (+₹2000)</span></label>
    <label><input id="extras2" type="checkbox"> <span>Registration + Exam + Certificate (+₹10000)</span></label>
  </div>

  <h3>Coupon</h3>
  <div class="row">
    <input id="coupon_code" placeholder="Enter coupon code (optional)">
    <button type="button" onclick="applyCoupon()">Apply</button>
  </div>
  <div id="coupon_status"></div>

  <div class="total">Total: ₹<span id="total_amount">0</span></div>

  <label style="display:flex;align-items:center;gap:8px;margin-top:8px;">
    <input id="agreement" type="checkbox" style="accent-color:#4a63ff"> I agree to terms & conditions
  </label>

  <div style="margin-top:20px;text-align:center;">
    <button id="payBtn" onclick="createOrder()">Proceed to Pay</button>
    <div id="msg" style="margin-top:12px;color:#b00020"></div>
  </div>
</div>

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
  discount = 0; couponCode = null;
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
  if(!code){ alert('Enter coupon code'); return; }
  const amountNow = calculateBase();
  if(amountNow <= 0){ alert('Select modules first'); return; }

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
    status.style.color = "green";
    status.innerHTML = `✅ ${data.message}<br>Discount: ₹${discount}<br>New Payable: ₹${data.newAmount}`;
  } else {
    discount = 0;
    status.style.color = "red";
    status.innerText = data.message || "Invalid coupon";
  }
  updateUI();
}

async function createOrder(){
  document.getElementById('msg').innerText = '';
  if(!document.getElementById('agreement').checked){ alert('Please accept terms'); return; }

  const name = nameField('name'), email = nameField('email'), phone = nameField('phone'), address = nameField('address');
  if(!name||!email||!phone||!address){ alert('Fill all details'); return; }

  const modules = Array.from(document.querySelectorAll('.module:checked')).map(i => i.value);
  const extras = [];
  if(document.getElementById('extras1').checked) extras.push('mock_live_portal');
  if(document.getElementById('extras2').checked) extras.push('reg_exam_cert');

  const payload = {
    name,email,phone,address,
    modules: modules.join(','),
    extras: extras.join(','),
    base_amount: calculateBase(),
    discount: discount,
    coupon_code: couponCode
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
    document.getElementById('msg').innerText = data.message || 'Server error';
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
      if (vdata.status === 'success') {
  window.location.href = 'thankyou.php?cid=' + encodeURIComponent(vdata.student_id) + '&name=' + encodeURIComponent(name);
} else {
  alert('Payment verification failed: ' + (vdata.message || 'Contact admin'));
  window.location.href = 'index.php';
}

    },
    prefill: { name, email, contact: phone },
    theme: { color: "#4a63ff" }
  };
  const rzp = new Razorpay(options);
  rzp.open();

  document.getElementById('payBtn').disabled = false;
  document.getElementById('payBtn').innerText = 'Proceed to Pay';
}

function nameField(id){ return document.getElementById(id).value.trim(); }
</script>
</body>
</html>
