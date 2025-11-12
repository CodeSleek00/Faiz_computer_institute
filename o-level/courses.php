<?php
require 'db_connect.php';
session_start();

// ✅ Insert data after successful payment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $planName = mysqli_real_escape_string($conn, $_POST['planName']);
    $planPrice = mysqli_real_escape_string($conn, $_POST['planPrice']);

    // Generate student ID format: FAIZ-OLEVELMOD-1001+
    $latest = $conn->query("SELECT id FROM enrollments ORDER BY id DESC LIMIT 1");
    $count = ($latest && $latest->num_rows > 0) ? $latest->fetch_assoc()['id'] + 1001 : 1001;
    $student_id = "FAIZ-OLEVELMOD-" . $count;

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
  overflow: hidden;
  text-align: center;
  transition: 0.3s;
}
.course-card:hover {
  transform: translateY(-5px);
}
.course-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
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

/* ======= Modal Styles ======= */
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
  margin: 6% auto;
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

/* Enrollment Form */
.enroll-form input {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
}
.enroll-form button {
  width: 100%;
  background: #007bff;
  color: white;
  border: none;
  padding: 10px;
  border-radius: 6px;
  font-weight: 600;
  cursor: pointer;
}
</style>
</head>
<body>

<div class="container">
  <h1>Premium Courses</h1>
  <div class="course-grid">
    <?php while($row = $courses->fetch_assoc()): ?>
    <div class="course-card">
      <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p class="price">₹<?= number_format($row['price'], 2) ?></p>
      <button class="btn btn-outline" onclick='openModal(<?= json_encode($row) ?>)'>View Details</button>
      <button class="btn btn-primary" onclick='openFormModal("<?= $row['name'] ?>", "<?= $row['price'] ?>")'>Enroll Now</button>
    </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Course Details Modal -->
<div id="detailModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('detailModal')">&times;</span>
    <h2 id="modalTitle"></h2>
    <ul id="modalDescription"></ul>
    <p><strong>Price:</strong> ₹<span id="modalPrice"></span></p>
    <button class="btn btn-primary" id="modalEnrollBtn">Enroll Now</button>
  </div>
</div>

<!-- Enrollment Form Modal -->
<div id="enrollModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal('enrollModal')">&times;</span>
    <h2 id="formTitle">Enroll Now</h2>
    <form class="enroll-form" id="enrollForm">
      <input type="hidden" name="planName" id="planName">
      <input type="hidden" name="planPrice" id="planPrice">
      <input type="text" name="name" id="name" placeholder="Full Name" required>
      <input type="tel" name="phone" id="phone" placeholder="Contact Number" required>
      <input type="email" name="email" id="email" placeholder="Email Address" required>
      <button type="submit">Proceed to Pay</button>
    </form>
  </div>
</div>

<script>
let currentCourse = {};

function openModal(course) {
  currentCourse = course;
  document.getElementById('modalTitle').textContent = course.name;
  document.getElementById('modalPrice').textContent = course.price;

  const descList = document.getElementById('modalDescription');
  descList.innerHTML = '';
  if (course.description) {
    course.description.split(',').forEach(d => {
      const li = document.createElement('li');
      li.textContent = d.trim();
      descList.appendChild(li);
    });
  }
  document.getElementById('modalEnrollBtn').onclick = () => openFormModal(course.name, course.price);
  document.getElementById('detailModal').style.display = 'block';
}
function closeModal(id) {
  document.getElementById(id).style.display = 'none';
}

function openFormModal(planName, planPrice) {
  document.getElementById('planName').value = planName;
  document.getElementById('planPrice').value = planPrice;
  document.getElementById('enrollModal').style.display = 'block';
  closeModal('detailModal');
}

document.getElementById('enrollForm').onsubmit = function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  const data = Object.fromEntries(formData.entries());
  
  const options = {
    key: "rzp_live_pA6jgjncp78sq7",
    amount: data.planPrice * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: "Course Enrollment",
    handler: function () {
      fetch("", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
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
};
</script>
</body>
</html>
