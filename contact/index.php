<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.0">
    <title>Contact Us | Faiz Computer Institute</title>
</head>
<body>
      <div id="preloader">
    <h1>
    Faiz Computer Institute
        <br>Schooling Courses
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
            <a href="../o-level/index.php">
            <span>O Level/CCC</span>
        </div></a>
    </div>

</body>
</html>