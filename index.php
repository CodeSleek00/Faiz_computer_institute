<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.17">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
   
    <title>Faiz Computer Institute</title>
   <style>
   
</style>
 
</head>
<body>
    <header>
        <div class="head">
            <ul class="head1">
                <a href=""><li>For Individual</li></a>
                <a href=""><li>For University Courses</li></a>
                <a href=""><li>For High School & Intermediate Courses</li></a>
                <a href=""><li>For Free Courses</li></a>
            </ul>
        </div>
    </header>
     <nav>
        <div class="nav-left">
           
            Faiz Computer Institute
        </div>

        <div class="nav-center">
            <button id="exploreBtn">
                Explore <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown" id="dropdownMenu">
                <div class="dropdown-column">
                    <h4>Explore Roles</h4>
                    <a href="#"><i class="fas fa-code"></i> Software Developer</a>
                    <a href="#"><i class="fas fa-paint-brush"></i> Web Designer</a>
                    <a href="#"><i class="fas fa-chart-bar"></i> Data Analyst</a>
                    <a href="#"><i class="fas fa-shield-alt"></i> Cyber Security</a>
                </div>
                <div class="dropdown-column">
                    <h4>Online Degree</h4>
                    <a href="#"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="#"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="#"><i class="fas fa-book"></i> BBA</a>
                    <a href="#"><i class="fas fa-briefcase"></i> MBA</a>
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
                <button class="signup-btn">Free Courses</button>
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
                <span>Explore Roles</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileRoles">
                <a href="#"><i class="fas fa-code"></i> Software Developer</a>
                <a href="#"><i class="fas fa-paint-brush"></i> Web Designer</a>
                <a href="#"><i class="fas fa-chart-bar"></i> Data Analyst</a>
                <a href="#"><i class="fas fa-shield-alt"></i> Cyber Security</a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileDegree">
                <span>Online Degree</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileDegree">
                <a href="#"><i class="fas fa-graduation-cap"></i> BCA</a>
                <a href="#"><i class="fas fa-user-graduate"></i> MCA</a>
                <a href="#"><i class="fas fa-book"></i> BBA</a>
                <a href="#"><i class="fas fa-briefcase"></i> MBA</a>
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
            <span>Free Courses</span>
        </div>
    </div>

  <div class="carousel-wrapper">
    <button class="nav-btn prev">&#10094;</button>
    <div class="carousel-container" id="carousel">

      <!-- Card 1 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2>Join Our Signature Course to enhance your career</h2>
            <p>Boost your career with our Signature Course — where learning meets success.
                Upgrade your skills, elevate your opportunities.</p>
          </div>
          <button>Explore programs →</button>
        </div>
        <div class="card-image">
          <img src="images/2.png" alt="AI Learning">
        </div>
      </div>

      <!-- Card 2 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2 style="color: white;">Enroll in Top University Programs – Integral, Parul & Mangalayatan</h2>
            <p style="color: white;">Choose from top-rated degree courses like BA, MA, BBA, MBA, BCA, and MCA. </p>
          </div>
          <button>Try University Program →</button>
        </div>
        <div class="card-image">
          <img src="images/1.png" alt="Business Growth">
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2>10th & 12th Education Made Easy – BOSSE & NIOS Boards.</h2>
            <p>Study at your own pace and earn a valid 10th or 12th certificate with BOSSE and NIOS, India's most trusted open schooling boards.</p>
          </div>
          <button>Start Learning →</button>
        </div>
        <div class="card-image">
          <img src="images/3.png" alt="Upskilling">
        </div>
      </div>
      
      <!-- Card 4 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2 style="color:white">Free Career-Building Courses Powered by EduBridge India</h2>
            <p style="color: whitesmoke;">Take the first step toward your dream career with EduBridge India's free learning programs.</p>
          </div>
          <button style="background-color: white;color:black;">View Courses →</button>
        </div>
        <div class="card-image">
          <img src="images/4.png" alt="Data Science">
        </div>
      </div>

    </div>
    <button class="nav-btn next">&#10095;</button>
    <div class="carousel-indicators" id="indicators">
      <div class="indicator active" data-index="0"></div>
      <div class="indicator" data-index="1"></div>
      <div class="indicator" data-index="2"></div>
      <div class="indicator" data-index="3"></div>
    </div>
  </div>
