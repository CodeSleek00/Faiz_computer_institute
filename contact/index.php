<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
            padding: 80px 0 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
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
            font-size: 2.8rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }
        
        header p {
            font-size: 1.1rem;
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
            margin: -60px auto 60px;
            position: relative;
            z-index: 2;
        }
        
        .contact-info {
            flex: 1;
            min-width: 300px;
            background: var(--white);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        .contact-form {
            flex: 1.5;
            min-width: 300px;
            background: var(--white);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        .section-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--primary-blue);
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
            border-radius: 3px;
        }
        
        /* Contact Info */
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }
        
        .info-icon {
            width: 50px;
            height: 50px;
            background-color: rgba(30, 64, 175, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .info-icon i {
            color: var(--primary-blue);
            font-size: 1.2rem;
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
            width: 40px;
            height: 40px;
            background-color: rgba(30, 64, 175, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background-color: var(--primary-blue);
            color: var(--white);
            transform: translateY(-3px);
        }
        
        /* Contact Form */
        .form-group {
            margin-bottom: 20px;
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
        
        input, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--medium-gray);
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--light-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .submit-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            color: var(--white);
            border: none;
            border-radius: 8px;
            padding: 16px 30px;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 64, 175, 0.3);
        }
        
        .submit-btn i {
            margin-left: 8px;
        }
        
        #response {
            margin-top: 15px;
            text-align: center;
            font-weight: 500;
        }
        
        /* Map Section */
        .map-section {
            margin: 60px auto;
        }
        
        .map-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-blue);
        }
        
        .map-container {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        
        /* Footer */
        footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 40px 0;
            text-align: center;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }
        
        .footer-logo {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .footer-links {
            display: flex;
            gap: 20px;
        }
        
        .footer-links a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s ease;
        }
        
        .footer-links a:hover {
            opacity: 0.8;
        }
        
        .copyright {
            margin-top: 20px;
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.2rem;
            }
            
            .main-content {
                flex-direction: column;
                margin-top: -40px;
            }
            
            .contact-info, .contact-form {
                padding: 30px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .footer-content {
                flex-direction: column;
                text-align: center;
            }
        }
        
        @media (max-width: 480px) {
            header {
                padding: 60px 0 30px;
            }
            
            header h1 {
                font-size: 1.8rem;
            }
            
            .contact-info, .contact-form {
                padding: 25px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>Get In Touch With Us</h1>
            <p>We're here to help and answer any questions you might have. We look forward to hearing from you.</p><br><br>
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
                        <p>Lucknow, Uttar Pradesh – India</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-text">
                        <h3>Email Address</h3>
                        <p>support@yourdomain.com</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-text">
                        <h3>Phone Number</h3>
                        <p>+91 9876543210</p>
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
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" placeholder="Enter your full name" required>
                        </div>
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" placeholder="Enter your company name">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="Enter your email address" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" placeholder="Enter the subject of your message" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" placeholder="Enter your message here..." required></textarea>
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
    
   
    
    <script>
        function submitForm() {
            // Get form values
            const name = document.getElementById('name').value;
            const company = document.getElementById('company').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            // Simple validation
            if (!name || !phone || !email || !subject || !message) {
                document.getElementById('response').innerHTML = 'Please fill in all required fields.';
                document.getElementById('response').style.color = '#e53e3e';
                return;
            }
            
            // Create FormData object
            let fd = new FormData();
            fd.append("name", name);
            fd.append("company", company);
            fd.append("contact", phone);
            fd.append("email", email);
            fd.append("subject", subject);
            fd.append("message", message);
            
            // Simulate form submission (replace with actual fetch request)
            document.getElementById('response').innerHTML = 'Thank you! Your message has been sent successfully.';
            document.getElementById('response').style.color = '#059669';
            
            // Clear form
            document.getElementById('contactForm').reset();
            
            // In a real implementation, you would use:
            /*
            fetch("save_contact.php", {
                method: "POST",
                body: fd
            })
            .then(r => r.text())
            .then(data => {
                document.getElementById("response").innerHTML = data;
                document.getElementById("contactForm").reset();
            });
            */
        }
    </script>
</body>
</html>