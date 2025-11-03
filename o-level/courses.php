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
body{
  font-family:Poppins,sans-serif;
  background:#f5f7fa;
  padding:30px;
  margin:0;
}
.container{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
  gap:25px;
}
.card{
  background:#fff;
  border-radius:18px;
  box-shadow:0 4px 15px rgba(0,0,0,0.08);
  overflow:hidden;
  transition:0.3s;
}
.card:hover{transform:translateY(-5px);}
.card img{width:100%;height:180px;object-fit:cover;}
.card-content{padding:20px;}
h3{margin:10px 0 5px;}
p{margin:5px 0;color:#555;}
button{
  background:#000;
  color:#fff;
  border:none;
  padding:10px 20px;
  border-radius:8px;
  cursor:pointer;
  transition:0.3s;
}
button:hover{background:#222;}

/* Popup modal */
.modal{
  display:none;
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background:rgba(0,0,0,0.6);
  justify-content:center;
  align-items:center;
  z-index:999;
}
.modal-content{
  background:#fff;
  border-radius:20px;
  padding:30px;
  width:90%;
  max-width:500px;
  box-shadow:0 6px 20px rgba(0,0,0,0.2);
  position:relative;
  animation:popIn 0.3s ease;
}
@keyframes popIn{
  from{transform:scale(0.9);opacity:0;}
  to{transform:scale(1);opacity:1;}
}
.close-btn{
  position:absolute;
  top:15px;
  right:20px;
  background:none;
  border:none;
  font-size:20px;
  cursor:pointer;
}
.modal ul{margin-top:10px;padding-left:20px;color:#444;}
</style>
</head>
<body>

<h2 style="text-align:center;margin-bottom:30px;">Available Courses</h2>

<div class="container">
<?php while($c = $courses->fetch_assoc()): ?>
<div class="card">
  <?php if($c['image']): ?>
    <img src="<?= htmlspecialchars($c['image']) ?>" alt="">
  <?php endif; ?>
  <div class="card-content">
    <h3><?= htmlspecialchars($c['name']) ?></h3>
    <p><b>Total Videos:</b> <?= htmlspecialchars($c['total_videos']) ?></p>
    <p><b>Type:</b> <?= htmlspecialchars($c['type']) ?></p>
    <p><b>Price:</b> ₹<?= htmlspecialchars($c['price']) ?></p>
    <button onclick="showDetails(`<?= htmlspecialchars($c['name']) ?>`, `<?= htmlspecialchars($c['description']) ?>`, <?= $c['price'] ?>)">View Details</button>
  </div>
</div>
<?php endwhile; ?>
</div>

<!-- Popup modal -->
<div class="modal" id="detailsModal">
  <div class="modal-content">
    <button class="close-btn" onclick="closeModal()">×</button>
    <h2 id="modalTitle"></h2>
    <ul id="modalDesc"></ul>
    <p><b>Price:</b> ₹<span id="modalPrice"></span></p>
    <button onclick="enrollNow(currentCourse, currentPrice)">Enroll Now</button>
  </div>
</div>

<script>
let currentCourse = "";
let currentPrice = 0;

function showDetails(name, desc, price){
  currentCourse = name;
  currentPrice = price;

  document.getElementById('modalTitle').innerText = name;
  document.getElementById('modalPrice').innerText = price;

  const list = desc.split(',').map(item => `<li>${item.trim()}</li>`).join('');
  document.getElementById('modalDesc').innerHTML = list;

  document.getElementById('detailsModal').style.display = 'flex';
}

function closeModal(){
  document.getElementById('detailsModal').style.display = 'none';
}

window.onclick = function(e){
  if(e.target.id === 'detailsModal'){
    closeModal();
  }
}

// Razorpay integration
function enrollNow(courseName, amount){
  var options = {
    "key": "rzp_live_pA6jgjncp78sq7",
    "amount": amount * 100,
    "currency": "INR",
    "name": "Pyaara Store",
    "description": courseName,
    "handler": function (response){
        alert("Payment Successful! Payment ID: " + response.razorpay_payment_id);
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
