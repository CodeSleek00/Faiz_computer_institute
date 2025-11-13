<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM singlemodules ORDER BY id DESC");

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
<title>Premium Modules | Pyaara Store</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
/* CSS Variables for consistent theming */
:root {
  --primary: #007bff;
  --primary-dark: #0056b3;
  --primary-light: #e6f2ff;
  --secondary: #0008ffff;
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
.site-header {
  background: linear-gradient(135deg, var(--primary), var(--primary-dark));
  color: var(--white);
  padding: 2rem 1rem;
  text-align: center;
  margin-bottom: 2rem;
}

.site-header h1 {
  font-weight: 600;
  font-size: 2.5rem;
  margin-bottom: 0.5rem;
}

.site-header p {
  font-weight: 300;
  max-width: 600px;
  margin: 0 auto;
  opacity: 0.9;
}

/* Container and Grid */
.main-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1.5rem;
}

.modules-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
  margin-bottom: 3rem;
}

/* Card Styles */
.module-card {
  background: var(--white);
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  overflow: hidden;
  transition: var(--transition);
  display: flex;
  flex-direction: column;
  height: 100%;
}

.module-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}

.module-image {
  width: 100%;
  height: 200px;
  object-fit: cover;
  display: block;
}

.module-content {
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}

.module-title {
  font-size: 1.25rem;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: var(--dark);
}

.module-description {
  color: var(--gray);
  font-size: 0.9rem;
  margin-bottom: 1rem;
  flex-grow: 1;
}

.module-price {
  color: var(--secondary);
  font-weight: 600;
  font-size: 1.5rem;
  margin-bottom: 1.5rem;
}

.module-actions {
  display: flex;
  gap: 0.75rem;
  margin-top: auto;
}

