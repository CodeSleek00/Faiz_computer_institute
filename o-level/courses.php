<?php
require 'db_connect.php';
session_start();

// After successful Razorpay payment → insert data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $course   = mysqli_real_escape_string($conn, $_POST['course']);
    $price    = mysqli_real_escape_string($conn, $_POST['price']);

    // Generate Enrollment ID (FAIZ-OLEVEL-XXXX)
    $res = $conn->query("SELECT MAX(id) AS last_id FROM olevel_enrollments");
    $row = $res->fetch_assoc();
    $next = ($row['last_id'] ?? 1000) + 1;
    $student_id = "FAIZ-OLEVELMOD-" . $next;

    // password same as phone (can hash later if needed)
    $password = $phone;

    // Insert into DB (only after successful payment)
    $stmt = $conn->prepare("INSERT INTO olevel_enrollments 
        (student_id, name, email, phone, address, plan_name, amount, payment_status, password) 
        VALUES (?,?,?,?,?,?,?,'Paid',?)");
    $stmt->bind_param("sssssdss", $student_id, $name, $email, $phone, $address, $course, $price, $password);
    $stmt->execute();
    $stmt->close();

    echo "success";
    exit;
}

// Fetch available courses
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
body{font-family:'Poppins',sans-serif;margin:0;background:#f8f9fa;}
header{background:#1e40af;color:#fff;text-align:center;padding:2rem 1rem;margin-bottom:1.5rem;}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;padding:1rem;max-width:1100px;margin:auto;}
.card{background:#fff;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.1);overflow:hidden;transition:.3s}
.card:hover{transform:translateY(-5px);}
.card img{width:100%;height:160px;object-fit:cover}
.card-body{padding:1rem;}
.card-body h3{margin:0;font-size:1.1rem;}
.price{font-weight:600;color:#1e40af;margin:.5rem 0;}
button{cursor:pointer;padding:.6rem 1rem;border:none;border-radius:6px;font-weight:500;}
.btn-primary{background:#1e40af;color:#fff;}
.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);justify-content:center;align-items:center;z-index:999;}
.modal-content{background:#fff;border-radius:10px;max-width:400px;width:90%;padding:1.5rem;box-shadow:0 4px 10px rgba(0,0,0,.2);}
.close{float:right;font-size:1.3rem;cursor:pointer;}
input,textarea{width:100%;padding:8px;margin:5px 0 10px;border:1px solid #ccc;border-radius:5px;}
footer{text-align:center;padding:1rem;color:#6b7280;font-size:.9rem;margin-top:2rem;}
</style>
</head>
<body>

<header>
  <h1>Premium Learning Courses</h1>
  <p>Enroll securely through Razorpay</p>
</header>

<div class="grid">
<?php while($c = $courses->fetch_assoc()): ?>
  <div class="card">
    <img src="<?= htmlspecialchars($c['image'] ?: 'https://via.placeholder.com/400x200/1e40af/ffffff?text=Course+Image') ?>" alt="Course">
    <div class="card-body">
      <h3><?= htmlspecialchars($c['name']) ?></h3>
      <p style="color:#666;font-size:.9rem;"><?= htmlspecialchars(substr($c['description'],0,60)) ?>...</p>
      <div class="price">₹<?= htmlspecialchars($c['price']) ?></div>
      <button class="btn-primary" onclick="openForm('<?= htmlspecialchars($c['name']) ?>', <?= $c['price'] ?>)">Enroll Now</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<!-- Enrollment Modal -->
<div class="modal" id="enrollModal">
  <div class="modal-content">
    <span class="close" onclick="closeForm()">&times;</span>
    <h2>Enroll in <span id="courseTitle"></span></h2>
    <form id="enrollForm" onsubmit="startPayment(event)">
      <input type="hidden" name="course" id="courseInput">
      <input type="hidden" name="price" id="priceInput">
      <label>Full Name</label>
      <input type="text" name="name" required>
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Phone (This will be your password)</label>
      <input type="text" name="phone" required>
      <label>Address</label>
      <textarea name="address" required></textarea>
      <button type="submit" class="btn-primary" style="width:100%;">Proceed to Pay</button>
    </form>
  </div>
</div>

<!-- Thank You Modal -->
<div class="modal" id="thankYouModal">
  <div class="modal-content" style="text-align:center;">
    <h2>🎉 Payment Successful!</h2>
    <p>Thank you for enrolling in <b id="thankCourse"></b>.</p>
    <p>Your enrollment is now confirmed ✅</p>
    <button onclick="location.reload()" class="btn-primary">Back to Courses</button>
  </div>
</div>

<footer>© <?= date('Y') ?> Pyaara Store. All rights reserved.</footer>

<script>
function openForm(course, price){
  document.getElementById('courseTitle').textContent = course;
  document.getElementById('courseInput').value = course;
  document.getElementById('priceInput').value = price;
  document.getElementById('enrollModal').style.display='flex';
}
function closeForm(){document.getElementById('enrollModal').style.display='none';}

function startPayment(e){
  e.preventDefault();
  const form = e.target;
  const data = Object.fromEntries(new FormData(form).entries());

  const options = {
    key: "rzp_test_Rc7TynjHcNrEfB", // replace with your live key later
    amount: data.price * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: data.course,
    handler: function (){
      // only after payment success → insert to DB
      fetch("", {
        method: "POST",
        headers: {"Content-Type":"application/x-www-form-urlencoded"},
        body: new URLSearchParams({...data, payment_confirmed: 1})
      }).then(res => res.text()).then(res=>{
        if(res.trim()==="success"){
          showThankYou(data);
        } else {
          alert("Database Error: " + res);
        }
      });
    },
    prefill: { name: data.name, email: data.email, contact: data.phone },
    theme: { color: "#1e40af" }
  };
  const rzp = new Razorpay(options);
  rzp.open();
}
function showThankYou(data){
  document.getElementById('enrollModal').style.display='none';
  document.getElementById('thankCourse').textContent = data.course;
  document.getElementById('thankYouModal').style.display='flex';
}
</script>

</body>
</html>
