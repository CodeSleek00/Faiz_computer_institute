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
:root {
  --primary-white: #ffffff;
  --secondary-white: #f8f9fa;
  --primary-blue: #1e40af;
  --light-blue: #3b82f6;
  --accent-color: #f59e0b;
  --text-dark: #1f2937;
  --text-light: #6b7280;
  --border-light: #e5e7eb;
  --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --border-radius: 12px;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background-color: var(--secondary-white);
  color: var(--text-dark);
  line-height: 1.6;
}

.page-header {
  background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
  color: var(--primary-white);
  padding: 2rem 1rem;
  text-align: center;
  margin-bottom: 1.5rem;
}

.page-title {
  font-size: 1.75rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.page-subtitle {
  font-size: 0.95rem;
  font-weight: 400;
  max-width: 600px;
  margin: 0 auto;
  opacity: 0.9;
}

.courses-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem 2rem;
}

.courses-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1rem;
}

.course-card {
  background-color: var(--primary-white);
  border-radius: var(--border-radius);
  box-shadow: var(--shadow-light);
  overflow: hidden;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  height: 100%;
}

.course-card:hover {
  transform: translateY(-5px);
  box-shadow: var(--shadow-medium);
}

.course-image-container {
  position: relative;
  height: 140px;
  overflow: hidden;
}

.course-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.course-card:hover .course-image {
  transform: scale(1.05);
}

.course-type-badge {
  position: absolute;
  top: 8px;
  right: 8px;
  background-color: var(--accent-color);
  color: var(--primary-white);
  padding: 0.2rem 0.6rem;
  border-radius: 12px;
  font-size: 0.7rem;
  font-weight: 600;
  text-transform: uppercase;
}

.course-content {
  padding: 1rem;
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.course-title {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: var(--text-dark);
  line-height: 1.3;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.course-meta {
  display: flex;
  justify-content: space-between;
  font-size: 0.8rem;
  color: var(--text-light);
}

.course-videos {
  display: flex;
  align-items: center;
  gap: 0.3rem;
}

.course-price {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--primary-blue);
  margin: 0.25rem 0 0.75rem;
}

.course-description {
  color: var(--text-light);
  font-size: 0.8rem;
  
  flex-grow: 1;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.course-actions {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.btn {
  padding: 0.6rem 0.75rem;
  border-radius: 6px;
  font-weight: 500;
  font-size: 0.8rem;
  cursor: pointer;
  transition: all 0.2s ease;
  border: none;
  text-align: center;
  width: 100%;
}

.btn-primary {
  background-color: var(--primary-blue);
  color: var(--primary-white);
}

.btn-primary:hover {
  background-color: var(--light-blue);
}

.btn-outline {
  background-color: transparent;
  color: var(--primary-blue);
  border: 1px solid var(--primary-blue);
}

.btn-outline:hover {
  background-color: rgba(59, 130, 246, 0.1);
}

/* Modal Styles */
.modal-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}

.modal-content {
  background-color: var(--primary-white);
  border-radius: var(--border-radius);
  width: 100%;
  max-width: 500px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: var(--shadow-medium);
  animation: modalFadeIn 0.3s ease;
}

@keyframes modalFadeIn {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-header {
  padding: 1.25rem 1.25rem 0;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.modal-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--text-dark);
  margin-right: 1rem;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  color: var(--text-light);
  cursor: pointer;
  padding: 0;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: background-color 0.2s;
}

.close-btn:hover {
  background-color: rgba(0, 0, 0, 0.05);
}

.modal-body {
  padding: 1.25rem;
}

.modal-description {
  margin-bottom: 1.25rem;
}

.modal-features {
  margin-bottom: 1.25rem;
}

.modal-features-title {
  font-size: 1rem;
  font-weight: 600;
  margin-bottom: 0.75rem;
  color: var(--text-dark);
}

.modal-features-list {
  list-style-type: none;
}

.modal-feature-item {
  padding: 0.4rem 0;
  display: flex;
  align-items: flex-start;
  gap: 0.5rem;
  font-size: 0.9rem;
}

.modal-feature-item::before {
  content: "✓";
  color: var(--accent-color);
  font-weight: bold;
  flex-shrink: 0;
}

.modal-price-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.25rem;
  padding-top: 1rem;
  border-top: 1px solid var(--border-light);
}

.modal-price {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-blue);
}

