<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Faiz Computer Institute</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="../images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
    
    <style>
        :root {
            --primary-blue: #1e40af;
            --light-blue: #3b82f6;
            --accent-color: #f59e0b;
            --white: #ffffff;
            --light-gray: #f8fafc;
            --medium-gray: #e2e8f0;
            --dark-gray: #64748b;
            --text-dark: #1e293b;
            --success-color: #059669;
            --error-color: #e53e3e;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-gray);
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        /* Header */
        header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            color: var(--white);
            padding: 100px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        
        header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,261.3C672,256,768,224,864,218.7C960,213,1056,235,1152,234.7C1248,235,1344,213,1392,202.7L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            background-position: center bottom;
        }
        
        header h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        header p {
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
            opacity: 0.9;
        }
        
        /* Main Content */
        .main-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            margin: -80px auto 60px;
            position: relative;
            z-index: 2;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            margin-top: 30px;
        }
        
        .contact-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
        }
        
        .contact-form {
            flex: 1.5;
            min-width: 300px;
            background: var(--white);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
            position: relative;
            overflow: hidden;
            margin-top: 30px;
        }
        
        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, var(--accent-color) 0%, #fbbf24 100%);
        }
        
        .section-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--primary-blue);
            position: relative;
            padding-bottom: 12px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 3px;
        }
        
        /* Contact Info */
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
            transition: transform 0.3s ease;
        }
        
        .info-item:hover {
            transform: translateX(5px);
        }
        
        .info-icon {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.2);
        }
        
        .info-icon i {
            color: var(--white);
            font-size: 1.3rem;
        }
        
        .info-text h3 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }
        
        .info-text p {
            color: var(--dark-gray);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        
        .social-link {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.2);
        }
        
        .social-link:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(30, 64, 175, 0.3);
        }
        
        /* Contact Form */
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-row .form-group {
            flex: 1;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-dark);
        }
        
        input, textarea, select {
            width: 100%;
            padding: 16px 18px;
            border: 1px solid var(--medium-gray);
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #fafbfc;
        }
        input {
            padding: 20px;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--light-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            background-color: var(--white);
        }
        
        textarea {
            resize: vertical;
            min-height: 140px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            color: var(--white);
            border: none;
            border-radius: 10px;
            padding: 18px 30px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.3);
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(30, 64, 175, 0.4);
        }
        
        .submit-btn i {
            margin-left: 8px;
        }
        
        #response {
            margin-top: 15px;
            text-align: center;
            font-weight: 500;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        /* Map Section */
        .map-section {
            margin: 30px auto;
        }
        
        .map-title {
            text-align: center;
            margin-bottom: 40px;
            color: var(--primary-blue);
            font-size: 2.2rem;
        }
        
        .map-container {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        }
        
        /* Navigation Styles */
        nav {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 5%;
            position: sticky;
            top: 0;
            z-index: 1000;
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

        /* Responsive Styles */
        @media (max-width: 768px) {
            header {
                padding: 80px 0 50px;
            }
            
            header h1 {
                font-size: 2.4rem;
            }
            
            .main-content {
                flex-direction: column;
                margin-top: -60px;
            }
            
            .contact-info, .contact-form {
                padding: 30px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
           
            .map-title {
                font-size: 1.8rem;
            }
            
            .mobile-toggle {
                display: block;
            }
            
            .nav-center, .nav-right {
                display: none;
            }
        }
        
        @media (max-width: 480px) {
            header {
                padding: 60px 0 40px;
            }
            
            header h1 {
                font-size: 2rem;
            }
            
            header p {
                font-size: 1rem;
            }
            
            .contact-info, .contact-form {
                padding: 25px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .info-icon {
                width: 45px;
                height: 45px;
            }
            .contact-form {
                margin-top: 0px;
            }
            
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
    <!-- Navigation -->
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
                    <a href="https://faizcomputerinstitute.in/login-system/login.php">Login <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>Online Degree</h4>
                    <a href="view.php?id=18"><i class="fas fa-graduation-cap"></i> BCA</a>
                    <a href="view.php?id=25"><i class="fas fa-user-graduate"></i> MCA</a>
                    <a href="view.php?id=19"><i class="fas fa-book"></i> BBA</a>
                    <a href="view.php?id=21"><i class="fas fa-briefcase"></i> MBA</a>
                    <a href="university.php">More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>Trending Courses</h4>
                    <a href="../course_detail.php?id=1"><i class="fab fa-python"></i> DOAP</a>
                    <a href="../course_detail.php?id=7"><i class="fas fa-palette"></i> O Level</a>
                    <a href="../course_detail.php?id=3"><i class="fas fa-calculator"></i> Tally</a>
                    <a href="../course_detail.php?id=9"><i class="fas fa-bullhorn"></i> Advance Excel</a>
                    <a href="../all_course.php">More Courses <i class="fa-solid fa-arrow-right"></i></a>
                </div>
                <div class="dropdown-column">
                    <h4>About Us</h4>
                    <a href="#"><i class="fas fa-layer-group"></i>Contact Us</a>
                <a href="#"><i class="fas fa-table"></i> Gallery</a>
                <a href="#"><i class="fas fa-network-wired"></i> Brochure</a>
                <a href="#"><i class="fas fa-user-secret"></i>  Enquiry</a>
                <a href="university/university.php">More <i class="fa-solid fa-arrow-right"></i></a>
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
                    <a href="../all_course.php">More Courses <i class="fa-solid fa-arrow-right"></i></a>
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
                <a href="university/university.php">More <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
        
        <div class="mobile-auth">
            <a href="https://faizcomputerinstitute.in/login-system/login.php" style="text-decoration: none;">
                <button class="mobile-login">Login</button>
            </a>
        </div>
        
        <div class="mobile-free">
            <i class="fas fa-gift"></i>
            <a href="../free/free.html" style="text-decoration: none;">
                <span>Free Courses</span>
            </a>
        </div>
        
        <div class="mobile-free">
            <i class="fas fa-graduation-cap"></i>
            <a href="../o-level/index.php" style="text-decoration: none;">
                <span>O Level/CCC</span>
            </a>
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="container">
            <h1>Get In Touch With Us</h1>
            <p>We're here to help and answer any questions you might have. <br>We look forward to hearing from you!</p>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="container">
        <div class="main-content">
            <!-- Contact Info -->
            <div class="contact-info">
                <h2 class="section-title">Contact Information</h2>
                <p>Feel free to reach out to us through any of the following channels.</p>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Our Location</h3>
                        <p>Charan Plaza, Infront Of Masjid, Telibagh, Lucknow, Uttar Pradesh – India</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <h3>Email Address</h3>
                        <p>Faizcomputerinstitutes@gmail.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Phone Number</h3>
                        <p>+91 9721896891, +91 7007862136</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="info-text">
                        <h3>Working Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM</p>
                    </div>
                </div>
                
                <h3 style="margin-top: 30px; margin-bottom: 15px;">Follow Us</h3>
                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form">
                <h2 class="section-title">Send Us a Message</h2>
                <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter your full name" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" name="contact" id="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" id="subject" required>
                            <option value="" disabled selected>Select a subject</option>
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Course Information">Course Information</option>
                            <option value="Admission Process">Admission Process</option>
                            <option value="Fee Structure">Fee Structure</option>
                            <option value="Technical Support">Technical Support</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea name="message" id="message" placeholder="Enter your message here..." required></textarea>
                    </div>
                    
                    <button type="button" class="submit-btn" onclick="submitForm()">
                        Send Message <i class="fas fa-paper-plane"></i>
                    </button>
                    
                    <p id="response"></p>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Map Section -->
    <div class="container map-section">
        <h2 class="map-title">Find Us Here</h2>
        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28470.858110412!2d80.94151576644922!3d26.846528200000007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399bfd991f32b16b%3A0x93ccba8909978be7!2sLucknow%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1700000000000"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
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
                        <div>
                            <a class="hover:text-blue-600 transition block" href="tel:+919721896891">+91 9721896891</a>
                            <a class="hover:text-blue-600 transition block" href="tel:+917007862136">+91 7007862136</a>
                        </div>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope text-blue-600 mr-3"></i>
                        <a class="hover:text-blue-600 transition" href="mailto:Faizcomputerinstitutes@gmail.com">Faizcomputerinstitutes@gmail.com</a>
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

    <script>
        // Mobile menu functionality
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileToggle');
            const mobileClose = document.getElementById('mobileClose');
            const mobileMenu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('overlay');
            
            // Toggle mobile menu
            mobileToggle.addEventListener('click', function() {
                mobileMenu.classList.add('active');
                overlay.classList.add('active');
            });
            
            // Close mobile menu
            mobileClose.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            // Close mobile menu when clicking overlay
            overlay.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                overlay.classList.remove('active');
            });
            
            // Mobile dropdown functionality
            const mobileMenuHeaders = document.querySelectorAll('.mobile-menu-header-item');
            mobileMenuHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const targetDropdown = document.getElementById(targetId);
                    
                    // Toggle active class on header
                    this.classList.toggle('active');
                    
                    // Toggle active class on dropdown
                    targetDropdown.classList.toggle('active');
                });
            });
        });

        // Form submission function
        function submitForm() {
            const form = document.getElementById('contactForm');
            const response = document.getElementById('response');

            // Form validation
            if (!form.name.value || !form.contact.value || !form.email.value || !form.subject.value || !form.message.value) {
                response.innerHTML = "Please fill all required fields.";
                response.style.color = "#e53e3e";
                response.style.backgroundColor = "rgba(229, 62, 62, 0.1)";
                return;
            }

            // Send form data
            let fd = new FormData(form);

            fetch("save_contact.php", {
                method: "POST",
                body: fd
            })
            .then(res => res.text())
            .then(data => {
                response.innerHTML = data;
                response.style.color = "#059669";
                response.style.backgroundColor = "rgba(5, 150, 105, 0.1)";
                form.reset();
            })
            .catch(err => {
                response.innerHTML = "Something went wrong! Please try again later.";
                response.style.color = "#e53e3e";
                response.style.backgroundColor = "rgba(229, 62, 62, 0.1)";
            });
        }
    </script>
</body>
</html>