<div class="container-chip">
  <h2 class="chip">Learn from leading universities</h2>

  <div class="logo-strip-container">
    <div class="logo-strip" id="logoStrip">
      <a href="https://example.com/rgcsm" class="logo-box" target="_blank">
        <img src="images/rgcsm.png" alt="RGCSM">
        <span>RGCSM</span>
      </a>
      <a href="https://example.com/bosse" class="logo-box" target="_blank">
        <img src="images/bosse.png" alt="BOSSE">
        <span>BOSSE</span>
      </a>
      <a href="https://paruluniversity.ac.in/" class="logo-box" target="_blank">
        <img src="images/parul.jpg" alt="Parul University">
        <span>Parul University</span>
      </a>
      <a href="https://example.com/integral" class="logo-box" target="_blank">
        <img src="images/integral.avif" alt="Integral">
       
      </a>
      <a href="https://example.com/manglayatan" class="logo-box" target="_blank">
        <img src="images/manglayatan.jpg" alt="Manglayatan University">
        <span>Manglayatan University</span>
      </a>
      <a href="https://example.com/edubridge" class="logo-box" target="_blank">
        <img src="images/edubrige.avif" alt="EduBridge">
       
      </a>
      <a href="https://example.com/codesleek" class="logo-box" target="_blank">
        <img src="images/Codesleekstudios.png" alt="Code Sleek Studios">
        <span>Code Sleek Studios</span>
      </a>
     
    </div>
    
    <button class="nav-btn prev" id="prevBtn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="15 18 9 12 15 6"></polyline>
      </svg>
    </button>
    <button class="nav-btn next" id="nextBtn">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="9 18 15 12 9 6"></polyline>
      </svg>
    </button>
  </div>
</div>

<?php
function showSection($title, $section, $conn) {
    echo "<div class='courses-section-item'>
            <div class='courses-section-header'>{$title} <span>→</span></div>
            <div class='courses-section-container'>";
    
    $courses = $conn->query("SELECT * FROM courses WHERE home_section='$section' ORDER BY id DESC LIMIT 4");
    if($courses->num_rows == 0){
        echo "<div class='courses-section-empty'>No courses added yet...</div>";
    } else {
        while($c = $courses->fetch_assoc()) {
            $image = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/80';
            echo "
            <a class='courses-section-pill' href='course_detail.php?id={$c['id']}'>
                <img src='{$image}' alt='{$c['course_name']}'>
                <div class='courses-section-info'>
                    <span class='provider'>{$c['company']}</span>
                    <h3>{$c['course_name']}</h3>
                    <div class='meta'>Professional Certificate ·</div>
                </div>
            </a>";
        }
    }
    echo "</div></div>";
}
?>

<div class="courses-section" id="coursesSectionCarousel">
    <?php
    showSection("Popular Courses", "popular", $conn);
    showSection("Skill Development", "skills", $conn);
    showSection("More Courses", "free", $conn);

    ?>
</div>

<div class="courses-section-indicators" id="coursesSectionIndicators">
    <div class="courses-section-indicator active" data-index="0"></div>
    <div class="courses-section-indicator" data-index="1"></div>
    <div class="courses-section-indicator" data-index="2"></div>
</div>

<div class="o-level-online-container">
    <div class="o-level-online-carousel" id="o-level-online-carousel">
        <div class="o-level-online-card" style="background-color: #1328e4;">
            <div class="o-level-online-card-text">
                <h2>Start your O-Level preparation online today. </h2>
                <p>Join our comprehensive online O-Level preparation program designed to help you in your exams.</p>
               <a href="www,google.con"><button class="o-level-online-explore">Explore More</button></a>
            </div>
            <div class="o-level-online-card-image" style="background-image: url('images/Online\ acces.png');"></div>
        </div>

        <div class="o-level-online-card"  style="background-color: #00167a;">
            <div class="o-level-online-card-text">
                <h2>Start your CCC preparation online Today.</h2>
                  <p>Join our comprehensive online CCC preparation program designed to help you in your exams.</p>
                <a href="www,google.con"><button class="o-level-online-explore">Explore More</button></a>
            </div>
            <div class="o-level-online-card-image" style="background-image: url('images/O\ level.png');"></div>
        </div>
    </div>

    <div class="o-level-online-dots" id="o-level-online-dots"></div>
</div>

       <script src="script.js"></script>
</body>
</html>