<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Courses</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
body {
  font-family: "Poppins", sans-serif;
  background: #f5f7fa;
  padding: 30px;
  margin: 0;
}
h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #222;
}
.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
}
.card {
  background: #fff;
  border-radius: 18px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  overflow: hidden;
  transition: 0.3s;
}
.card:hover {
  transform: translateY(-5px);
}
.card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.card-content {
  padding: 18px 20px;
  text-align: left;
}
h3 {
  margin: 10px 0 5px;
  font-size: 18px;
  color: #111;
}
p {
  margin: 4px 0;
  color: #555;
  font-size: 14px;
}
button {
  background: #000;
  color: #fff;
  border: none;
  padding: 9px 18px;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s;
}
button:hover {
  background: #333;
}

/* ===== MODAL STYLES ===== */
.modal-overlay {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.6);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 1000;
}
.modal {
  background: #fff;
  border-radius: 16px;
  max-width: 450px;
  width: 90%;
  padding: 25px 30px;
  position: relative;
  animation: zoomIn 0.3s ease;
  box-shadow: 0 8px 30px rgba(0,0,0,0.15);
}
@keyframes zoomIn {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}
.modal img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 15px;
}
.modal h3 {
  margin: 5px 0 8px;
  font-size: 20px;
  color: #111;
  text-align: center;
}
.modal ul {
  list-style: disc;
  padding-left: 18px;
  color: #444;
  font-size: 14px;
  margin: 10px 0 15px;
}
.modal ul li {
  margin-bottom: 6px;
}
.close-btn {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 22px;
  color: #555;
  cursor: pointer;
  transition: 0.3s;
}
.close-btn:hover {
  color: #000;
}
.price {
  font-weight: 600;
  font-size: 16px;
  margin-bottom: 15px;
  color: #000;
  text-align: center;
}
.modal button {
  width: 100%;
  background: #000;
}
</style>
</head>
<body>

<h2>Available Courses</h2>

<div class="container">
<?php while($c = $courses->fetch_assoc()): ?>
<div class="card">
  <?php if($c['image']): ?>
    <img src="<?= htmlspecialchars($c['image']) ?>" alt="">
  <?php else: ?>
    <img src="https://via.placeholder.com/400x200?text=Course+Image" alt="">
  <?php endif; ?>
  <div class="card-content">
    <h3><?= htmlspecialchars($c['name']) ?></h3>
    <p><b>Duration:</b> <?= htmlspecialchars($c['duration']) ?></p>
    <p><b>Type:</b> <?= htmlspecialchars($c['type']) ?></p>
    <p><b>Price:</b> ₹<?= htmlspecialchars($c['price']) ?></p>
    <button onclick="openModal(
      '<?= htmlspecialchars(addslashes($c['name'])) ?>',
      '<?= htmlspecialchars(addslashes($c['type'])) ?>',
      '<?= htmlspecialchars(addslashes($c['duration'])) ?>',
      '<?= htmlspecialchars(addslashes($c['description'])) ?>',
      '<?= htmlspecialchars($c['image']) ?>',
      '<?= htmlspecialchars($c['price']) ?>'
    )">View Details</button>
  </div>
</div>
<?php endwhile; ?>
</div>

<!-- Popup Modal -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" id="courseModal">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img id="modalImage" src="" alt="Course Image">
    <h3 id="modalTitle"></h3>
    <div class="price">₹<span id="modalPrice"></span></div>
    <ul id="modalDescription"></ul>
    <button id="enrollBtn">Enroll Now</button>
  </div>
</div>

<script>
// Open modal dynamically
function openModal(name, type, duration, description, image, price){
  document.getElementById("modalTitle").innerText = name;
  document.getElementById("modalPrice").innerText = price;
  document.getElementById("modalImage").src = image || "https://via.placeholder.com/400x200?text=Course+Image";

  const descList = document.getElementById("modalDescription");
  descList.innerHTML = "";
  const points = description.split(',');
  points.forEach(p => {
    if(p.trim()) {
      const li = document.createElement("li");
      li.innerText = p.trim();
      descList.appendChild(li);
    }
  });

  const btn = document.getElementById("enrollBtn");
  btn.onclick = () => enrollNow(name, price);

  document.getElementById("modalOverlay").style.display = "flex";
}

// Close modal
function closeModal(){
  document.getElementById("modalOverlay").style.display = "none";
}

// Razorpay Integration
function enrollNow(courseName, amount){
  var options = {
    "key": "rzp_live_pA6jgjncp78sq7", // your Razorpay key
    "amount": amount * 100,
    "currency": "INR",
    "name": "Faiz Computer Institute",
    "description": courseName,
    "handler": function (response){
        alert("✅ Payment Successful! Payment ID: " + response.razorpay_payment_id);
        window.location.href='thank_you.php';
    },
    "theme": {"color": "#000"}
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
}
</script>

</body>
</html>
