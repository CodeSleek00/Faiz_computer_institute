<?php
include 'db_connect.php';
$course = $_GET['course'] ?? 'N/A';
$price = $_GET['price'] ?? '0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enroll Now - <?= htmlspecialchars($course) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
*{box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{
  margin:0;background:linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)),
  url('../images/background.png') no-repeat center center/cover;
  min-height:100vh;display:flex;justify-content:center;align-items:center;
  position:relative;overflow-x:hidden;
}
body::before{content:"";position:absolute;top:0;left:0;width:100%;height:100%;
  background:linear-gradient(135deg,rgba(74,99,255,0.2),rgba(255,255,255,0.7));z-index:0;}
.container{
  position:relative;z-index:1;max-width:600px;background:rgba(255,255,255,0.95);
  border-radius:20px;padding:30px;box-shadow:0 10px 30px rgba(0,0,0,0.1);
  width:90%;backdrop-filter:blur(10px);
}
h2{text-align:center;margin-bottom:20px;color:#2e48d5;font-weight:600;}
.plan-info{background:#eef3ff;padding:15px;border-radius:10px;margin-bottom:20px;
  border-left:4px solid #4a63ff;}
input,textarea,select{
  width:100%;padding:12px;margin:10px 0;border-radius:8px;border:1px solid #ccc;
  font-size:14px;outline:none;transition:0.3s;
}
input:focus,textarea:focus,select:focus{border-color:#4a63ff;box-shadow:0 0 4px rgba(74,99,255,0.3);}
button{background:#4a63ff;color:white;border:none;padding:12px 20px;border-radius:10px;
  width:100%;font-size:16px;cursor:pointer;transition:0.3s;}
button:hover{background:#2e48d5;}
label{font-size:14px;display:flex;align-items:center;gap:10px;color:#333;}
.branding{position:fixed;top:15px;right:25px;font-weight:600;font-size:18px;color:#4a63ff;z-index:2;}
.help-support{position:fixed;bottom:20px;right:20px;background:#4a63ff;color:#fff;
  padding:10px 20px;border-radius:30px;font-size:14px;text-decoration:none;
  box-shadow:0 5px 15px rgba(74,99,255,0.3);z-index:2;transition:all 0.3s ease;}
.help-support:hover{background:#2e48d5;transform:translateY(-3px);}
@media(max-width:600px){body{padding:20px;}.branding{font-size:16px;right:15px;top:10px;}.container{padding:20px;}h2{font-size:20px;}}
.emi-box{background:#f7f9ff;border:1px dashed #a4b0ff;padding:15px;border-radius:10px;margin-top:15px;}
</style>
</head>
<body>

<div class="branding">Pyaara Store</div>

<div class="container">
  <h2>Enroll for <?= htmlspecialchars($course) ?></h2>

  <div class="plan-info">
    <p><strong>Selected Course:</strong> <?= htmlspecialchars($course) ?></p>
    <p><strong>Amount:</strong> ₹<span id="displayPrice"><?= htmlspecialchars($price) ?></span></p>
  </div>

  <form id="enrollForm">
    <input type="hidden" id="course" value="<?= htmlspecialchars($course) ?>">
    <input type="hidden" id="price" value="<?= htmlspecialchars($price) ?>">

    <input type="text" id="name" placeholder="Full Name" required>
    <input type="email" id="email" placeholder="Email Address" required>
    <input type="text" id="phone" placeholder="Phone Number" required>
    <textarea id="address" placeholder="Full Address" required></textarea>

    <!-- EMI OPTION -->
    <div class="emi-box">
      <label><input type="checkbox" id="emiOption" onchange="toggleEMI()"> Pay with EMI (Installments)</label>
      <div id="emiPlanBox" style="display:none;">
        <label for="emiMonths">Select EMI Duration:</label>
        <select id="emiMonths" onchange="calculateEMI()">
          <option value="">--Select--</option>
          <option value="3">3 Months</option>
          <option value="6">6 Months</option>
          <option value="12">1 Year</option>
        </select>
        <p id="emiDetails" style="font-size:14px;color:#333;margin-top:8px;"></p>
      </div>
    </div>

    <label><input type="checkbox" id="agreement" style="width:5%" required> I agree to the terms and conditions.</label>
    <button type="button" onclick="startPayment()">Proceed to Pay</button>
  </form>
</div>

<a href="support.php" class="help-support">Help & Support</a>

<script>
let finalAmount = parseFloat(document.getElementById('price').value);
let emiMode = 'no';
let emiMonths = 0;
let remainingEMI = 0;

function toggleEMI(){
  const emiBox = document.getElementById('emiPlanBox');
  if(document.getElementById('emiOption').checked){
    emiBox.style.display = 'block';
    calculateEMI();
  }else{
    emiBox.style.display = 'none';
    finalAmount = parseFloat(document.getElementById('price').value);
    emiMode = 'no';
    emiMonths = 0;
    document.getElementById('displayPrice').innerText = finalAmount.toFixed(2);
    document.getElementById('emiDetails').innerText = '';
  }
}

function calculateEMI(){
  const months = document.getElementById('emiMonths').value;
  if(!months){ return; }

  const total = parseFloat(document.getElementById('price').value);
  const firstPay = 3000;
  const remaining = total - firstPay;
  const perMonth = (remaining / months).toFixed(2);

  emiMode = 'yes';
  emiMonths = months;
  remainingEMI = remaining.toFixed(2);
  finalAmount = firstPay;

  document.getElementById('displayPrice').innerText = finalAmount;
  document.getElementById('emiDetails').innerHTML = `
    💰 First Payment: <b>₹${firstPay}</b><br>
    📆 Duration: <b>${months} Months</b><br>
    🧾 Remaining: ₹${remaining} to be paid as ₹${perMonth}/month
  `;
}

function startPayment(){
  const name=document.getElementById('name').value.trim();
  const email=document.getElementById('email').value.trim();
  const phone=document.getElementById('phone').value.trim();
  const address=document.getElementById('address').value.trim();
  const course=document.getElementById('course').value;
  const price=finalAmount;
  const agree=document.getElementById('agreement').checked;
  if(!agree) return alert('You must agree to the terms and conditions.');
  if(!name||!email||!phone||!address) return alert('Please fill all the fields.');

  const options={
    "key":"rzp_live_pA6jgjncp78sq7",
    "amount":price*100,
    "currency":"INR",
    "name":"Pyaara Store",
    "description":course+" Enrollment",
    "handler":function(response){
      saveEnrollment(name,email,phone,address,course,price,response.razorpay_payment_id);
    },
    "prefill":{name,email,contact:phone},
    "theme":{color:"#1e40af"}
  };
  const rzp=new Razorpay(options);
  rzp.open();
}

function saveEnrollment(name,email,phone,address,course,price,payment_id){
  const xhr=new XMLHttpRequest();
  xhr.open("POST","enroll_action.php",true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.onload=function(){
    if(xhr.status===200){
      if(xhr.responseText.trim()==="success"){
        window.location.href="thank_you.php";
      }else{
        alert("Error: "+xhr.responseText);
      }
    }
  };
  xhr.send(`name=${name}&email=${email}&phone=${phone}&address=${address}&course=${course}&price=${price}&payment_id=${payment_id}&emi_mode=${emiMode}&emi_months=${emiMonths}&emi_remaining=${remainingEMI}`);
}
</script>
</body>
</html>
