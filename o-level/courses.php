<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");

// ✅ Student ID generator
function generateStudentID($conn) {
    $result = $conn->query("SELECT COUNT(*) as total FROM olevel_enrollments");
    $count = $result->fetch_assoc()['total'] ?? 0;
    return "Faiz-OLEVELMOD-" . (1001 + $count);
}

// ✅ Handle form + payment confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $student_id = generateStudentID($conn);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $plan_name = mysqli_real_escape_string($conn, $_POST['plan']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $payment_status = "Paid";

    $stmt = $conn->prepare("INSERT INTO olevel_enrollments (student_id, name, email, phone, address, plan_name, amount, payment_status) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $student_id, $name, $email, $phone, $address, $plan_name, $amount, $payment_status);
    
    if ($stmt->execute()) {
        echo "success|$student_id";
    } else {
        echo "error|" . $conn->error;
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Premium Courses | Pyaara Store</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
/* CSS Variables for consistent theming */
:root {
  --primary: #007bff;
  --primary-dark: #0056b3;
  --primary-light: #e6f2ff;
  --secondary: #00b894;
  --dark: #333;
  --light: #f8f9fa;
  --white: #ffffff;
  --gray: #6c757d;
  --border-radius: 12px;
  --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  --transition: all 0.3s ease;
}

/* Base Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: var(--light);
  color: var(--dark);
  line-height: 1.6;
}

/* Header Styles */
.header {
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  color: var(--white);
  padding: 2rem 1rem;
  text-align: center;
  margin-bottom: 2rem;
}

.header h1 {
  font-weight: 600;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.header p {
  font-weight: 300;
  max-width: 600px;
  margin: 0 auto;
  opacity: 0.9;
}

/* Container and Grid */
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.courses-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
}

/* Card Styles */
.card {
  background: var(--white);
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  overflow: hidden;
  transition: var(--transition);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}

.card-img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
}

.card-content {
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.card-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: var(--dark);
}

.card-description {
  color: var(--gray);
  font-size: 0.9rem;
  margin-bottom: 1rem;
  flex-grow: 1;
}

.card-price {
  color: var(--secondary);
  font-weight: 600;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
}

.card-actions {
  display: flex;
  gap: 0.75rem;
  margin-top: auto;
}

/* Button Styles */
.btn {
  display: inline-block;
  padding: 0.75rem 1.5rem;
  border-radius: 6px;
  font-weight: 500;
  text-align: center;
  cursor: pointer;
  transition: var(--transition);
  border: none;
  font-family: 'Poppins', sans-serif;
  font-size: 0.9rem;
  flex: 1;
}

.btn-primary {
  background: var(--primary);
  color: var(--white);
}

.btn-primary:hover {
  background: var(--primary-dark);
}

.btn-outline {
  background: transparent;
  color: var(--primary);
  border: 1px solid var(--primary);
}

.btn-outline:hover {
  background: var(--primary-light);
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1000;
  justify-content: center;
  align-items: center;
  padding: 1rem;
}

.modal-content {
  background: var(--white);
  border-radius: var(--border-radius);
  width: 100%;
  max-width: 500px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  position: relative;
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
  padding: 1.5rem 1.5rem 0;
  border-bottom: none;
}

.modal-title {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.5rem;
}

.modal-price {
  color: var(--secondary);
  font-weight: 600;
  font-size: 1.25rem;
  margin-bottom: 1rem;
}

.modal-body {
  padding: 1rem 1.5rem;
}

.modal-features {
  margin-bottom: 1.5rem;
}

.modal-features ul {
  list-style-type: none;
  padding-left: 0;
}

.modal-features li {
  padding: 0.5rem 0;
  position: relative;
  padding-left: 1.5rem;
}

.modal-features li:before {
  content: "✓";
  color: var(--secondary);
  position: absolute;
  left: 0;
  font-weight: bold;
}

.close {
  position: absolute;
  top: 1rem;
  right: 1.5rem;
  font-size: 1.5rem;
  cursor: pointer;
  color: var(--gray);
  background: none;
  border: none;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
  transition: var(--transition);
}

.close:hover {
  background: var(--light);
  color: var(--dark);
}

/* Form Styles */
.form-group {
  margin-bottom: 1rem;
}

.form-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--dark);
}

.form-control {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-family: 'Poppins', sans-serif;
  font-size: 0.9rem;
  transition: var(--transition);
}

.form-control:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

textarea.form-control {
  min-height: 100px;
  resize: vertical;
}

.modal-footer {
  padding: 0 1.5rem 1.5rem;
  display: flex;
  justify-content: flex-end;
}

.btn-pay {
  background: var(--secondary);
  color: var(--white);
  width: 100%;
  padding: 0.9rem;
  font-size: 1rem;
}

.btn-pay:hover {
  background: #00a382;
}

/* Footer */
.footer {
  background: var(--dark);
  color: var(--white);
  padding: 2rem 1rem;
  text-align: center;
  margin-top: 3rem;
}

.footer p {
  opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
  .header h1 {
    font-size: 2rem;
  }
  
  .courses-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
  }
  
  .card-actions {
    flex-direction: column;
  }
  
  .modal-content {
    max-width: 100%;
  }
}

@media (max-width: 576px) {
  .header {
    padding: 1.5rem 1rem;
  }
  
  .header h1 {
    font-size: 1.75rem;
  }
  
  .courses-grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  
  .card-content {
    padding: 1.25rem;
  }
  
  .modal-body, .modal-header, .modal-footer {
    padding-left: 1.25rem;
    padding-right: 1.25rem;
  }
}

