<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.9">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Faiz Computer Institute</title>
 
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
  <h2 class="chip">Learn from leading universities and companies</h2>

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
        <script>
             // Mobile menu toggle
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileClose = document.getElementById('mobileClose');
        const overlay = document.getElementById('overlay');
        
        function openMobileMenu() {
            mobileMenu.classList.add('active');
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
        
        function closeMobileMenu() {
            mobileMenu.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = 'auto';
            
            // Close all dropdowns when closing menu
            document.querySelectorAll('.mobile-dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            document.querySelectorAll('.mobile-menu-header-item').forEach(header => {
                header.classList.remove('active');
            });
        }
        
        mobileToggle.addEventListener('click', openMobileMenu);
        mobileClose.addEventListener('click', closeMobileMenu);
        overlay.addEventListener('click', closeMobileMenu);

        // Mobile dropdown functionality
        const mobileHeaders = document.querySelectorAll('.mobile-menu-header-item');
        
        mobileHeaders.forEach(header => {
            header.addEventListener('click', (e) => {
                e.stopPropagation();
                const targetId = header.getAttribute('data-target');
                const targetDropdown = document.getElementById(targetId);
                
                // Toggle current dropdown
                header.classList.toggle('active');
                targetDropdown.classList.toggle('active');
                
                // Close other dropdowns
                mobileHeaders.forEach(otherHeader => {
                    if (otherHeader !== header) {
                        otherHeader.classList.remove('active');
                        const otherTargetId = otherHeader.getAttribute('data-target');
                        const otherTargetDropdown = document.getElementById(otherTargetId);
                        otherTargetDropdown.classList.remove('active');
                    }
                });
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.mobile-menu-header-item')) {
                mobileHeaders.forEach(header => {
                    header.classList.remove('active');
                    const targetId = header.getAttribute('data-target');
                    const targetDropdown = document.getElementById(targetId);
                    targetDropdown.classList.remove('active');
                });
            }
        });

        // Prevent clicks inside mobile menu from closing it
        mobileMenu.addEventListener('click', (e) => {
            e.stopPropagation();
        });
        
        // Carousel functionality
        const carousel = document.getElementById("carousel");
        const next = document.querySelector(".next");
        const prev = document.querySelector(".prev");
        const indicators = document.querySelectorAll('.indicator');
        
        // Calculate scroll amount based on card width
        const scrollAmount = () => {
          const card = document.querySelector('.card');
          const cardWidth = card.offsetWidth;
          return cardWidth + 20; // 20px is the gap
        };

        // Update indicators based on scroll position
        function updateIndicators() {
          const scrollPos = carousel.scrollLeft;
          const cardWidth = document.querySelector('.card').offsetWidth + 20;
          const activeIndex = Math.round(scrollPos / cardWidth);
          
          indicators.forEach((indicator, index) => {
            if (index === activeIndex) {
              indicator.classList.add('active');
            } else {
              indicator.classList.remove('active');
            }
          });
        }

        // Scroll to specific card
        function scrollToCard(index) {
          const cardWidth = document.querySelector('.card').offsetWidth + 20;
          carousel.scrollTo({
            left: index * cardWidth,
            behavior: 'smooth'
          });
        }

        next.addEventListener("click", () => {
          carousel.scrollBy({ left: scrollAmount(), behavior: "smooth" });
        });
        
        prev.addEventListener("click", () => {
          carousel.scrollBy({ left: -scrollAmount(), behavior: "smooth" });
        });
        
        // Update indicators on scroll
        carousel.addEventListener('scroll', updateIndicators);
        
        // Add click events to indicators
        indicators.forEach(indicator => {
          indicator.addEventListener('click', () => {
            const index = parseInt(indicator.getAttribute('data-index'));
            scrollToCard(index);
          });
        });
        document.addEventListener('DOMContentLoaded', function() {
      const logoStrip = document.getElementById('logoStrip');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');
      
      // Navigation functionality
      prevBtn.addEventListener('click', () => {
        logoStrip.scrollBy({
          left: -300,
          behavior: 'smooth'
        });
      });
      
      nextBtn.addEventListener('click', () => {
        logoStrip.scrollBy({
          left: 300,
          behavior: 'smooth'
        });
      });
      
      // Hide/show navigation buttons based on scroll position
      function updateNavButtons() {
        const scrollLeft = logoStrip.scrollLeft;
        const scrollWidth = logoStrip.scrollWidth;
        const clientWidth = logoStrip.clientWidth;
        
        prevBtn.style.display = scrollLeft > 10 ? 'flex' : 'none';
        nextBtn.style.display = scrollLeft < (scrollWidth - clientWidth - 10) ? 'flex' : 'none';
      }
      
      logoStrip.addEventListener('scroll', updateNavButtons);
      window.addEventListener('resize', updateNavButtons);
      updateNavButtons(); // Initial check
    });
        </script>
</body>
</html>