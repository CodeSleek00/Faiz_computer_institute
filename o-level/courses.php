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
body{font-family:Poppins,sans-serif;background:#f6f7fb;margin:0;padding:40px;}
.container{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:25px;}
.card{background:#fff;border-radius:20px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,0.1);transition:.3s;position:relative;overflow:hidden;}
.card:hover{transform:translateY(-5px);}
.card img{width:60px;height:60px;border-radius:50%;margin-bottom:10px;}
.card h3{margin:10px 0;font-size:18px;}
.price{font-weight:600;margin:15px 0;}
button{background:#000;color:#fff;border:none;padding:10px 20px;border-radius:10px;cursor:pointer;}
.details{margin-top:15px;display:none;animation:fadeIn .4s ease-in-out;}
@keyframes fadeIn{from{opacity:0;transform:translateY(10px);}to{opacity:1;transform:translateY(0);}}
ul{padding-left:20px;margin:10px 0;}
ul li{margin:6px 0;font-size:14px;color:#444;}
</style>
</head>
<body>
<h2 style="text-align:center;margin-bottom:30px;">Available Single Courses</h2>

<div class="container">
<?php while($row = $courses->fetch_assoc()): ?>
  <div class="card" id="card-<?= $row['id'] ?>">
    <img src="<?= $row['image'] ?: 'https://via.placeholder.com/60' ?>" alt="">
    <h3><?= htmlspecialchars($row['name']) ?></h3>
    <p class="price">₹<?= number_format($row['price'], 2) ?></p>
    <button onclick="toggleDetails(<?= $row['id'] ?>)">View Details</button>

    <div class="details" id="details-<?= $row['id'] ?>">
      <ul>
        <li><strong>Type:</strong> <?= htmlspecialchars($row['type']) ?></li>
        <li><strong>Duration:</strong> <?= htmlspecialchars($row['duration']) ?></li>
        <li><strong>Description:</strong> <?= nl2br(htmlspecialchars($row['description'])) ?></li>
        <li><strong>Price:</strong> ₹<?= number_format($row['price'], 2) ?></li>
      </ul>
      <button onclick="enrollNow('<?= $row['id'] ?>','<?= $row['price'] ?>','<?= htmlspecialchars($row['name']) ?>')">Proceed to Payment</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<script>
function toggleDetails(id){
  const section = document.getElementById("details-"+id);
  section.style.display = (section.style.display === "block") ? "none" : "block";
}

function enrollNow(courseId, amount, name){
  var options = {
    key: "rzp_lve_pA6jgjncp78sq7",
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
    theme: {color: "#000"}
  };
  var rzp = new Razorpay(options);
  rzp.open();
}
</script>
</body>
</html>
