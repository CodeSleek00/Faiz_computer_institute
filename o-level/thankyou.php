<?php
$student_id = $_GET['cid'] ?? 'N/A';
$name = $_GET['name'] ?? 'Student';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Successful 🎉</title>
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
  body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#e3e6ff,#f9f9ff);
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
    margin:0;
  }
  .card{
    background:#fff;
    border-radius:20px;
    box-shadow:0 10px 40px rgba(0,0,0,0.15);
    padding:40px 30px;
    text-align:center;
    max-width:400px;
    width:90%;
    animation:popIn .5s ease;
  }
  @keyframes popIn {
    from{transform:scale(0.8);opacity:0;}
    to{transform:scale(1);opacity:1;}
  }
  h1{
    color:#4a63ff;
    font-size:26px;
    margin-bottom:10px;
  }
  p{
    color:#444;
    margin:8px 0;
    font-size:15px;
  }
  .id-box{
    background:#f2f4ff;
    padding:12px;
    border-radius:10px;
    margin:15px 0;
    font-weight:600;
    color:#222;
  }
  .btn{
    background:#4a63ff;
    color:#fff;
    border:none;
    border-radius:8px;
    padding:12px 20px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
  }
  .btn:hover{background:#384be0;}
  .emoji{
    font-size:50px;
    margin-bottom:10px;
  }
</style>
</head>
<body>
  <div class="card">
    <div class="emoji">🎉</div>
    <h1>Payment Successful!</h1>
    <p>Thank you, <b><?php echo htmlspecialchars($name); ?></b></p>
    <p>Your Student ID:</p>
    <div class="id-box"><?php echo htmlspecialchars($student_id); ?></div>
    <p>Password: <b>Your Phone Number</b></p>
    <button class="btn" onclick="window.location.href='index.php'">Go to Home</button>
  </div>

<script>
function launchConfetti(){
  const duration = 3 * 1000;
  const end = Date.now() + duration;
  (function frame(){
    confetti({
      particleCount: 6,
      angle: 60,
      spread: 70,
      origin: {x:0}
    });
    confetti({
      particleCount: 6,
      angle: 120,
      spread: 70,
      origin: {x:1}
    });
    if(Date.now() < end) requestAnimationFrame(frame);
  }());
}
launchConfetti();
</script>
</body>
</html>
