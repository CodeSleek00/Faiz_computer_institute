<?php
include '../db/db_connect.php';

function showCourseSection($conn, $category, $limit = 4) {
    $courses = $conn->query("SELECT * FROM university_courses WHERE category='$category' LIMIT $limit");
    ?>
    <div class="courses-university-section">
        <div class="courses-university-header">
            <h2><?= htmlspecialchars($category) ?></h2>
            <button class="courses-university-show-more-btn" onclick="window.location.href='courses.php?category=<?= urlencode($category) ?>'">Show More</button>
        </div>

        <div class="courses-university-carousel">
            <?php while($c = $courses->fetch_assoc()):
                $imagePath = !empty($c['image']) && file_exists("../uploads/".$c['image']) 
                    ? "../uploads/".$c['image'] 
                    : "../uploads/default.jpg";
            ?>
            <div class="courses-university-card">
                <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($c['course_name']) ?>">
                <div class="courses-university-content">
                    <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                    <p><?= substr($c['description'], 0, 80) ?>...</p>
                    <p class="courses-university-duration"><strong>Duration:</strong> <?= $c['duration'] ?></p>
                    <a href="view.php?id=<?= $c['id'] ?>" class="courses-university-view-link">View Details →</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="university.css?v=12">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
   
    <title>Faiz Computer Institute</title>

 
</head>
<body>
    <div id="preloader">
    <h1>
    Faiz Computer Institute
        <br>University Courses
    </h1>
    <div class="loader-circle"></div>
  </div>
    <header>
        <div class="head">
            <ul class="head1">
                <a href="../index.php"><li>For Individual</li></a>
                <a href="#"><li>For University Courses</li></a>
                <a href="../schooling/school.html"><li>For High School & Intermediate Courses</li></a>
                <a href="../free/free.html"><li>For Free Courses</li></a>
            </ul>
        </div>
    </header>
     <nav>
        <div class="nav-left">
           
           <a href="../index.php" style="text-decoration: none;"> Faiz Computer Institute</a>
        </div>
 <div class="nav-center">
            <button id="exploreBtn">
                Explore <i class="fas fa-chevron-down"></i>
            </button>
            <div class="dropdown" id="dropdownMenu">
                <div class="dropdown-column">
                    <h4>Explore </h4>
                    <a href="../index.php"><i class="fa fa-user" aria-hidden="true"></i> Individual </a>
                   <a href="university.php"><i class="fa fa-university" aria-hidden="true"></i> University</a>
                    <a href="../schooling/school.html"><i class="fa-solid fa-school"></i> Schooling</a>
                    <a href="../free/free.html"><i class="fa-solid fa-wallet"></i> Free</a>
                    <a href="">Login <i class="fa-solid fa-arrow-right"></i></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>Online Degree</h4>
                    <a href="view.php?id=18"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="view.php?id=25"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="view.php?id=19"><i class="fas fa-book"></i> BBA</a>
                    <a href="view.php?id=21"><i class="fas fa-briefcase"></i> MBA</a>
                    <a href="university.php">More <i class="fa-solid fa-arrow-right"></i></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>Trending Courses</h4>
                    <a href="../course_detail.php?id=1"><i class="fab fa-python"></i> DOAP</a>
                    <a href="../course_detail.php?id=7"><i class="fas fa-palette"></i> O Level</a>
                    <a href="../course_detail.php?id=3"><i class="fas fa-calculator"></i> Tally</a>
                    <a href="../course_detail.php?id=9"><i class="fas fa-bullhorn"></i> Advance Excel</a>
                    <a href="../all_course.php">More Courses <i class="fa-solid fa-arrow-right"></i></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>About Us</h4>
                    <a href="#"><i class="fas fa-layer-group"></i>Contact Us</a>
                <a href="#"><i class="fas fa-table"></i> Gallery</a>
                <a href="#"><i class="fas fa-network-wired"></i> Brochure</a>
                <a href="#"><i class="fas fa-user-secret"></i>  Enquiry</a>
                <a href="university/university.php">More <i class="fa-solid fa-arrow-right"></i></i></a>
                </div>
            </div>
        </div>

        <div class="nav-right">
            <div class="auth-buttons">
                <a href="https://faizcomputerinstitute.in/login-system/login.php"><button class="login-btn">Login</button></a>
              <a href="free/free.html" style="text-decoration: none;">  <button class="signup-btn">Free Courses</button></a>
              <a href="o-level/index.php" style="text-decoration: none;">  <button class="signup-btn">O Level/CCC</button></a>
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
                <a href="../index.php"><i class="fa fa-user" aria-hidden="true"></i> Individual </a>
                   <a href="university.php"><i class="fa fa-university" aria-hidden="true"></i> University</a>
                    <a href="../schooling/school.html"><i class="fa-solid fa-school"></i> Schooling</a>
                    <a href="../free/free.html"><i class="fa-solid fa-wallet"></i> Free</a>
                    
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileDegree">
                <span>Online Degree</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileDegree">
               <a href="university/view.php?id=18"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="view.php?id=25"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="view.php?id=19"><i class="fas fa-book"></i> BBA</a>
                    <a href="view.php?id=21"><i class="fas fa-briefcase"></i> MBA</a>
                    <a href="university.php">More<i class="fa-solid fa-arrow-right"> </i></a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileTrending">
                <span>Trending Courses</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileTrending">
                <a href="course_detail.php?id=1"><i class="fab fa-python"></i> DOAP</a>
                    <a href="../course_detail.php?id=7"><i class="fas fa-palette"></i> O Level</a>
                    <a href="../course_detail.php?id=3"><i class="fas fa-calculator"></i> Tally</a>
                    <a href="../course_detail.php?id=9"><i class="fas fa-bullhorn"></i> Advance Excel</a>
                    <a href="../all_course.php">More Courses <i class="fa-solid fa-arrow-right"></i></i></a>
            </div>
        </div>
        
        <div class="mobile-menu-item">
            <div class="mobile-menu-header-item" data-target="mobileProfessional">
                <span>About Us</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="mobile-dropdown" id="mobileProfessional">
                <a href="#"><i class="fas fa-layer-group"></i>Contact Us</a>
                <a href="#"><i class="fas fa-table"></i> Gallery</a>
                <a href="#"><i class="fas fa-network-wired"></i> Brochure</a>
                <a href="#"><i class="fas fa-user-secret"></i>  Enquiry</a>
                <a href="university/university.php">More <i class="fa-solid fa-arrow-right"></i></i></a>
            </div>
        </div>
        
        <div class="mobile-auth">
            <button class="mobile-login">Login</button>
           
        </div>
        
        <div class="mobile-free">
            <i class="fas fa-gift"></i>
            <a href="../free/free.html">
            <span>Free Courses</span>
        </div></a>
         <div class="mobile-free">
            <i class="fas fa-graduation-cap"></i>
            <a href="o-level/index.php">
            <span>O Level/CCC</span>
        </div></a>
    </div>

  <!-- 🔹 Main Section -->
  <section class="courses-section">
    <div class="courses-left">
      <div class="main-img">
        <img src="https://images.pexels.com/photos/5905703/pexels-photo-5905703.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Student studying">
      </div>
      <div class="floating-img float1">
        <img src="https://images.pexels.com/photos/3762800/pexels-photo-3762800.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Smiling student with globe">
      </div>
      <div class="floating-img float2">
        <img src="https://images.pexels.com/photos/3184399/pexels-photo-3184399.jpeg?auto=compress&cs=tinysrgb&w=800" alt="Teacher portrait">
      </div>
    </div>

    <div class="courses-right">
      <h4>About Our Courses</h4>
      <h1>Empower Your Future with World-Class Education</h1>
      <p>Discover a wide range of undergraduate and postgraduate programs from arts and commerce to technology and management — build your dream future with expert faculty, modern infrastructure, and hands-on learning experiences.</p>
      <a href="courses.php" class="read-btn">Read More</a>
    </div>
  
  </section>  <hr><div class="cards">
<h1 class="university">Universitie's</h1>
  
<div class="card-container">

  <div class="card" style="background-color: #ffffff;">
    <div class="card-header">
      <span>Offline</span><span>Online</span>
      <div class="circle"></div>
      <h2>Integral University</h2>
      <p>SIntegral University is one of the Oldest Recognized Private university in Uttar Pradesh</p>
    </div>
    <img src="../images/image.png" alt="Couples">
    <a href="courses.php" style="text-decoration: none;color:black;"><button class="card-btn">View Courses</button></a> 
  </div>

  <div class="card" style="background-color: #ffffff;">
    <div class="card-header">
      <span>Offline</span><span>Online</span>
      <div class="circle"></div>
      <h2>Parul University</h2>
      <p>Parul University in Vadodara, Gujarat, is a leading private institution known for its modern education and research opportunities.</p>
    </div>
    <img src="../images/image copy.png" alt="Couples">
     <a href="courses.php" style="text-decoration: none;color:black;"><button class="card-btn">View Courses</button></a> 
  </div>

  <div class="card" style="background-color: #ffffff;">
    <div class="card-header">
<span>Offline</span><span>Online</span>
      <div class="circle"></div>
      <h2>Manglayatan University</h2>
      <p>Manglayatan University in Aligarh, Uttar Pradesh, is a private institution known for quality education development.</p>
    </div>
    <img src="../images/image copy 2.png" alt="Couples">
     <a href="courses.php" style="text-decoration: none;color:black;"><button class="card-btn">View Courses</button></a> 
  </div>

</div></div>

<div class="courses-university-container">
    <h1 class="courses-university-title">Explore Our Courses</h1>

    <?php 
    showCourseSection($conn, 'Graduation'); 
    ?>

    <div class="courses-university-path-container">
        <div class="courses-university-path-left">
            <h1>Unlock Endless Opportunities </h1>
            <p>with Quality Educations</p>
        </div>
        <div class="courses-university-path-right">
            <p>Join a learning journey that blends knowledge, innovation, and real-world experience. Explore our diverse range of programs — from technology to business and arts — and take the first step toward a successful and fulfilling career.</p>
            <a href="courses.php" style="text-decoration:none;color:black;"><button class="courses-university-path-btn">View Courses</button></a>
        </div>
    </div>

    <?php 
    showCourseSection($conn, 'Post Graduation'); 
    ?>
</div>

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
   <script src="university.js"></script>

