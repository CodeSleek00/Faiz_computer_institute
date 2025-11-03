<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM single_courses ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Single Courses</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
body {
  font-family: "Poppins", sans-serif;
  background: #f6f7fb;
  margin: 0;
  padding: 40px;
}
h2 {
  text-align: center;
  margin-bottom: 30px;
  color: #222;
}
.container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 25px;
}
.card {
  background: #fff;
  border-radius: 16px;
  padding: 20px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
  text-align: center;
}
.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.12);
}
.card img {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 10px;
}
.card h3 {
  font-size: 17px;
  color: #222;
  margin: 8px 0 4px;
  line-height: 1.3;
}
.price {
  font-weight: 600;
  font-size: 16px;
  color: #111;
  margin: 6px 0 14px;
}
button {
  background: #111;
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

/* --- Popup Modal Styles --- */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.6);
  display: none;
  justify-content: center;
  align-items: center;
  z-index: 999;
}
.modal {
  background: #fff;
  border-radius: 14px;
  padding: 25px 30px;
  max-width: 420px;
  width: 90%;
  box-shadow: 0 6px 25px rgba(0,0,0,0.2);
  animation: zoomIn 0.3s ease;
  position: relative;
}
@keyframes zoomIn {
  from { transform: scale(0.8); opacity: 0; }
  to { transform: scale(1); opacity: 1; }
}
.modal h3 {
  margin: 0 0 10px;
  text-align: center;
  font-size: 20px;
  color: #111;
}
.modal ul {
  list-style: none;
  padding: 0;
  margin: 10px 0 15px;
}
.modal ul li {
  margin: 8px 0;
  font-size: 15px;
  color: #444;
  line-height: 1.4;
}
.modal button {
  width: 100%;
  background: #000;
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
</style>
</head>
<body>

<h2>Available Single Courses</h2>

<div class="container">
<?php while($row = $courses->fetch_assoc()): ?>
  <div class="card">
    <img src="<?= $row['image'] ?: 'https://via.placeholder.com/70' ?>" alt="">
    <h3><?= htmlspecialchars($row['name']) ?></h3>
    <p class="price">₹<?= number_format($row['price'], 2) ?></p>
    <button onclick="openModal(
      '<?= htmlspecialchars(addslashes($row['name'])) ?>',
      '<?= htmlspecialchars(addslashes($row['type'])) ?>',
      '<?= htmlspecialchars(addslashes($row['duration'])) ?>',
      '<?= htmlspecialchars(addslashes($row['description'])) ?>',
      '<?= $row['price'] ?>',
      '<?= $row['id'] ?>'
    )">View Details</button>
  </div>
<?php endwhile; ?>
</div>

<!-- Popup Modal -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" id="courseModal">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <h3 id="modalTitle"></h3>
    <ul>
      <li><strong>Type:</strong> <span id="modalType"></span></li>
      <li><strong>Duration:</strong> <span id="modalDuration"></span></li>
      <li><strong>Description:</strong> <span id="modalDesc"></span></li>
      <li><strong>Price:</strong> ₹<span id="modalPrice"></span></li>
    </ul>
    <button id="modalEnrollBtn">Proceed to Payment</button>
  </div>
</div>

<script>
function openModal(name, type, duration, description, price, id){
  document.getElementById("modalTitle").innerText = name;
  document.getElementById("modalType").innerText = type;
  document.getElementById("modalDuration").innerText = duration;
  document.getElementById("modalDesc").innerText = description;
  document.getElementById("modalPrice").innerText = price;
  
  const btn = document.getElementById("modalEnrollBtn");
  btn.onclick = function(){
    enrollNow(id, price, name);
  };

  document.getElementById("modalOverlay").style.display = "flex";
}

function closeModal(){
  document.getElementById("modalOverlay").style.display = "none";
}

function enrollNow(courseId, amount, name){
  var options = {
    key: "rzp_live_pA6jgjncp78sq7",
    amount: amount * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: name,
    image: "https://yourdomain.com/logo.png",
    handler: function (response) {
      fetch("verify_payment.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "payment_id="+response.razorpay_payment_id+"&course_id="+courseId
      }).then(res=>res.text()).then(data=>alert(data));
    },
    theme: { color: "#000" }
  };
  var rzp = new Razorpay(options);
  rzp.open();
}
</script>
</body>
</html>
