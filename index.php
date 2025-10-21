<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.42">
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
            <a href='a.html' style='text-decoration:none;'> <div class='courses-section-header'>{$title} <span>→</span></div></a>
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
<div class="career">
  <div class="career-section">
    <h2>What would you like to learn today?</h2>
    <div class="career-options">
      <button class="option">
        <span class="icon"><img width="30" height="30" src="https://img.icons8.com/external-outline-lafs/64/external-grow-distance-education-outline-part-4-outline-lafs.png" alt="external-grow-distance-education-outline-part-4-outline-lafs"/></span>
        <a href="" style="text-decoration: none;color:black;"><span>Grow your skills</span></a>
      </button>
      <button class="option">
        <span class="icon"><img width="30" height="30" src="https://img.icons8.com/ink/48/learning.png" alt="learning"/></span>
        <a href="" style="text-decoration: none;color:black;"><span>Learn something new</span></a>
      </button>
      <button class="option">
        <span class="icon"><img width="30" height="30" src="https://img.icons8.com/external-outline-geotatah/64/external-development-just-in-time-outline-geotatah.png" alt="external-development-just-in-time-outline-geotatah"/></span>
        <a href="" style="text-decoration: none;color:black;"><span>Improve your knowledge</span></a>
      </button>
      <button class="option">
        <span class="icon"><img width="30" height="30" src="https://img.icons8.com/ios/50/hard-to-find.png" alt="hard-to-find"/></span>
        <a href="ggfg.html" style="text-decoration: none;color:black;"><span>Explore Our Courses</span></a>
      </button>
    </div>
  </div>
  </div>
  
<div class="course-2-section-container" id="course2Carousel">
<?php
function showSection2($title, $section, $conn) {
    echo "<div class='course-2-section'>
             <a href='a.html' style='text-decoration:none;'> <div class='course-2-header'>{$title} <span>→</span></div></a>
            <div class='course-2-courses-container'>";
    $courses = $conn->query("SELECT * FROM courses WHERE home_section2='$section' ORDER BY id DESC LIMIT 4");
    if($courses->num_rows == 0){
        echo "<div class='course-2-empty-message'>No courses added yet...</div>";
    } else {
        while($c=$courses->fetch_assoc()){
            $image = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/80';
            $rating = 4.8;
            echo "
            <a class='course-2-course-pill' href='course_detail.php?id={$c['id']}'>
                <img src='{$image}' alt='{$c['course_name']}'>
                <div class='course-2-course-info'>
                    <span class='course-2-provider'>{$c['company']}</span>
                    <h3>{$c['course_name']}</h3>
                    <div class='course-2-meta'>Professional Certificate </div>
                </div>
            </a>";
        }
    }
    echo "</div></div>";
}

showSection2("Popular In Data","popular",$conn);
showSection2("Skill Development","skills",$conn);
showSection2("Free Courses","free",$conn);
?>
</div>

<div class="course-2-indicators" id="course2Indicators">
    <div class="course-2-indicator active" data-index="0"></div>
    <div class="course-2-indicator" data-index="1"></div>
    <div class="course-2-indicator" data-index="2"></div>
</div>
  <a href="" style="text-decoration: none;"><div id="university-section">
    <div class="wrapper">
        <div class="university-logos">
            <div class="university-logo">
                <img src="images/integral.avif" alt="">
            </div>
            <div class="university-logo">
                <img src="images/manglayatan.jpg" alt="">
            </div>
            <div class="university-logo">
                <img src="images/parul.jpg" alt="">
            </div>
            <div class="university-logo">
                <img src="images/srisharda.png" alt="">
            </div>
            <div class="university-logo">
                <img src="images/bosse.png" alt="">
            </div>
            <div class="university-logo">
                <img src="images/rgcsm.png" alt="">
            </div>
        </div>

        <div class="university-text">
          <h2 style="text-align:center;">Join colleges and universities that choose <span class="highlight">Faiz Computer Institute for Campus</span></h2></a>
        </div>
    </div>
</div>

<h2 class="testimonial">Why people choose <span style="color:rgb(0, 0, 163)"> Faiz Computer Institute</span></h2>