/* Loading State */
.loading {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: spin 1s ease-in-out infinite;
  margin-right: 8px;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Success/Error Messages */
.message {
  padding: 1rem;
  border-radius: 6px;
  margin-bottom: 1rem;
  text-align: center;
}

.message-success {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.message-error {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}
</style>
</head>
<body>

<header class="header">
  <h1>Premium Courses</h1>
  <p>Enhance your skills with our expertly crafted courses designed for success</p>
</header>

<div class="container">
  <div class="courses-grid">
    <?php while($row = $courses->fetch_assoc()): ?>
      <div class="card">
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="card-img">
        <div class="card-content">
          <h3 class="card-title"><?= htmlspecialchars($row['name']) ?></h3>
          <p class="card-description"><?= htmlspecialchars(substr($row['description'], 0, 100)) ?>...</p>
          <p class="card-price">₹<?= htmlspecialchars($row['price']) ?></p>
          <div class="card-actions">
            <button class="btn btn-outline" onclick="showDetails('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars(addslashes($row['description'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">View Details</button>
            <button class="btn btn-primary" onclick="openForm('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">Enroll Now</button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<footer class="footer">
  <p>&copy; <?= date('Y') ?> Pyaara Store. All rights reserved.</p>
</footer>

<!-- Modal -->
<div class="modal" id="popup">
  <div class="modal-content">
    <button class="close" onclick="closePopup()">&times;</button>
    <div class="modal-header">
      <h2 class="modal-title" id="modal-title"></h2>
      <p class="modal-price" id="modal-price"></p>
    </div>
    <div class="modal-body">
      <div class="modal-features" id="modal-desc"></div>
      <form id="enrollForm">
        <input type="hidden" name="plan" id="plan">
        <input type="hidden" name="amount" id="amount">
        
        <div class="form-group">
          <label class="form-label" for="name">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
        </div>
        
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="form-group">
          <label class="form-label" for="phone">Phone Number</label>
          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
        </div>
        
        <div class="form-group">
          <label class="form-label" for="address">Full Address</label>
          <textarea class="form-control" id="address" name="address" placeholder="Enter your complete address" required></textarea>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-pay" onclick="startPayment()">
        <span class="loading" id="loading-icon" style="display: none;"></span>
        <span id="pay-text">Proceed to Pay</span>
      </button>
    </div>
  </div>
</div>

<script>
let modal = document.getElementById("popup");
let isProcessing = false;

function showDetails(name, desc, amount) {
  let descList = desc.split(',').map(d => `<li>${d.trim()}</li>`).join('');
  document.getElementById("modal-title").innerText = name;
  document.getElementById("modal-price").innerText = "₹" + amount;
  document.getElementById("modal-desc").innerHTML = `<h3>Course Features:</h3><ul>${descList}</ul>`;
  document.getElementById("plan").value = name;
  document.getElementById("amount").value = amount;
  modal.style.display = "flex";
}

function openForm(plan, amount) {
  document.getElementById("modal-title").innerText = plan;
  document.getElementById("modal-price").innerText = "₹" + amount;
  document.getElementById("modal-desc").innerHTML = "";
  document.getElementById("plan").value = plan;
  document.getElementById("amount").value = amount;
  modal.style.display = "flex";
}

function closePopup() {
  modal.style.display = "none";
  isProcessing = false;
  document.getElementById("loading-icon").style.display = "none";
  document.getElementById("pay-text").innerText = "Proceed to Pay";
}

function startPayment() {
  if (isProcessing) return;
  
  const form = document.getElementById("enrollForm");
  const formData = new FormData(form);
  const data = Object.fromEntries(formData);
  
  // Basic form validation
  if (!data.name || !data.email || !data.phone || !data.address) {
    alert("Please fill in all required fields");
    return;
  }
  
  isProcessing = true;
  document.getElementById("loading-icon").style.display = "inline-block";
  document.getElementById("pay-text").innerText = "Processing...";
  
  let price = parseInt(data.amount.replace(/[^\d]/g, "")); // remove any ₹ sign

  let options = {
    key: "rzp_test_Rc7TynjHcNrEfB",
    amount: price * 100, // Razorpay expects amount in paise
    currency: "INR",
    name: "Pyaara Store",
    description: data.plan,
    handler: function (response) {
      // Payment successful, now submit enrollment
      fetch(window.location.href, {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: new URLSearchParams({...data, payment_confirmed: 1})
      })
      .then(res => res.text())
      .then(res => {
        const parts = res.trim().split("|");
        if (parts[0] === "success" && parts[1]) {
          window.location.href = "thankyou.php?cid=" + encodeURIComponent(parts[1]);
        } else {
          alert("Enrollment failed. " + res);
          isProcessing = false;
          document.getElementById("loading-icon").style.display = "none";
          document.getElementById("pay-text").innerText = "Proceed to Pay";
        }
      })
      .catch(error => {
        console.error("Error:", error);
        alert("An error occurred during enrollment. Please try again.");
        isProcessing = false;
        document.getElementById("loading-icon").style.display = "none";
        document.getElementById("pay-text").innerText = "Proceed to Pay";
      });
    },
    prefill: {
      name: data.name,
      email: data.email,
      contact: data.phone
    },
    theme: {
      color: "#007bff"
    }
  };

  let rzp = new Razorpay(options);
  rzp.open();
  
  rzp.on('payment.failed', function (response) {
    alert("Payment failed. Please try again.");
    isProcessing = false;
    document.getElementById("loading-icon").style.display = "none";
    document.getElementById("pay-text").innerText = "Proceed to Pay";
  });
}

// Close modal when clicking outside of it
window.onclick = function(event) {
  if (event.target == modal) {
    closePopup();
  }
}
</script>

</body>
</html>