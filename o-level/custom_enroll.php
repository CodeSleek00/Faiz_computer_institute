<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Custom Enrollment</title>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <style>
    body { font-family: Poppins, sans-serif; background: #f7f9ff; padding: 30px;}
    .container { max-width: 650px; margin:auto; background:#fff; padding:30px; border-radius:15px; box-shadow:0 8px 25px rgba(0,0,0,0.05);}
    h2{text-align:center;margin-bottom:20px;}
    input, textarea{width:100%;padding:10px;margin:10px 0;border-radius:8px;border:1px solid #ccc;}
    button{background:#4a63ff;color:#fff;border:none;padding:10px;border-radius:8px;cursor:pointer;width:100%;}
    .options label{display:block;margin:6px 0;}
    .total{font-size:20px;font-weight:600;text-align:center;margin-top:15px;}
  </style>
</head>
<body>
<div class="container">
  <h2>Build Your Custom Course</h2>

  <form id="customForm">
    <input type="text" id="name" placeholder="Full Name" required>
    <input type="email" id="email" placeholder="Email" required>
    <input type="text" id="phone" placeholder="Phone Number" required>
    <textarea id="address" placeholder="Full Address" required></textarea>

    <h3>Choose Your Modules (₹1500 each)</h3>
    <div class="options">
      <label><input type="checkbox" class="module" value="M1-R5"> M1-R5</label>
      <label><input type="checkbox" class="module" value="M2-R5"> M2-R5</label>
      <label><input type="checkbox" class="module" value="M3-R5"> M3-R5</label>
      <label><input type="checkbox" class="module" value="M4-R5"> M4-R5</label>
    </div>

    <h3>Additional Features</h3>
    <div class="options">
      <label><input type="checkbox" id="extras1" value="mock_live"> Mock Test + Live Sessions + Portal Access (+₹2000)</label>
      <label><input type="checkbox" id="extras2" value="full_pack"> Registration + Exam + Certificate (+₹10000)</label>
    </div>

    <h3>Coupon Code</h3>
    <input type="text" id="coupon" placeholder="Enter Coupon Code">
    <button type="button" onclick="applyCoupon()">Apply Coupon</button>

    <div class="total">Total: ₹<span id="total">0</span></div>
    <input type="checkbox" id="agree" required> I agree to the terms & conditions.

    <button type="button" onclick="startPayment()">Proceed to Payment</button>
  </form>
</div>

<script>
let baseAmount = 0;
let discount = 0;

document.querySelectorAll('.module, #extras1, #extras2').forEach(el => {
  el.addEventListener('change', updateTotal);
});

function updateTotal(){
  baseAmount = 0;
  document.querySelectorAll('.module:checked').forEach(()=> baseAmount += 1500);
  if(document.getElementById('extras1').checked) baseAmount += 2000;
  if(document.getElementById('extras2').checked) baseAmount += 10000;
  document.getElementById('total').innerText = baseAmount - discount;
}

function applyCoupon(){
  const code = document.getElementById('coupon').value.trim();
  if(!code) return alert('Enter coupon code');
  fetch('apply_coupon.php', {
    method: 'POST',
    headers: {'Content-Type':'application/x-www-form-urlencoded'},
    body: `code=${code}&amount=${baseAmount}`
  })
  .then(res=>res.json())
  .then(data=>{
    if(data.success){
      discount = data.discount;
      document.getElementById('total').innerText = data.final_amount;
      alert(data.message);
    } else {
      alert(data.message);
    }
  });
}

function startPayment(){
  if(!document.getElementById('agree').checked){
    alert("You must agree to continue."); return;
  }
  const total = document.getElementById('total').innerText;
  const name = document.getElementById('name').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const address = document.getElementById('address').value.trim();

  var options = {
    "key": "YOUR_RAZORPAY_KEY_ID",
    "amount": total*100,
    "currency": "INR",
    "name": "Custom Course Enrollment",
    "description": "Payment for selected modules",
    "handler": function (response){
      alert("Payment successful!");
      // TODO: Save to DB using fetch to enroll_action.php
    },
    "prefill": {
      "name": name,
      "email": email,
      "contact": phone
    },
    "theme": {"color": "#4a63ff"}
  };
  var rzp = new Razorpay(options);
  rzp.open();
}
</script>
</body>
</html>