<div class="testimonial-container" id="scrollArea">
    <div class="testimonial-card">
        <div class="profile">
            <img src="https://i.pravatar.cc/100?img=1" alt="Sarah">
            <h3>Sarah W.</h3>
        </div>
        <p class="testimonial-text">
            "Coursera's reputation for high-quality content, paired with its flexible structure, made it possible for me to dive into data analytics while managing family, health, and everyday life."
        </p>
    </div>

    <div class="testimonial-card">
        <div class="profile">
            <img src="https://i.pravatar.cc/100?img=2" alt="Noeris">
            <h3>Noeris B.</h3>
        </div>
        <p class="testimonial-text">
            "Coursera rebuilt my confidence and showed me I could dream bigger. It wasn't just about gaining knowledge—it was about believing in my potential again."
        </p>
    </div>

    <div class="testimonial-card">
        <div class="profile">
            <img src="https://i.pravatar.cc/100?img=3" alt="Abdullahi">
            <h3>Abdullahi M.</h3>
        </div>
        <p class="testimonial-text">
            "I now feel more prepared to take on leadership roles and have already started mentoring some of my colleagues."
        </p>
    </div>

    <div class="testimonial-card">
        <div class="profile">
            <img src="https://i.pravatar.cc/100?img=4" alt="Anas">
            <h3>Anas A.</h3>
        </div>
        <p class="testimonial-text">
            "Learning with Coursera has expanded my professional expertise by giving me access to cutting-edge research, practical tools, and global perspectives."
        </p>
    </div>
</div>
  <!-- CTA Section -->
  <section class="bg-blue-600 text-white py-12 mt-1">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <h2 class="text-xl sm:text-2xl font-bold mb-4">Ready to Transform Your Career?</h2>
      <p class="text-sm sm:text-base mb-6 max-w-2xl mx-auto">Join thousands of students who've accelerated their careers with our intensive bootcamp programs.</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
      <a href="https://www.faizcomputerinstitute.com/faizcontact.html">
        <button class="border border-white text-white rounded-lg px-6 py-2.5 text-sm hover:bg-blue-700 transition font-medium">
          Speak to an Advisor
        </button></a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-50 text-gray-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
      <div class="space-y-4">
        <a href="#" class="text-blue-700 font-extrabold text-2xl select-none hover:text-blue-800 transition block">Faiz Computer Institute.</a>
        <p class="text-xs text-gray-500">Empowering careers through immersive education since 2002.</p>
        
        <div class="flex items-center space-x-4 pt-2">
          <a href="#" aria-label="Facebook" class="text-gray-500 hover:text-blue-600 transition">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" aria-label="Twitter" class="text-gray-500 hover:text-blue-400 transition">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" aria-label="Instagram" class="text-gray-500 hover:text-pink-600 transition">
            <i class="fab fa-instagram"></i>
          </a>
          
        </div>
      </div>
      
      <div>
        <h5 class="font-semibold text-gray-800 text-sm mb-4">Company</h5>
        <ul class="space-y-2 text-xs">
          <li><a class="hover:text-blue-600 transition" href="#">About Us</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">Blog</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">Affiliates</a></li>
        </ul>
      </div>
      
      <div>
        <h5 class="font-semibold text-gray-800 text-sm mb-4">Resources</h5>
        <ul class="space-y-2 text-xs">
          <li><a class="hover:text-blue-600 transition" href="#">Help Center</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">Scholarships</a></li>
          
        </ul>
      </div>
      
      <div>
        <h5 class="font-semibold text-gray-800 text-sm mb-4">Support</h5>
        <ul class="space-y-2 text-xs">
          <li><a class="hover:text-blue-600 transition" href="#">Contact Us</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">FAQ</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">Privacy Policy</a></li>
          <li><a class="hover:text-blue-600 transition" href="#">Terms of Service</a></li>
        </ul>
      </div>
      
      <div>
        <h5 class="font-semibold text-gray-800 text-sm mb-4">Contact</h5>
        <ul class="space-y-3 text-xs">
          <li class="flex items-start">
            <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-3"></i>
            <span>Charan Plaza, Infront Of Masjid, Telibagh, Lucknow</span>
          </li>
          <li class="flex items-center">
            <i class="fas fa-phone-alt text-blue-600 mr-3"></i>
            <a class="hover:text-blue-600 transition" href="tel:+919721896891">+91 9721896891</a>
            <a class="hover:text-blue-600 transition" href="tel:+917007862136">+91 7007862136</a>
          </li>
          <li class="flex items-center">
            <i class="fas fa-envelope text-blue-600 mr-3"></i>
            <a class="hover:text-blue-600 transition" href="mailto:hello@upskill.com">Faizcomputerinstitutes@gmail.com</a>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-gray-200 py-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
      <div class="mb-3 md:mb-0">
        &copy; 2025 Faiz Computer Institute. All rights reserved.
      </div>
      <div class="flex space-x-4">
        <a href="#" class="hover:text-blue-600 transition">Privacy Policy</a>
        <a href="#" class="hover:text-blue-600 transition">Terms of Service</a>
        
      </div>
    </div>
  </footer>

       <script src="script.js"></script>
</body>
</html>