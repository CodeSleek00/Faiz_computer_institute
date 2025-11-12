<?php
require 'db_connect.php';
session_start();

// ✅ Insert data after payment success
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $plan    = mysqli_real_escape_string($conn, $_POST['plan_name']);
    $price   = (float)$_POST['price_val'];

    // Generate Student ID
    $res = $conn->query("SELECT MAX(id) AS last_id FROM olevel_enrollments");
    $row = $res->fetch_assoc();
    $next = ($row['last_id'] ?? 1000) + 1;
    $student_id = "FAIZ-OLEVELMOD-" . $next;

    $password = $phone;
    $payment_status = 'Paid';

    $stmt = $conn->prepare("INSERT INTO olevel_enrollments 
        (student_id, name, email, phone, address, plan_name, amount, payment_status, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdss", $student_id, $name, $email, $phone, $address, $plan, $price, $payment_status, $password);

    if ($stmt->execute()) {
        echo "success|$student_id"; // 👈 Return student ID for redirect
    } else {
        echo "error|" . $stmt->error;
    }
    $stmt->close();
    exit;
}

// ✅ Fetch courses
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enroll | Premium Courses</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
*{font-family:'Poppins',sans-serif;margin:0;padding:0;box-sizing:border-box;}
body{background:#f8f9fa;}
header{background:#1e40af;color:#fff;text-align:center;padding:2rem 1rem;margin-bottom:1.5rem;}
.course-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;padding:1rem;max-width:1100px;margin:auto;}
.course-card{background:#fff;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.1);overflow:hidden;transition:.3s}
.course-card:hover{transform:translateY(-5px);}
.course-image{width:100%;height:160px;object-fit:cover}
.course-body{padding:1rem;}
.course-title{margin:0;font-size:1.1rem;}
.course-price{font-weight:600;color:#1e40af;margin:.5rem 0;}
.enroll-btn{background:#1e40af;color:#fff;cursor:pointer;padding:.6rem 1rem;border:none;border-radius:6px;font-weight:500;}
.modal-overlay{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);justify-content:center;align-items:center;z-index:999;}
.modal-container{background:#fff;border-radius:10px;max-width:400px;width:90%;padding:1.5rem;box-shadow:0 4px 10px rgba(0,0,0,.2);}
.close-btn{float:right;font-size:1.3rem;cursor:pointer;}
input,textarea{width:100%;padding:8px;margin:5px 0 10px;border:1px solid #ccc;border-radius:5px;}
footer{text-align:center;padding:1rem;color:#6b7280;font-size:.9rem;margin-top:2rem;}
.loader{display:none;text-align:center;padding:20px;font-weight:600;color:#1e40af;}
</style>
</head>
<body>

<header>
  <h1>Premium Learning Courses</h1>
  <p>Enroll securely through Razorpay</p>
</header>

<div class="course-grid">
<?php while($c = $courses->fetch_assoc()): 
    $clean_price = (float)preg_replace('/[^0-9.]/', '', $c['price']);
?>
  <div class="course-card">
    <img src="<?= htmlspecialchars($c['image'] ?: 'https://via.placeholder.com/400x200/1e40af/ffffff?text=Course+Image') ?>" alt="Course" class="course-image">
    <div class="course-body">
      <h3 class="course-title"><?= htmlspecialchars($c['name']) ?></h3>
      <p class="course-description"><?= htmlspecialchars(substr($c['description'],0,60)) ?>...</p>
      <div class="course-price">₹<?= number_format($clean_price, 0) ?></div>
      <button class="enroll-btn" onclick='openForm(<?= json_encode($c["name"]) ?>, <?= json_encode($clean_price) ?>)'>Enroll Now</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<!-- Enrollment Modal -->
<div class="modal-overlay" id="enrollModal">
  <div class="modal-container">
    <span class="close-btn" onclick="closeForm()">&times;</span>
    <h2>Enroll in <span id="courseTitle"></span></h2>
    <form id="enrollForm" onsubmit="startPayment(event)">
      <input type="hidden" name="plan_name" id="planInput">
      <input type="hidden" name="price_val" id="priceInput">
      <label>Full Name</label>
      <input type="text" name="name" required>
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Phone (This will be your password)</label>
      <input type="text" name="phone" required pattern="[0-9]{10}" title="10 digit mobile number">
      <label>Address</label>
      <textarea name="address" required></textarea>
      <button type="submit" class="enroll-btn" style="width:100%;">Proceed to Pay</button>
    </form>
  </div>
</div>

<!-- Loader -->
<div class="modal-overlay" id="loadingModal">
  <div class="modal-container" style="text-align:center;">
    <div class="loader" id="loaderText">Processing your enrollment...</div>
  </div>
</div>

<footer>© <?= date('Y') ?> Pyaara Store. All rights reserved.</footer>

<script>
function openForm(course, price){
  const numPrice = parseFloat(price);
  if (isNaN(numPrice) || numPrice <= 0) {
    alert("Invalid course price!");
    return;
  }
  document.getElementById('courseTitle').textContent = course;
  document.getElementById('planInput').value = course;
  document.getElementById('priceInput').value = numPrice;
  document.getElementById('enrollModal').style.display = 'flex';
}

function closeForm(){
  document.getElementById('enrollModal').style.display = 'none';
}

function startPayment(e){
  e.preventDefault();
  const form = e.target;
  const data = Object.fromEntries(new FormData(form).entries());
  
  const price = parseFloat(data.price_val);
  if (isNaN(price) || price <= 0) {
    alert("Invalid price amount!");
    return;
  }

  const options = {
    key: "rzp_test_Rc7TynjHcNrEfB", // 🔑 Replace with your live Razorpay key
    amount: Math.round(price * 100),
    currency: "INR",
    name: "Pyaara Store",
    description: data.plan_name,
    handler: function (){
      // Show loading
      document.getElementById('enrollModal').style.display = 'none';
      document.getElementById('loadingModal').style.display = 'flex';
      document.getElementById('loaderText').style.display = 'block';

      fetch("", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: new URLSearchParams({...data, payment_confirmed: 1})
      })
      .then(res => res.text())
      .then(res => {
        const parts = res.trim().split("|");
        if (parts[0] === "success" && parts[1]) {
          const cid = parts[1];
          window.location.href = "thankyou.php?cid=" + encodeURIComponent(cid);
        } else {
          alert("Enrollment failed. Please contact support.\nResponse: " + res);
          document.getElementById('loadingModal').style.display = 'none';
        }
      })
      .catch(err => {
        console.error(err);
        alert("Network error. Try again.");
        document.getElementById('loadingModal').style.display = 'none';
      });
    },
    prefill: {
      name: data.name,
      email: data.email,
      contact: data.phone
    },
    theme: { color: "#1e40af" }
  };

  const rzp = new Razorpay(options);
  rzp.open();
}

window.onclick = function(e) {
  const enrollModal = document.getElementById('enrollModal');
  if (e.target === enrollModal) enrollModal.style.display = 'none';
}
</script>

</body>
</html>
