<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=1.8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="images/logo.png">
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
    :root {
    --primary-bg: #f8fafc;
    --card-bg: #ffffff;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --border-color: rgba(15, 23, 42, 0.08);
    --shadow-light: 0 4px 12px rgba(0, 0, 0, 0.04);
    --shadow-hover: 0 8px 24px rgba(0, 0, 0, 0.08);
    --accent-color: #3b82f6;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }


  .container-chip {
    margin: 0;
    font-family: "Inter", sans-serif;
    background: var(--primary-bg);
    color: var(--text-primary);
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
  }

  .chip {
    font-size: 24px;
    font-weight: 600;
    margin-top: 20px;
    text-align: center;
    color: var(--text-primary);
  }

  /* Outer container */
  .logo-strip-container {
    position: relative;
    width: 100%;
    max-width: 1300px;
    overflow: hidden;
  }

  /* Shadow fade edges */
  .logo-strip-container::before,
  .logo-strip-container::after {
    content: "";
    position: absolute;
    top: 0;
    width: 80px;
    height: 100%;
    z-index: 2;
    pointer-events: none;
  }

  .logo-strip-container::before {
    left: 0;
    background: linear-gradient(to right, var(--primary-bg) 0%, transparent 100%);
  }

  .logo-strip-container::after {
    right: 0;
    background: linear-gradient(to left, var(--primary-bg) 0%, transparent 100%);
  }

  /* Scrollable row */
  .logo-strip {
    display: flex;
    gap: 24px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 16px 40px;
    scrollbar-width: none; /* Firefox */
  }
  .logo-strip::-webkit-scrollbar { display: none; } /* Chrome */

  /* Each logo box */
  .logo-box {
    flex: 0 0 auto;
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-light);
    border-radius: 16px;
    padding: 14px 22px;
    transition: var(--transition);
    text-decoration: none;
    color: inherit;
  }

  .logo-box:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
    border-color: rgba(59, 130, 246, 0.2);
  }

  .logo-box img {
    height: 32px;
    width: auto;
    object-fit: contain;
    border-radius: 6px;
    transition: var(--transition);
  }

  .logo-box:hover img {
    transform: scale(1.05);
  }

  .logo-box span {
    font-weight: 500;
    font-size: 15px;
    white-space: nowrap;
    color: var(--text-secondary);
    transition: var(--transition);
  }

  .logo-box:hover span {
    color: var(--accent-color);
  }

  /* Navigation buttons */
  .nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--card-bg);
    border: 1px solid var(--border-color);
    box-shadow: var(--shadow-light);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 3;
    transition: var(--transition);
    color: var(--text-secondary);
  }

  .nav-btn:hover {
    background: var(--accent-color);
    color: white;
    border-color: var(--accent-color);
  }

  .nav-btn.prev {
    left: 10px;
  }

  .nav-btn.next {
    right: 10px;
  }

  /* Responsive design */
  @media (max-width: 768px) {
   
    
    h2 {
      font-size: 20px;
    }
    
    .logo-strip {
      gap: 16px;
      padding: 12px 24px;
    }
    
    .logo-box {
      padding: 12px 18px;
      border-radius: 12px;
    }
    
    .logo-box img {
      height: 28px;
    }
    
    .nav-btn {
      display: none;
    }
  }

  @media (max-width: 480px) {
    
    .logo-box {
      padding: 10px 16px;
      gap: 10px;
    }
    
    .logo-box img {
      height: 24px;
    }
    
    .logo-box span {
      font-size: 14px;
    }
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

    .carousel-wrapper {
      position: relative;
      overflow: hidden;
      padding: 10px 10px;
      margin: 0 auto;
    }

    .carousel-container {
      display: flex;
      gap: 20px;
      overflow-x: auto;
      scroll-behavior: smooth;
      padding: 0 20px;
      scroll-snap-type: x mandatory;
    }

    .carousel-container::-webkit-scrollbar {
      display: none;
    }

    .card {
      flex: 0 0 calc(50% - 10px);
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      display: flex;
      padding: 25px;
      scroll-snap-align: start;
      min-width: 0;
      transition: transform 0.3s, box-shadow 0.3s;
      overflow: hidden; /* Added to ensure no overflow from image */
      position: relative; /* Added for mobile background image */
    }

    /* Card 1 - Green */
    .card:nth-child(1) {
      background: linear-gradient(135deg,  #f3f0e3);
    }

    /* Card 2 - Blue */
    .card:nth-child(2) {
      background: linear-gradient(135deg, #0B1D51);
      color: white;
    }

    /* Card 3 - Purple */
    .card:nth-child(3) {
      background: linear-gradient(135deg, #e4f2fb);
    }
    
    /* Card 4 - Orange */
    .card:nth-child(4) {
      background: linear-gradient(135deg, #17313E);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }

    .card-content {
      flex: 1;
      margin-right: 20px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative; /* Added for z-index */
      z-index: 2; /* Added to ensure content stays above background */
    }

    .card h2 {
      font-size: 1.4rem;
      color: #002855;
      margin-bottom: 10px;
      font-weight: 500;
    }

    .card p {
      color: #555;
      line-height: 1.6;
      margin-bottom: 20px;
      font-size: 0.9rem;
    }

    .card button {
      background: #0056d2;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      font-weight: 500;
      cursor: pointer;
      transition: 0.3s;
      font-size: 0.9rem;
      align-self: flex-start;
    }

    .card button:hover {
      background: #003d99;
    }

    .card-image {
      width: 40%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: -25px; /* Negative margin to extend image to edges */
      margin-left: 0; /* Reset left margin */
    }

    .card img {
      width: 100%;
      height: 100%; /* Changed to 100% to fill container */
      object-fit: cover;
      border-radius: 0 12px 12px 0; /* Only round right corners */
    }

    /* Mobile background images - SINGLE CARD VIEW */
  /* Mobile background images - SINGLE CARD VIEW with overlay */
@media (max-width: 768px) {
  .card {
    flex: 0 0 calc(100% - 30px) !important;
    min-width: calc(100% - 30px) !important;
    flex-direction: column;
    position: relative;
    overflow: hidden;
    padding: 0;
    border-radius: 16px;
    min-height: 320px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    margin: 0 5px;
  }

  /* Set images as background with dark overlay */
  .card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    border-radius: 16px;
    background-size: cover;
    background-position: center;
    opacity: 0.8; /* Slightly transparent overlay */
    filter: brightness(0.7); /* Dark overlay for readability */
  }

  .card:nth-child(1)::before { background-image: url('images/2.png'); }
  .card:nth-child(2)::before { background-image: url('images/1.png'); }
  .card:nth-child(3)::before { background-image: url('images/3.png'); }
  .card:nth-child(4)::before { background-image: url('images/4.png'); }

  .card-image {
    display: none; /* Hide original right-side image */
  }

  .card-content {
    margin: 0;
    padding: 25px;
    color: white; /* Text visible over dark overlay */
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    height: 100%;
  }

  .card h2, .card p {
    color: white;
    text-shadow: 0 2px 6px rgba(0,0,0,0.6);
  
  }
}

    /* Responsive adjustments */
    @media (max-width: 1024px) {
      .card {
        flex: 0 0 calc(50% - 10px);
      }
    }

    @media (max-width: 600px) {
      .card {
        min-height: 280px;
      }
      
      .card h2 {
        font-size: 1.3rem;
      }
      
      .card-content {
        padding: 20px;
      }
    }

    /* Navigation buttons */
    .nav-btn {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: white;
      border: none;
      border-radius: 50%;
      width: 45px;
      height: 45px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      font-size: 22px;
      color: #003d99;
      z-index: 10;
      transition: 0.3s;
    }

    .nav-btn:hover {
      background: #003d99;
      color: white;
    }

    .prev { left: 0; }
    .next { right: 0; }
    
    .carousel-title {
      text-align: center;
      font-size: 2rem;
      color: #002855;
      margin-bottom: 10px;
    }
    
    .carousel-subtitle {
      text-align: center;
      color: #666;
      margin-bottom: 30px;
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Mobile indicators */
    .carousel-indicators {
      display: none;
      justify-content: center;
      gap: 8px;
      margin-top: 15px;
    }
    
    .indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background-color: #ccc;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    
    .indicator.active {
      background-color: #0056d2;
    }
    
    @media (max-width: 768px) {
      .carousel-indicators {
        display: flex;
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