<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Premium Courses | Pyaara Store</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ---- (your full CSS remains same as before) ---- */
</style>
</head>
<body>

<header class="page-header">
  <h1 class="page-title">Premium Learning Courses</h1>
  <p class="page-subtitle">Expand your knowledge with our expertly crafted courses</p>
</header>

<main class="courses-container">
  <div class="courses-grid">
    <?php while($c = $courses->fetch_assoc()): ?>
    <div class="course-card">
      <div class="course-image-container">
        <?php if($c['image']): ?>
          <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['name']) ?>" class="course-image">
        <?php else: ?>
          <img src="https://via.placeholder.com/400x200/1e40af/ffffff?text=Course+Image" alt="Course Image" class="course-image">
        <?php endif; ?>
        <span class="course-type-badge"><?= htmlspecialchars($c['type']) ?></span>
      </div>
      <div class="course-content">
        <h3 class="course-title"><?= htmlspecialchars($c['name']) ?></h3>
        <div class="course-meta">
          <div class="course-videos">
            <span>📹</span>
            <span><?= htmlspecialchars($c['total_videos']) ?> Videos</span>
          </div>
        </div>
        <div class="course-price">₹<?= htmlspecialchars($c['price']) ?></div>
        <div class="course-actions">
          <button class="btn btn-outline" onclick="showCourseDetails('<?= htmlspecialchars($c['name']) ?>', '<?= htmlspecialchars($c['description']) ?>', <?= $c['price'] ?>)">Details</button>
          <button class="btn btn-primary" onclick="openEnrollmentForm('<?= htmlspecialchars($c['name']) ?>', <?= $c['price'] ?>)">Enroll</button>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</main>

<!-- Course Details Modal (same as before) -->
<div class="modal-overlay" id="courseDetailsModal"> ... </div>

<!-- Enrollment Form Modal -->
<div class="modal-overlay" id="enrollmentFormModal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 class="modal-title">Enroll in Course</h2>
      <button class="close-btn" onclick="closeEnrollmentForm()">×</button>
    </div>
    <div class="modal-body">
      <form id="enrollForm">
        <input type="hidden" name="course_name" id="formCourseName">
        <input type="hidden" name="price" id="formCoursePrice">
        
        <label>Full Name</label>
        <input type="text" name="name" required style="width:100%;padding:8px;margin:5px 0;border:1px solid #ccc;border-radius:6px;">
        
        <label>Email</label>
        <input type="email" name="email" required style="width:100%;padding:8px;margin:5px 0;border:1px solid #ccc;border-radius:6px;">
        
        <label>Phone</label>
        <input type="text" name="phone" required style="width:100%;padding:8px;margin:5px 0;border:1px solid #ccc;border-radius:6px;">
        
        <label>Address</label>
        <textarea name="address" required style="width:100%;padding:8px;margin:5px 0;border:1px solid #ccc;border-radius:6px;"></textarea>

        <div class="modal-actions" style="margin-top:15px;">
          <button type="button" class="btn btn-outline" onclick="closeEnrollmentForm()">Cancel</button>
          <button type="submit" class="btn btn-primary">Proceed to Payment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function openEnrollmentForm(courseName, price) {
  document.getElementById('formCourseName').value = courseName;
  document.getElementById('formCoursePrice').value = price;
  document.getElementById('enrollmentFormModal').style.display = 'flex';
}

function closeEnrollmentForm() {
  document.getElementById('enrollmentFormModal').style.display = 'none';
}

document.getElementById('enrollForm').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const formData = new FormData(this);
  
  fetch('save_enrollment.php', {
    method: 'POST',
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      startPayment(data.enrollment_id, data.name, data.course_name, data.price);
    } else {
      alert('Error: ' + data.message);
    }
  })
  .catch(err => alert('Failed to save enrollment.'));
});

function startPayment(enrollment_id, name, course, amount) {
  closeEnrollmentForm();

  var options = {
    "key": "rzp_live_pA6jgjncp78sq7",
    "amount": amount * 100,
    "currency": "INR",
    "name": "Pyaara Store",
    "description": course,
    "handler": function (response) {
      fetch('update_payment.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `payment_id=${response.razorpay_payment_id}&enrollment_id=${enrollment_id}`
      });
      alert("Payment Successful! Enrollment ID: " + enrollment_id);
      window.location.href = 'thank_you.php';
    },
    "prefill": {
      "name": name
    },
    "theme": {"color": "#1e40af"}
  };
  
  var rzp = new Razorpay(options);
  rzp.open();
}
</script>

</body>
</html>
