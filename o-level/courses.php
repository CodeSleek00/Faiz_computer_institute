<?php
require 'db_connect.php';
session_start();

// ✅ Handle database insertion after payment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $planName = mysqli_real_escape_string($conn, $_POST['planName']);
    $planPrice = mysqli_real_escape_string($conn, $_POST['planPrice']);

    // Generate unique student ID
    $latest = $conn->query("SELECT id FROM enrollments ORDER BY id DESC LIMIT 1");
    $count = ($latest && $latest->num_rows > 0) ? $latest->fetch_assoc()['id'] + 1001 : 1001;
    $student_id = "FAIZ-OLEVELMOD-" . strtoupper(str_replace(' ', '', $planName)) . "-$count";

    $stmt = $conn->prepare("INSERT INTO enrollments (student_id, name, phone, email, plan_name, price, payment_status) VALUES (?, ?, ?, ?, ?, ?, 'Paid')");
    $stmt->bind_param("sssssd", $student_id, $name, $phone, $email, $planName, $planPrice);

    if ($stmt->execute()) {
        echo "success|$student_id";
    } else {
        echo "error|" . $conn->error;
    }
    exit;
}

// ✅ Fetch all courses
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Premium Courses | Pyaara Store</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f4f6fa;
  margin: 0;
  padding: 0;
}
.container {
  width: 90%;
  max-width: 1100px;
  margin: 40px auto;
}
h1 {
  text-align: center;
  color: #222;
  margin-bottom: 30px;
}
.course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 20px;
}
.course-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  padding: 20px;
  text-align: center;
  transition: 0.3s;
}
.course-card:hover {
  transform: translateY(-5px);
}
.course-card h3 {
  margin: 10px 0;
  color: #333;
}
.price {
  color: #0a8a52;
  font-weight: 600;
  font-size: 18px;
}
.duration {
  color: #666;
  margin-bottom: 15px;
}
.btn {
  display: inline-block;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  border: none;
  margin: 5px;
}
.btn-primary {
  background: #007bff;
  color: #fff;
}
.btn-outline {
  background: transparent;
  color: #007bff;
  border: 1px solid #007bff;
}
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0; top: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
}
.modal-content {
  background: #fff;
  width: 90%;
  max-width: 500px;
  margin: 10% auto;
  padding: 20px;
  border-radius: 16px;
  position: relative;
}
.modal-content h2 {
  margin-top: 0;
}
.close {
  position: absolute;
  right: 15px; top: 10px;
  font-size: 22px;
  cursor: pointer;
}
ul {
  text-align: left;
  padding-left: 20px;
}
</style>
</head>
<body>
<div class="container">
  <h1>Premium Courses</h1>
  <div class="course-grid">
    <?php while($row = $courses->fetch_assoc()): ?>
    <div class="course-card">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p class="price">₹<?= number_format($row['price'], 2) ?></p>
     
      <button class="btn btn-outline" onclick='openModal(<?= json_encode($row) ?>)'>View Details</button>
      <button class="btn btn-primary" onclick="openEnrollForm('<?= $row['name'] ?>', '<?= $row['price'] ?>')">Enroll Now</button>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Modal -->
<div id="detailModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2 id="modalTitle"></h2>
    <ul id="modalDescription"></ul>
    <p><strong>Duration:</strong> <span id="modalDuration"></span></p>
    <p><strong>Price:</strong> ₹<span id="modalPrice"></span></p>
    <button class="btn btn-primary" id="modalEnrollBtn">Enroll Now</button>
  </div>
</div>

<script>
let currentCourse = {};

function openModal(course) {
  currentCourse = course;
  document.getElementById('modalTitle').textContent = course.name;
  document.getElementById('modalPrice').textContent = course.price;
  document.getElementById('modalDuration').textContent = course.duration;

  // Split description by commas and make bullet points
  const descList = document.getElementById('modalDescription');
  descList.innerHTML = '';
  if (course.description) {
    course.description.split(',').forEach(d => {
      const li = document.createElement('li');
      li.textContent = d.trim();
      descList.appendChild(li);
    });
  }
  document.getElementById('modalEnrollBtn').onclick = () => openEnrollForm(course.name, course.price);
  document.getElementById('detailModal').style.display = 'block';
}
function closeModal() {
  document.getElementById('detailModal').style.display = 'none';
}

function openEnrollForm(planName, planPrice) {
  const name = prompt("Enter your full name:");
  const phone = prompt("Enter your contact number:");
  const email = prompt("Enter your email address:");
  if (!name || !phone || !email) {
    alert("All fields are required!");
    return;
  }
  const data = { name, phone, email, planName, planPrice };

  // Razorpay setup
  const options = {
    key: "rzp_live_pA6jgjncp78sq7",
    amount: planPrice * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: "Course Enrollment",
    handler: function () {
      fetch("", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ ...data, payment_confirmed: 1 })
      })
      .then(res => res.text())
      .then(res => {
        const parts = res.trim().split("|");
        if (parts[0] === "success" && parts[1]) {
          const cid = parts[1];
          window.location.href = "thankyou.php?cid=" + encodeURIComponent(cid);
        } else {
          alert("Enrollment failed.\nResponse: " + res);
        }
      })
      .catch(err => alert("Network error: " + err));
    },
    theme: { color: "#007bff" }
  };
  const rzp = new Razorpay(options);
  rzp.open();
}
</script>
</body>
</html>
