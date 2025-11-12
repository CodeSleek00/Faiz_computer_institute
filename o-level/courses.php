<?php
require 'db_connect.php';
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");

// Student ID generator
function generateStudentID($conn) {
    $result = $conn->query("SELECT COUNT(*) as total FROM olevel_enrollments");
    $count = $result->fetch_assoc()['total'] ?? 0;
    return "Faiz-OLEVELMOD-" . (1001 + $count);
}

// Handle form + payment confirmation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $student_id = generateStudentID($conn);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $plan_name = mysqli_real_escape_string($conn, $_POST['plan']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<style>
body {
  font-family: 'Poppins', sans-serif;
  background: #f5f7fa;
  margin: 0; padding: 0;
}
.container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 20px;
  padding: 40px;
}
.card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  overflow: hidden;
  transition: 0.3s;
}
.card:hover { transform: translateY(-5px); }
.card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}
.card-content {
  padding: 15px;
  text-align: center;
}
h3 { margin: 10px 0; color: #333; }
.price { color: #00b894; font-weight: 600; }
.btn {
  background: #007bff; color: #fff;
  border: none; padding: 10px 18px;
  border-radius: 6px; cursor: pointer;
  margin: 5px; font-size: 14px;
}
.btn:hover { background: #0056b3; }

/* Modal */
.modal {
  display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
  background: rgba(0,0,0,0.6); justify-content: center; align-items: center;
}
.modal-content {
  background: #fff; padding: 25px; border-radius: 12px;
  width: 90%; max-width: 450px; position: relative;
}
.close {
  position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px;
}
ul { text-align: left; }
form input, textarea {
  width: 100%; margin: 6px 0; padding: 10px;
  border: 1px solid #ccc; border-radius: 6px;
}
</style>
</head>
<body>

<h1 style="text-align:center; margin-top:20px;">Premium Courses</h1>

<div class="container">
<?php while($row = $courses->fetch_assoc()): ?>
  <div class="card">
    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Course Image">
    <div class="card-content">
      <h3><?= htmlspecialchars($row['name']) ?></h3>
      <p class="price">₹<?= htmlspecialchars($row['price']) ?></p>
      <button class="btn" onclick="showDetails('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars(addslashes($row['description'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">View Details</button>
      <button class="btn" onclick="openForm('<?= htmlspecialchars(addslashes($row['name'])) ?>', '<?= htmlspecialchars($row['price']) ?>')">Enroll Now</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<!-- Modal -->
<div class="modal" id="popup">
  <div class="modal-content">
    <span class="close" onclick="closePopup()">&times;</span>
    <h2 id="modal-title"></h2>
    <ul id="modal-desc"></ul>
    <form id="enrollForm">
      <input type="hidden" name="plan" id="plan">
      <input type="hidden" name="price" id="price">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <textarea name="address" placeholder="Full Address" required></textarea>
      <button type="button" class="btn" onclick="startPayment()">Proceed to Pay</button>
    </form>
  </div>
</div>

<script>
let modal = document.getElementById("popup");

function showDetails(name, desc, price) {
  let descList = desc.split(',').map(d => `<li>${d.trim()}</li>`).join('');
  document.getElementById("modal-title").innerText = name + " - ₹" + price;
  document.getElementById("modal-desc").innerHTML = descList;
  document.getElementById("plan").value = name;
  document.getElementById("price").value = price;
  modal.style.display = "flex";
}

function openForm(plan, price) {
  document.getElementById("modal-title").innerText = plan + " - ₹" + price;
  document.getElementById("modal-desc").innerHTML = "";
  document.getElementById("plan").value = plan;
  document.getElementById("price").value = price;
  modal.style.display = "flex";
}

function closePopup() {
  modal.style.display = "none";
}

function startPayment() {
  const form = document.getElementById("enrollForm");
  const data = Object.fromEntries(new FormData(form));

  let options = {
    key: "rzp_test_Rc7TynjHcNrEfB",
    amount: parseInt(data.price) * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: data.plan,
    handler: function () {
      fetch("", {
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
        }
      });
    }
  };

  let rzp = new Razorpay(options);
  rzp.open();
}
</script>

</body>
</html>
