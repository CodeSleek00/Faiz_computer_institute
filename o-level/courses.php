<?php
require 'db_connect.php';

// Fetch courses
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");

// If enrollment form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll_submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $course = trim($_POST['course_name']);
    $price = floatval($_POST['price']);

    // Generate next Enrollment ID (start from 1001)
    $res = $conn->query("SELECT id FROM olevel_enrollments ORDER BY id DESC LIMIT 1");
    $next = ($res && $res->num_rows > 0) ? ($res->fetch_assoc()['id'] + 1) : 1001;
    $enrollment_id = "FAIZ-OLEVELMOD-" . $next;

    // Use phone as password BUT hash it before storing
    $password_hash = password_hash($phone, PASSWORD_DEFAULT);

    // Save to database (including password hash)
    $stmt = $conn->prepare("INSERT INTO olevel_enrollments 
        (student_id, name, email, phone, address, plan_name, amount, password) 
        VALUES (?,?,?,?,?,?,?,?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // types: s s s s s s d s  => "ssssssds"
    $stmt->bind_param("ssssssds", $enrollment_id, $name, $email, $phone, $address, $course, $price, $password_hash);
    $stmt->execute();
    $stmt->close();

    // Pass data to JS to trigger Razorpay
    echo "<script>
      const enrollmentData = {
        id: '". addslashes($enrollment_id) ."',
        name: '". addslashes($name) ."',
        course: '". addslashes($course) ."',
        price: ". json_encode($price) ."
      };
    </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Enroll in Premium Courses | Pyaara Store</title>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
<style>
body{font-family:'Poppins',sans-serif;margin:0;background:#f8f9fa;}
header{background:#1e40af;color:#fff;text-align:center;padding:2rem 1rem;margin-bottom:1.5rem;}
h1{margin:0;font-size:1.8rem}
.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;padding:1rem;max-width:1100px;margin:auto;}
.card{background:#fff;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.1);overflow:hidden;transition:.3s}
.card:hover{transform:translateY(-5px);}
.card img{width:100%;height:160px;object-fit:cover}
.card-body{padding:1rem;}
.card-body h3{margin:0;font-size:1.1rem;}
.price{font-weight:600;color:#1e40af;margin:.5rem 0;}
button{cursor:pointer;padding:.6rem 1rem;border:none;border-radius:6px;font-weight:500;}
.btn-primary{background:#1e40af;color:#fff;}
.btn-outline{background:#fff;color:#1e40af;border:1px solid #1e40af;}
.modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);justify-content:center;align-items:center;z-index:999;}
.modal-content{background:#fff;border-radius:10px;max-width:400px;width:90%;padding:1.5rem;box-shadow:0 4px 10px rgba(0,0,0,.2);}
input,textarea{width:100%;padding:8px;margin:5px 0 10px;border:1px solid #ccc;border-radius:5px;}
.close{float:right;font-size:1.3rem;cursor:pointer;}
footer{text-align:center;padding:1rem;color:#6b7280;font-size:.9rem;margin-top:2rem;}
.note{font-size:.85rem;color:#374151;margin-top:6px;}
</style>
</head>
<body>

<header>
  <h1>Premium Learning Courses</h1>
  <p>Expand your knowledge with our expertly crafted modules</p>
</header>

<div class="grid">
<?php while($c = $courses->fetch_assoc()): ?>
  <div class="card">
    <img src="<?= htmlspecialchars($c['image'] ?: 'https://via.placeholder.com/400x200/1e40af/ffffff?text=Course+Image') ?>" alt="Course">
    <div class="card-body">
      <h3><?= htmlspecialchars($c['name']) ?></h3>
      <p style="color:#666;font-size:.9rem;"><?= htmlspecialchars(substr($c['description'],0,60)) ?>...</p>
      <div class="price">₹<?= htmlspecialchars($c['price']) ?></div>
      <button class="btn-primary" onclick="openForm('<?= htmlspecialchars($c['name']) ?>', <?= $c['price'] ?>)">Enroll</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<!-- Enrollment Modal -->
<div class="modal" id="enrollModal">
  <div class="modal-content">
    <span class="close" onclick="closeForm()">&times;</span>
    <h2 style="margin-top:0;">Enroll in <span id="courseTitle"></span></h2>
    <form method="POST">
      <input type="hidden" name="course_name" id="courseInput">
      <input type="hidden" name="price" id="priceInput">
      <label>Full Name</label>
      <input type="text" name="name" required>
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Phone (This will be your password)</label>
      <input type="text" name="phone" required>
      <div class="note">Note: Your phone number will be used as your initial password (stored securely).</div>
      <label>Address</label>
      <textarea name="address" required></textarea>
      <button type="submit" name="enroll_submit" class="btn-primary" style="width:100%;">Proceed to Payment</button>
    </form>
  </div>
</div>

<!-- Thank You Modal -->
<div class="modal" id="thankYouModal">
  <div class="modal-content" style="text-align:center;">
    <h2>🎉 Payment Successful!</h2>
    <p>Thank you for enrolling in <b id="thankCourse"></b>.</p>
    <p>Your Enrollment ID:</p>
    <div style="font-weight:700;color:#1e40af" id="thankEnrollID"></div>
    <br>
    <button class="btn-outline" onclick="location.reload()">Back to Courses</button>
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

// Razorpay auto popup if enrollmentData exists
if(typeof enrollmentData !== 'undefined'){
  startPayment(enrollmentData);
}

function startPayment(data){
  const options = {
    key: "rzp_test_Rc7TynjHcNrEfB", // Replace with your Razorpay key
    amount: data.price * 100,
    currency: "INR",
    name: "Pyaara Store",
    description: data.course,
    handler: function (response){
      fetch('', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `update_payment=1&payment_id=${response.razorpay_payment_id}&enrollment_id=${encodeURIComponent(data.id)}`
      });
      showThankYou(data);
    },
    prefill: { name: data.name },
    theme: { color: "#1e40af" }
  };
  const rzp = new Razorpay(options);
  rzp.open();
}

function showThankYou(data){
  document.getElementById('thankCourse').textContent = data.course;
  document.getElementById('thankEnrollID').textContent = data.id;
  document.getElementById('thankYouModal').style.display='flex';
}
handler: function (response) {
    $.ajax({
        url: 'verify_payment.php',
        type: 'POST',
        data: {
            razorpay_payment_id: response.razorpay_payment_id,
            razorpay_order_id: response.razorpay_order_id,
            razorpay_signature: response.razorpay_signature
        },
        success: function (res) {
            window.location.href = "thank_you.php";
        }
    });
}

</script>

<?php
// Handle payment update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_payment'])) {
    $pid = $_POST['payment_id'];
    $eid = $_POST['enrollment_id'];
    $stmt = $conn->prepare("UPDATE olevel_enrollments SET payment_id=?, payment_status='Success' WHERE student_id=?");
    $stmt->bind_param("ss", $pid, $eid);
    $stmt->execute();
    $stmt->close();
    exit;
}
?>
</body>
</html>