/* Button Styles */
.action-btn {
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

.btn-main {
  background: var(--primary);
  color: var(--white);
}

.btn-main:hover {
  background: var(--primary-dark);
}

.btn-alt {
  background: transparent;
  color: var(--primary);
  border: 1px solid var(--primary);
}

.btn-alt:hover {
  background: var(--primary-light);
}

/* Modal Styles */
.popup-modal {
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

.modal-container {
  background: var(--white);
  border-radius: var(--border-radius);
  width: 100%;
  max-width: 500px;
  max-height: 90vh;
  overflow-y: auto;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  position: relative;
  animation: modalAppear 0.3s ease;
}

@keyframes modalAppear {
  from {
    opacity: 0;
    transform: translateY(-20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.modal-top {
  padding: 1.5rem 1.5rem 0;
  border-bottom: none;
}

.modal-heading {
  font-size: 1.5rem;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 0.5rem;
}

.modal-cost {
  color: var(--secondary);
  font-weight: 600;
  font-size: 1.25rem;
  margin-bottom: 1rem;
}

.modal-body-content {
  padding: 1rem 1.5rem;
}

.modal-features-list {
  margin-bottom: 1.5rem;
}

.modal-features-list ul {
  list-style-type: none;
  padding-left: 0;
}

.modal-features-list li {
  padding: 0.5rem 0;
  position: relative;
  padding-left: 1.5rem;
}

.modal-features-list li:before {
  content: "✓";
  color: var(--secondary);
  position: absolute;
  left: 0;
  font-weight: bold;
}

.close-btn {
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

.close-btn:hover {
  background: var(--light);
  color: var(--dark);
}

/* Form Styles */
.input-group {
  margin-bottom: 1rem;
}

.input-label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: var(--dark);
}

.form-input {
  width: 100%;
  padding: 0.75rem 1rem;
  border: 1px solid #ddd;
  border-radius: 6px;
  font-family: 'Poppins', sans-serif;
  font-size: 0.9rem;
  transition: var(--transition);
}

.form-input:focus {
  outline: none;
  border-color: var(--primary);
  box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
}

textarea.form-input {
  min-height: 100px;
  resize: vertical;
}

.modal-bottom {
  padding: 0 1.5rem 1.5rem;
  display: flex;
  justify-content: flex-end;
}

.pay-button {
  background: var(--secondary);
  color: var(--white);
  width: 100%;
  padding: 0.9rem;
  font-size: 1rem;
}

.pay-button:hover {
  background: #00a382;
}

/* Footer */
.site-footer {
  background: var(--dark);
  color: var(--white);
  padding: 2rem 1rem;
  text-align: center;
  margin-top: 3rem;
}

.site-footer p {
  opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 768px) {
  .site-header h1 {
    font-size: 2rem;
  }
  
  .modules-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
  }
  
  .module-actions {
    flex-direction: column;
  }
  
  .modal-container {
    max-width: 100%;
  }
}

@media (max-width: 576px) {
  .site-header {
    padding: 1.5rem 1rem;
  }
  
  .site-header h1 {
    font-size: 1.75rem;
  }
  
  .modules-grid {
    grid-template-columns: 1fr;
    gap: 1.25rem;
  }
  
  .module-content {
    padding: 1.25rem;
  }
  
  .modal-body-content, .modal-top, .modal-bottom {
    padding-left: 1.25rem;
    padding-right: 1.25rem;
  }
}

/* Loading State */
.loading-spinner {
  display: inline-block;
  width: 20px;
  height: 20px;
  border: 3px solid rgba(255,255,255,.3);
  border-radius: 50%;
  border-top-color: #fff;
  animation: rotate 1s ease-in-out infinite;
  margin-right: 8px;
}

@keyframes rotate {
  to { transform: rotate(360deg); }
}

/* Success/Error Messages */
.status-message {
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

<header class="site-header">
  <h1>Premium Modules</h1>
  <p>Enhance your skills with our expertly crafted modules designed for success</p>
</header>

<div class="main-container">
  <div class="modules-grid">
    <?php while($row = $courses->fetch_assoc()): ?>
      <div class="module-card">
        <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="module-image">
        <div class="module-content">
          <h3 class="module-title"><?= htmlspecialchars($row['name']) ?></h3>
          <p class="module-description"><?= htmlspecialchars(substr($row['description'], 0, 100)) ?>...</p>
          <p class="module-price">₹<?= htmlspecialchars($row['price']) ?></p>
          <div class="module-actions">
            <button class="action-btn btn-alt" onclick="showModuleDetails('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars(addslashes($row['description'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">View Details</button>
            <button class="action-btn btn-main" onclick="openEnrollmentForm('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">Enroll Now</button>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>

<!-- Modal -->
<div class="popup-modal" id="modulePopup">
  <div class="modal-container">
    <button class="close-btn" onclick="closeModulePopup()">&times;</button>
    <div class="modal-top">
      <h2 class="modal-heading" id="modal-module-name"></h2>
      <p class="modal-cost" id="modal-module-price"></p>
    </div>
    <div class="modal-body-content">
      <div class="modal-features-list" id="modal-module-description"></div>
      <form id="enrollmentForm">
        <input type="hidden" name="plan" id="selected-plan">
        <input type="hidden" name="amount" id="selected-amount">
        
        <div class="input-group">
          <label class="input-label" for="student-name">Full Name</label>
          <input type="text" class="form-input" id="student-name" name="name" placeholder="Enter your full name" required>
        </div>
        
        <div class="input-group">
          <label class="input-label" for="student-email">Email Address</label>
          <input type="email" class="form-input" id="student-email" name="email" placeholder="Enter your email" required>
        </div>
        
        <div class="input-group">
          <label class="input-label" for="student-phone">Phone Number</label>
          <input type="text" class="form-input" id="student-phone" name="phone" placeholder="Enter your phone number" required>
        </div>
        
        <div class="input-group">
          <label class="input-label" for="student-address">Full Address</label>
          <textarea class="form-input" id="student-address" name="address" placeholder="Enter your complete address" required></textarea>
        </div>
      </form>
    </div>
    <div class="modal-bottom">
      <button type="button" class="action-btn pay-button" onclick="initiatePayment()">
        <span class="loading-spinner" id="payment-loader" style="display: none;"></span>
        <span id="payment-text">Proceed to Pay</span>
      </button>
    </div>
  </div>
</div>

<script>
let moduleModal = document.getElementById("modulePopup");
let paymentInProgress = false;

function showModuleDetails(name, desc, amount) {
  let descriptionList = desc.split(',').map(d => `<li>${d.trim()}</li>`).join('');
  document.getElementById("modal-module-name").innerText = name;
  document.getElementById("modal-module-price").innerText = "₹" + amount;
  document.getElementById("modal-module-description").innerHTML = `<h3>Module Features:</h3><ul>${descriptionList}</ul>`;
  document.getElementById("selected-plan").value = name;
  document.getElementById("selected-amount").value = amount;
  moduleModal.style.display = "flex";
}

function openEnrollmentForm(plan, amount) {
  document.getElementById("modal-module-name").innerText = plan;
  document.getElementById("modal-module-price").innerText = "₹" + amount;
  document.getElementById("modal-module-description").innerHTML = "";
  document.getElementById("selected-plan").value = plan;
  document.getElementById("selected-amount").value = amount;
  moduleModal.style.display = "flex";
}

function closeModulePopup() {
  moduleModal.style.display = "none";
  paymentInProgress = false;
  document.getElementById("payment-loader").style.display = "none";
  document.getElementById("payment-text").innerText = "Proceed to Pay";
}

function initiatePayment() {
  if (paymentInProgress) return;
  
  const enrollmentForm = document.getElementById("enrollmentForm");
  const formData = new FormData(enrollmentForm);
  const formValues = Object.fromEntries(formData);
  
  // Basic form validation
  if (!formValues.name || !formValues.email || !formValues.phone || !formValues.address) {
    alert("Please fill in all required fields");
    return;
  }
  
  paymentInProgress = true;
  document.getElementById("payment-loader").style.display = "inline-block";
  document.getElementById("payment-text").innerText = "Processing...";
  
  let priceValue = parseInt(formValues.amount.replace(/[^\d]/g, ""));

  let paymentOptions = {
    key: "rzp_test_Rc7TynjHcNrEfB",
    amount: priceValue * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: formValues.plan,
    handler: function (response) {
      // Payment successful, now submit enrollment
      fetch(window.location.href, {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: new URLSearchParams({...formValues, payment_confirmed: 1})
      })
      .then(res => res.text())
      .then(result => {
        const resultParts = result.trim().split("|");
        if (resultParts[0] === "success" && resultParts[1]) {
          window.location.href = "thankyou.php?cid=" + encodeURIComponent(resultParts[1]);
        } else {
          alert("Enrollment failed. " + result);
          paymentInProgress = false;
          document.getElementById("payment-loader").style.display = "none";
          document.getElementById("payment-text").innerText = "Proceed to Pay";
        }
      })
      .catch(error => {
        console.error("Error:", error);
        alert("An error occurred during enrollment. Please try again.");
        paymentInProgress = false;
        document.getElementById("payment-loader").style.display = "none";
        document.getElementById("payment-text").innerText = "Proceed to Pay";
      });
    },
    prefill: {
      name: formValues.name,
      email: formValues.email,
      contact: formValues.phone
    },
    theme: {
      color: "#007bff"
    }
  };

  let paymentGateway = new Razorpay(paymentOptions);
  paymentGateway.open();
  
  paymentGateway.on('payment.failed', function (response) {
    alert("Payment failed. Please try again.");
    paymentInProgress = false;
    document.getElementById("payment-loader").style.display = "none";
    document.getElementById("payment-text").innerText = "Proceed to Pay";
  });
}

// Close modal when clicking outside of it
window.onclick = function(event) {
  if (event.target == moduleModal) {
    closeModulePopup();
  }
}
</script>

</body>
</html>