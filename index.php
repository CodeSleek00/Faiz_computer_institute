<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Faiz Computer Institute</title>
   <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
    }
body {
   
    margin: 0;
    padding: 0;
}
.head {
    background-color: #000000;
    padding: 1px 0; /* thinner strip */
}
.head1 {
    list-style: none;
    display: flex;
    justify-content: left;
    gap: 30px;
    margin: 0;
    padding: 6px 20px; }
.head1 a {
    text-decoration: none;
    color: white;
    font-size: smaller;
    font-weight: normal;
}
.head1 a:hover {
    color: black;
    background-color: white;
    transition: 0.3s ease-in-out;
    padding: 5px 10px;
    border-radius: 5px;
}
@media (max-width: 480px) {
    .head{
        display: none;
    }
    
}

        nav {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 5%;
            position: relative;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-left {
            font-size: 22px;
            font-weight: 700;
            color: #0406ae;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-left i {
            color: #0c0058;
        }

        .nav-center {
            position: relative;
        }

        .nav-center button {
            background: none;
            border: none;
            color: rgb(0, 0, 0);
            font-size: 16px;
            cursor: pointer;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .nav-center button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            color: #000;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            padding: 25px;
            border-radius: 12px;
            width: 90vw;
            max-width: 1000px;
            z-index: 100;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            border-top: 4px solid #0033ff;
        }

        .dropdown-column h4 {
            margin-bottom: 15px;
            font-size: 16px;
            color: #1a1a2e;
            border-bottom: 2px solid #c9d0ff;
            display: inline-block;
            padding-bottom: 5px;
        }

        .dropdown-column a {
            display: block;
            text-decoration: none;
            color: #555;
            font-size: 14px;
            margin: 8px 0;
            transition: 0.2s;
            padding: 4px 0;
        }

        .dropdown-column a:hover {
            color: #2563eb;
            transform: translateX(5px);
        }

        .nav-center:hover .dropdown {
            display: grid;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-buttons {
            display: flex;
            gap: 12px;
        }

        .login-btn, .signup-btn {
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
        }

        .login-btn {
            background: transparent;
            border: 1px solid white;
            color: #0026ff;
            font-weight: normal;
        }

        .login-btn:hover {
            background-color:rgb(0, 0, 148);
            color: white;
            transition: 0.3s ease-in-out;
        }

        .signup-btn {
            background-color: white;
            border: 1px solid #0004ff;
            color: #1a1a2e;
            font-weight: normal;
        }

        .signup-btn:hover {
            background-color: #000d84;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
        }

        .free-courses:hover {
            background-color: rgba(255, 215, 0, 0.1);
        }

        /* Mobile Toggle Button */
        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: rgb(0, 0, 0);
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .mobile-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Left Side Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            left: -70%;
            width: 70%;
            height: 100vh;
            background: linear-gradient(to bottom, #ffffff, #f0f8ff);
            z-index: 1000;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            overflow-y: auto;
            padding: 20px 0;
        }

        .mobile-menu.active {
            left: 0;
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 10px;
        }

        .mobile-menu-header .logo {
            font-size: 20px;
            font-weight: 700;
            color: #1a1a2e;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mobile-menu-header .logo i {
            color: #2563eb;
        }

        .mobile-close {
            background: none;
            border: none;
            font-size: 22px;
            color: #64748b;
            cursor: pointer;
            transition: color 0.3s;
        }

        .mobile-close:hover {
            color: #2563eb;
        }

        .mobile-menu-item {
            border-bottom: 1px solid #e2e8f0;
        }

        .mobile-menu-header-item {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: 500;
            color: #1a1a2e;
            transition: background-color 0.2s;
        }

        .mobile-menu-header-item:hover {
            background-color: #f1f5f9;
        }

        .mobile-menu-header-item i {
            transition: transform 0.3s;
            color: #64748b;
        }

        .mobile-menu-header-item.active i {
            transform: rotate(180deg);
            color: #2563eb;
        }

        .mobile-dropdown {
            background-color: #f8fafc;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }

        .mobile-dropdown.active {
            max-height: 500px;
        }

        .mobile-dropdown a {
            display: block;
            padding: 12px 35px;
            color: #475569;
            text-decoration: none;
            border-bottom: 1px solid #e2e8f0;
            transition: all 0.2s;
            font-size: 14px;
        }

        .mobile-dropdown a:hover {
            background-color: #e0f2fe;
            color: #2563eb;
            padding-left: 40px;
        }

        .mobile-dropdown a i {
            margin-right: 10px;
            width: 18px;
            text-align: center;
            color: #64748b;
        }

        .mobile-auth {
            display: flex;
            padding: 20px;
            gap: 10px;
            border-bottom: 1px solid #e2e8f0;
        }

        .mobile-auth button {
            flex: 1;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 14px;
            border: none;
        }

        .mobile-login {
            background: transparent;
            border: 1px solid #2563eb !important;
            color: #2563eb;
        }

        .mobile-login:hover {
            background-color: #dbeafe;
        }

        .mobile-signup {
            background-color: #2563eb;
            color: white;
        }

        .mobile-signup:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(37, 99, 235, 0.3);
        }

        .mobile-free {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #2563eb;
            font-weight: 600;
            padding: 15px 20px;
            cursor: pointer;
            transition: background-color 0.2s;
            border-bottom: 1px solid #e2e8f0;
        }

        .mobile-free:hover {
            background-color: #f1f5f9;
        }

        .mobile-free i {
            font-size: 18px;
        }

        /* Overlay when mobile menu is open */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        /* ---- Responsive ---- */
        @media (max-width: 1024px) {
            nav {
                padding: 12px 3%;
            }
            
            .dropdown {
                width: 95vw;
                gap: 20px;
                padding: 20px;
            }
        }

        @media (max-width: 768px) {
            .mobile-toggle {
                display: block;
            }
            
            .nav-center, .nav-right {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .dropdown {
                grid-template-columns: 1fr;
            }
            
            .mobile-auth {
                flex-direction: column;
            }
        }
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
          <img src="https://cdn.pixabay.com/photo/2023/03/28/05/45/ai-7883259_1280.jpg" alt="AI Learning">
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
          <img src="https://cdn.pixabay.com/photo/2020/08/28/10/56/artificial-intelligence-5527864_1280.jpg" alt="Business Growth">
        </div>
      </div>

      <!-- Card 3 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2>10th & 12th Education Made Easy – BOSSE & NIOS Boards.</h2>
            <p>Study at your own pace and earn a valid 10th or 12th certificate with BOSSE and NIOS, India’s most trusted open schooling boards.</p>
          </div>
          <button>Start Learning →</button>
        </div>
        <div class="card-image">
          <img src="https://cdn.pixabay.com/photo/2021/08/04/13/06/software-developer-6521720_1280.jpg" alt="Upskilling">
        </div>
      </div>
      
      <!-- Card 4 -->
      <div class="card">
        <div class="card-content">
          <div>
            <h2 style="color:white">Free Career-Building Courses Powered by EduBridge India</h2>
            <p style="color: whitesmoke;">Take the first step toward your dream career with EduBridge India’s free learning programs.</p>
          </div>
          <button style="background-color: white;color:black;">View Courses →</button>
        </div>
        <div class="card-image">
          <img src="https://cdn.pixabay.com/photo/2018/05/08/08/44/artificial-intelligence-3382507_1280.jpg" alt="Data Science">
        </div>
      </div>

    </div>
    <button class="nav-btn next">&#10095;</button>
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
        const carousel = document.getElementById("carousel");
    const next = document.querySelector(".next");
    const prev = document.querySelector(".prev");
    
    // Calculate scroll amount based on card width
    const scrollAmount = () => {
      const card = document.querySelector('.card');
      const cardWidth = card.offsetWidth;
      return cardWidth + 20; // 20px is the gap
    };

    next.addEventListener("click", () => {
      carousel.scrollBy({ left: scrollAmount(), behavior: "smooth" });
    });
    
    prev.addEventListener("click", () => {
      carousel.scrollBy({ left: -scrollAmount(), behavior: "smooth" });
    });
        </script>
</body>
</html>