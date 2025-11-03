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
.card{background:#fff;border-radius:20px;padding:20px;box-shadow:0 4px 20px rgba(0,0,0,0.1);transition:.3s;}
.card:hover{transform:translateY(-5px);}
.card img{width:60px;height:60px;border-radius:50%;}
.card h3{margin:10px 0;font-size:18px;}
.badge{display:inline-block;background:#eee;padding:5px 10px;border-radius:6px;font-size:12px;margin-right:5px;}
.price{font-weight:600;margin:15px 0;}
button{background:#000;color:#fff;border:none;padding:10px 20px;border-radius:10px;cursor:pointer;}
.location{font-size:13px;color:#777;}
</style>
</head>
<body>
<h2 style="text-align:center;margin-bottom:30px;">Available Single Courses</h2>
<div class="container">
<?php while($row = $courses->fetch_assoc()): ?>
  <div class="card">
    <img src="<?= $row['image'] ?: 'https://via.placeholder.com/60' ?>" alt="">
    <h3><?= htmlspecialchars($row['name']) ?></h3>
    <div>
      <?php foreach(explode(',', $row['tags']) as $tag): ?>
        <span class="badge"><?= htmlspecialchars(trim($tag)) ?></span>
      <?php endforeach; ?>
    </div>
    <p class="price">₹<?= number_format($row['price'], 2) ?></p>
    <p class="location"><?= htmlspecialchars($row['location']) ?></p>
    <button onclick="enrollNow('<?= $row['id'] ?>','<?= $row['price'] ?>','<?= htmlspecialchars($row['name']) ?>')">Enroll Now</button>
  </div>
<?php endwhile; ?>
</div>

<script>
function enrollNow(courseId, amount, name){
  var options = {
    key: "rzp_lve_pA6jgjncp78sq7", // your live Razorpay key
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
