<?php
require 'db_connect.php';
session_start();

// ✅ Insert data after payment success
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_confirmed'])) {
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $plan    = mysqli_real_escape_string($conn, $_POST['plan_name']);
    $price   = (float)$_POST['price_val'];

    // Generate Student ID
    $res = $conn->query("SELECT MAX(id) AS last_id FROM olevel_enrollments");
    $row = $res->fetch_assoc();
    $next = ($row['last_id'] ?? 1000) + 1;
    $student_id = "FAIZ-OLEVELMOD-" . $next;

    $password = $phone;
    $payment_status = 'Paid';

    $stmt = $conn->prepare("INSERT INTO olevel_enrollments 
        (student_id, name, email, phone, address, plan_name, amount, payment_status, password)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssdss", $student_id, $name, $email, $phone, $address, $plan, $price, $payment_status, $password);

    if ($stmt->execute()) {
        echo "success|$student_id"; // 👈 Return student ID for redirect
    } else {
        echo "error|" . $stmt->error;
    }
    $stmt->close();
    exit;
}

// ✅ Fetch courses
$courses = $conn->query("SELECT * FROM single_courses ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="olevel.css?v=1.71">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="images/logo.png">
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
   
    <title>Faiz Computer Institute</title>
   <style>
    .single{background:#1e40af;color:#fff;text-align:center;padding:2rem 1rem;margin-bottom:1.5rem;}
   .course-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1rem;padding:1rem;max-width:1100px;margin:auto;}
.course-card{background:#fff;border-radius:10px;box-shadow:0 2px 6px rgba(0,0,0,.1);overflow:hidden;transition:.3s}
.course-card:hover{transform:translateY(-5px);}
.course-image{width:100%;height:160px;object-fit:cover}
.course-body{padding:1rem;}
.course-title{margin:0;font-size:1.1rem;}
.course-price{font-weight:600;color:#1e40af;margin:.5rem 0;}
.enroll-btn{background:#1e40af;color:#fff;cursor:pointer;padding:.6rem 1rem;border:none;border-radius:6px;font-weight:500;}
.modal-overlay{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);justify-content:center;align-items:center;z-index:999;}
.modal-container{background:#fff;border-radius:10px;max-width:400px;width:90%;padding:1.5rem;box-shadow:0 4px 10px rgba(0,0,0,.2);}
.close-btn{float:right;font-size:1.3rem;cursor:pointer;}
input,textarea{width:100%;padding:8px;margin:5px 0 10px;border:1px solid #ccc;border-radius:5px;}
footer{text-align:center;padding:1rem;color:#6b7280;font-size:.9rem;margin-top:2rem;}
</style>
 
</head>
<body>
  
    <header>
        <div class="head">
            <ul class="head1">
                <a href="index.php"><li>For Individual</li></a>
                <a href="university/university.php"><li>For University Courses</li></a>
                <a href="schooling/school.html"><li>For High School & Intermediate Courses</li></a>
                <a href="free/free.html"><li>For Free Courses</li></a>
            </ul>
        </div>
    </header>
     <nav>
        <div class="nav-left">
           
            <a href="index.php" style="text-decoration: none; color: #00167a;"></a>Faiz Computer Institute
        </div>

        <div class="nav-center">
            <button id="exploreBtn">
                Explore <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown" id="dropdownMenu">
                <div class="dropdown-column">
                    <h4>Explore </h4>
                    <a href="index.php"><i class="fa-thin fa-circle-user"></i> Individual </a>
                   <a href="university/university.php"><i class="fa-thin fa-building-columns"></i>University</a>
                    <a href="schooling/school.html"><i class="fa-thin fa-school"></i> Schooling</a>
                    <a href="free/free.html"><i class="fa-thin fa-money-check"></i>  Free</a>
                </div>
                <div class="dropdown-column">
                    <h4>Online Degree</h4>
                    <a href="university/view.php?id=18"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="university/view.php?id=25"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="university/view.php?id=19"><i class="fas fa-book"></i> BBA</a>
                    <a href="university/view.php?id=21"><i class="fas fa-briefcase"></i> MBA</a>
                    <a href="university/university.php">More<i class="fa-solid fa-arrow-right"></i></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>Trending Courses</h4>
                    <a href="#"><i class="fab fa-python"></i> Python Programming</a>
                    <a href="#"><i class="fas fa-palette"></i> Graphic Design</a>
                    <a href="#"><i class="fas fa-calculator"></i> Tally Prime</a>
                    <a href="#"><i class="fas fa-bullhorn"></i> Digital Marketing</a>
                </div>
                <div class="dropdown-column">
                    <h4>Professional Courses</h4>
                    <a href="#"><i class="fas fa-layer-group"></i> Full Stack Development</a>
                    <a href="#"><i class="fas fa-table"></i> Advanced Excel</a>
                    <a href="#"><i class="fas fa-network-wired"></i> Networking</a>
                    <a href="#"><i class="fas fa-user-secret"></i> Ethical Hacking</a>
                </div>
            </div>
        </div>

        <div class="nav-right">
            <div class="auth-buttons">
                <button class="login-btn">Login</button>
              <a href="free/free.html" style="text-decoration: none;">  <button class="signup-btn">Free Courses</button></a>
            </div>
            
        </div>

        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" id="mobileToggle">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Left Side Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <div class="logo">
                Faiz Computer Institute
            </div>
            <button class="mobile-close" id="mobileClose">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileRoles">
                <span>Explore</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileRoles">
                 <a href="index.php"><i class="fa-thin fa-circle-user"></i> Individual </a>
                   <a href="university/university.php"><i class="fa-thin fa-building-columns"></i>University</a>
                    <a href="schooling/school.html"><i class="fa-thin fa-school"></i> Schooling</a>
                    <a href="free/free.html"><i class="fa-thin fa-money-check"></i>  Free</a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileDegree">
                <span>Online Degree</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileDegree">
               <a href="university/view.php?id=18"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="university/view.php?id=25"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="university/view.php?id=19"><i class="fas fa-book"></i> BBA</a>
                    <a href="university/view.php?id=21"><i class="fas fa-briefcase"></i> MBA</a>
                    <a href="university/university.php">More<i class="fa-solid fa-arrow-right"> </i></a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileTrending">
                <span>Trending Courses</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileTrending">
                <a href="#"><i class="fab fa-python"></i> Python Programming</a>
                <a href="#"><i class="fas fa-palette"></i> Graphic Design</a>
                <a href="#"><i class="fas fa-calculator"></i> Tally Prime</a>
                <a href="#"><i class="fas fa-bullhorn"></i> Digital Marketing</a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileProfessional">
                <span>Professional Courses</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileProfessional">
                <a href="#"><i class="fas fa-layer-group"></i> Full Stack Development</a>
                <a href="#"><i class="fas fa-table"></i> Advanced Excel</a>
                <a href="#"><i class="fas fa-network-wired"></i> Networking</a>
                <a href="#"><i class="fas fa-user-secret"></i> Ethical Hacking</a>
            </div>
        </div>
        
        <div class="mobile-auth">
            <button class="mobile-login">Login</button>
            <button class="mobile-signup">Sign Up</button>
        </div>
        
        <div class="mobile-free">
            <i class="fas fa-gift"></i>
           <a href="free/free.html"> <span>Free Courses</span></a>
        </div>
    </div>
     <div class="carousel-wrapper">
   
    <div class="carousel-container" id="carousel">

      <!-- Card 1 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2>Join O-Level (Online/Offline)</h2>
            <p>Join our O Level Course (Online or Offline) and get live sessions, video lectures, mock tests & full exam support — all at a minimal cost.</p>
          </div>
          <button> Enroll Now →</button>
        </div>
        <div class="card-image">
          <img src="../images/2.png" alt="AI Learning">
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2 style="color: white;">Join CCC (Online/Offline)</h2>
            <p style="color: white;">Join our CCC Course (Online or Offline) and get live sessions, video lectures, mock tests & full exam support — all at a minimal cost.</p>
          </div>
          <button>Enroll Now →</button>
        </div>
        <div class="card-image">
          <img src="../images/1.png" alt="Business Growth">
        </div>
      </div>

    
    </div>
    <h1 class="o-level-title">Start Your O Level Preparation (Online/Offline)</h1>
  <p class="o-level-subtitle">Transparent pricing tailored to your needs, ensuring affordability without compromising on quality.</p>

  <div class="o-level-pricing">
    <div class="o-level-card">
      <div class="o-level-plan-title">Basic Access</div>
      <div class="o-level-plan-subtitle">O Level</div>
      <button class="o-level-btn" onclick="window.location.href='enroll.php?plan=Basic Access&price=6000'">Enroll Now</button>
      <div class="o-level-price">₹6,000</div>
      <ul class="o-level-features">
        <li>Access to all Subject Video Lectures</li>
        <li>150+ Mock Test</li>
        <li>Live-Session</li>
        <li>Online Notes & Important Points</li>
        <li>Ultimate Portal Access</li>
        <li>CCC Whole Syllabus Covered</li>
        <li class="o-level-cut">This plan does not include registration, Exam Form Submission, Project, any kind of Certificate</li>
      </ul>
    </div>

    <div class="o-level-card o-level-best">
      <div class="o-level-plan-title">Advanced Access</div>
      <div class="o-level-plan-subtitle">O Level</div>
      <button class="o-level-btn" onclick="window.location.href='enroll.php?plan=Advanced Access&price=17000'">Enroll Now</button>
      <div class="o-level-price">₹17,000</div>
      <ul class="o-level-features">
        <li>Access to all Subject Video Lectures</li>
        <li>150+ Mock Test</li>
        <li>Live-Session</li>
        <li>Online Notes & Important Points</li>
        <li>Ultimate Portal Access</li>
        <li>Registration</li>
        <li>Exam Form Submission</li>
        <li>Project</li>
        <li>Certificate Included (if Pass)</li>
        <li>CCC Whole Syllabus Covered</li>
        <li><b>Scholarship upto ₹12000</b></li>
      </ul>
    </div>

    <div class="o-level-card">
      <div class="o-level-plan-title">Customizable Access</div>
      <div class="o-level-plan-subtitle">Price Varies According to Your Customisation</div>
      <button class="o-level-btn" onclick="location.href='custom_enroll.php'">Enroll Now</button>
      <div class="o-level-price">₹1500-₹17,000</div>
      <ul class="o-level-features">
        <li>Custom course</li>
        <li>Dedicated Videos</li>
        <li>Live Sessions</li>
        <li>Strategic and Consulting sessions bi-weekly</li>
        <li>Payment plan based on milestones</li>
      </ul>
    </div>
  </div>

<header class="single">
  <h1>Premium Learning Courses</h1>
  <p>Enroll securely through Razorpay</p>
</header>

<div class="course-grid">
<?php while($c = $courses->fetch_assoc()): 
    $clean_price = (float)preg_replace('/[^0-9.]/', '', $c['price']);
?>
  <div class="course-card">
    <img src="<?= htmlspecialchars($c['image'] ?: 'https://via.placeholder.com/400x200/1e40af/ffffff?text=Course+Image') ?>" alt="Course" class="course-image">
    <div class="course-body">
      <h3 class="course-title"><?= htmlspecialchars($c['name']) ?></h3>
      <p class="course-description"><?= htmlspecialchars(substr($c['description'],0,60)) ?>...</p>
      <div class="course-price">₹<?= number_format($clean_price, 0) ?></div>
      <button class="enroll-btn" onclick='openForm(<?= json_encode($c["name"]) ?>, <?= json_encode($clean_price) ?>)'>Enroll Now</button>
    </div>
  </div>
<?php endwhile; ?>
</div>

<!-- Enrollment Modal -->
<div class="modal-overlay" id="enrollModal">
  <div class="modal-container">
    <span class="close-btn" onclick="closeForm()">&times;</span>
    <h2>Enroll in <span id="courseTitle"></span></h2>
    <form id="enrollForm" onsubmit="startPayment(event)">
      <input type="hidden" name="plan_name" id="planInput">
      <input type="hidden" name="price_val" id="priceInput">
      <label>Full Name</label>
      <input type="text" name="name" required>
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Phone (This will be your password)</label>
      <input type="text" name="phone" required pattern="[0-9]{10}" title="10 digit mobile number">
      <label>Address</label>
      <textarea name="address" required></textarea>
      <button type="submit" class="enroll-btn" style="width:100%;">Proceed to Pay</button>
    </form>
  </div>
</div>

<!-- Loader -->
<div class="modal-overlay" id="loadingModal">
  <div class="modal-container" style="text-align:center;">
    <div class="loader" id="loaderText">Processing your enrollment...</div>
  </div>
</div>

<script>
function openForm(course, price){
  const numPrice = parseFloat(price);
  if (isNaN(numPrice) || numPrice <= 0) {
    alert("Invalid course price!");
    return;
  }
  document.getElementById('courseTitle').textContent = course;
  document.getElementById('planInput').value = course;
  document.getElementById('priceInput').value = numPrice;
  document.getElementById('enrollModal').style.display = 'flex';
}

function closeForm(){
  document.getElementById('enrollModal').style.display = 'none';
}

function startPayment(e){
  e.preventDefault();
  const form = e.target;
  const data = Object.fromEntries(new FormData(form).entries());
  
  const price = parseFloat(data.price_val);
  if (isNaN(price) || price <= 0) {
    alert("Invalid price amount!");
    return;
  }

  const options = {
    key: "rzp_test_Rc7TynjHcNrEfB", // 🔑 Replace with your live Razorpay key
    amount: Math.round(price * 100),
    currency: "INR",
    name: "Pyaara Store",
    description: data.plan_name,
    handler: function (){
      // Show loading
      document.getElementById('enrollModal').style.display = 'none';
      document.getElementById('loadingModal').style.display = 'flex';
      document.getElementById('loaderText').style.display = 'block';

      fetch("", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: new URLSearchParams({...data, payment_confirmed: 1})
      })
      .then(res => res.text())
      .then(res => {
        const parts = res.trim().split("|");
        if (parts[0] === "success" && parts[1]) {
          const cid = parts[1];
          window.location.href = "thankyou.php?cid=" + encodeURIComponent(cid);
        } else {
          alert("Enrollment failed. Please contact support.\nResponse: " + res);
          document.getElementById('loadingModal').style.display = 'none';
        }
      })
      .catch(err => {
        console.error(err);
        alert("Network error. Try again.");
        document.getElementById('loadingModal').style.display = 'none';
      });
    },
    prefill: {
      name: data.name,
      email: data.email,
      contact: data.phone
    },
    theme: { color: "#1e40af" }
  };

  const rzp = new Razorpay(options);
  rzp.open();
}

window.onclick = function(e) {
  const enrollModal = document.getElementById('enrollModal');
  if (e.target === enrollModal) enrollModal.style.display = 'none';
}
</script>



    <script src="olevel.js"></script>
    