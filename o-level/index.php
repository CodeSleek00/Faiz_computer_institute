<?php include '../db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="olevel.css?v=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
   
    <title>Faiz Computer Institute</title>
   <style>
   
</style>
 
</head>
<body>
   <div id="preloader">
    <h1>
    Faiz Computer Institute
        O Level
    </h1>
    <div class="loader-circle"></div>
  </div>
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
    <script src="olevel.js"></script>