.modal-actions {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.btn-full {
  width: 100%;
}

/* Tablet and Desktop Styles */
@media (min-width: 768px) {
  .page-header {
    padding: 3rem 1.5rem;
    margin-bottom: 2.5rem;
  }
  
  .page-title {
    font-size: 2.5rem;
  }
  
  .page-subtitle {
    font-size: 1.1rem;
  }
  
  .courses-container {
    padding: 0 1.5rem 3rem;
  }
  
  .courses-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
  }
  
  .course-image-container {
    height: 180px;
  }
  
  .course-type-badge {
    top: 12px;
    right: 12px;
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
  }
  
  .course-content {
    padding: 1.5rem;
  }
  
  .course-title {
    font-size: 1.25rem;
  }
  
  .course-meta {
    font-size: 0.875rem;
  }
  
  .course-videos {
    gap: 0.5rem;
  }
  
  .course-price {
    font-size: 1.5rem;
    margin: 0.5rem 0 1rem;
  }
  
  .course-description {
    font-size: 0.9rem;
  
  }
  
  .course-actions {
    flex-direction: row;
    gap: 0.75rem;
  }
  
  .btn {
    padding: 0.75rem 1.5rem;
    font-size: 0.9rem;
    width: auto;
    flex: 1;
  }
  
  .modal-content {
    max-width: 600px;
  }
  
  .modal-header {
    padding: 1.5rem 1.5rem 0;
  }
  
  .modal-title {
    font-size: 1.5rem;
  }
  
  .modal-body {
    padding: 1.5rem;
  }
  
  .modal-feature-item {
    font-size: 1rem;
    padding: 0.5rem 0;
  }
  
  .modal-actions {
    flex-direction: row;
  }
}

@media (min-width: 1024px) {
  .courses-grid {
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  }
}
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
          <button class="btn btn-outline" onclick="showCourseDetails(`<?= htmlspecialchars($c['name']) ?>`, `<?= htmlspecialchars($c['description']) ?>`, <?= $c['price'] ?>, '<?= htmlspecialchars($c['type']) ?>')">Details</button>
          <button class="btn btn-primary" onclick="enrollNow(`<?= htmlspecialchars($c['name']) ?>`, <?= $c['price'] ?>)">Enroll</button>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</main>

<!-- Course Details Modal -->
<div class="modal-overlay" id="courseDetailsModal">
  <div class="modal-content">
    <div class="modal-header">
      <h2 class="modal-title" id="modalCourseTitle"></h2>
      <button class="close-btn" onclick="closeModal()">×</button>
    </div>
    <div class="modal-body">
      <div class="modal-description">
       <p id="modalCourseDescription"></p>
      </div>
      <div class="modal-features">
        <h3 class="modal-features-title">What you'll learn</h3>
        <ul class="modal-features-list" id="modalFeaturesList"></ul>
      </div>
      <div class="modal-price-section">
        <div>
          <span>Course Price:</span>
          <div class="modal-price" id="modalCoursePrice"></div>
        </div>
      </div>
      <div class="modal-actions">
        <button class="btn btn-outline btn-full" onclick="closeModal()">Continue Browsing</button>
        <button class="btn btn-primary btn-full" id="modalEnrollBtn">Enroll Now</button>
      </div>
    </div>
  </div>
</div>

<script>
let currentCourse = "";
let currentPrice = 0;

function showCourseDetails(name, description, price, type) {
  currentCourse = name;
  currentPrice = price;
  
  document.getElementById('modalCourseTitle').textContent = name;
  document.getElementById('modalCourseDescription').textContent = description;
  document.getElementById('modalCoursePrice').textContent = `₹${price}`;
  
  // Convert description into features list
  const featuresList = document.getElementById('modalFeaturesList');
  featuresList.innerHTML = '';
  
  // Split description by commas and create list items
  const features = description.split(',').map(item => item.trim());
  features.forEach(feature => {
    if (feature) {
      const li = document.createElement('li');
      li.className = 'modal-feature-item';
      li.textContent = feature;
      featuresList.appendChild(li);
    }
  });
  
  // Update enroll button
  const enrollBtn = document.getElementById('modalEnrollBtn');
  enrollBtn.onclick = function() {
    enrollNow(name, price);
  };
  
  // Show modal
  document.getElementById('courseDetailsModal').style.display = 'flex';
}

function closeModal() {
  document.getElementById('courseDetailsModal').style.display = 'none';
}

// Close modal when clicking outside the content
document.getElementById('courseDetailsModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeModal();
  }
});

// Razorpay integration
function enrollNow(courseName, amount) {
  var options = {
    "key": "rzp_live_pA6jgjncp78sq7",
    "amount": amount * 100,
    "currency": "INR",
    "name": "Pyaara Store",
    "description": courseName,
    "handler": function (response) {
      alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
      window.location.href = 'thank_you.php';
    },
    "theme": {"color": "#1e40af"}
  };
  
  var rzp1 = new Razorpay(options);
  rzp1.open();
}
</script>

</body>
</html>