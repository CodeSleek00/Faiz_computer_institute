<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Explorer | Modern Design</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
:root {
  --primary: #6366f1;
  --primary-light: #818cf8;
  --primary-dark: #4f46e5;
  --secondary: #f59e0b;
  --accent: #10b981;
  --dark: #1f2937;
  --darker: #111827;
  --gray: #6b7280;
  --light-gray: #f3f4f6;
  --white: #ffffff;
  --card-bg: #ffffff;
  --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-hover: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --radius: 16px;
  --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
  color: var(--dark);
  line-height: 1.6;
  min-height: 100vh;
}

.container {
  max-width: 1280px;
  margin: 0 auto;
  padding: 40px 20px;
}

/* Header Styles */
.page-header {
  text-align: center;
  margin-bottom: 60px;
}

.page-title {
  font-size: 3rem;
  font-weight: 700;
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 16px;
}

.page-subtitle {
  font-size: 1.125rem;
  color: var(--gray);
  max-width: 600px;
  margin: 0 auto;
}

/* Section Styles */
.section-container {
  margin-bottom: 80px;
}

.section-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.section-title {
  font-size: 2rem;
  font-weight: 600;
  color: var(--darker);
  position: relative;
  padding-left: 20px;
}

.section-title::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 6px;
  height: 32px;
  background: linear-gradient(to bottom, var(--primary), var(--primary-light));
  border-radius: 3px;
}

.view-all {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  color: var(--primary);
  font-weight: 500;
  text-decoration: none;
  transition: var(--transition);
  padding: 8px 16px;
  border-radius: 8px;
}

.view-all:hover {
  background: rgba(99, 102, 241, 0.1);
  transform: translateX(4px);
}

/* Course Grid */
.course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 30px;
}

.course-card {
  background: var(--card-bg);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow: hidden;
  transition: var(--transition);
  position: relative;
  border: 1px solid rgba(255, 255, 255, 0.8);
}

.course-card:hover {
  transform: translateY(-8px);
  box-shadow: var(--shadow-hover);
}

.course-image-container {
  position: relative;
  overflow: hidden;
  height: 200px;
}

.course-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: var(--transition);
}

.course-card:hover .course-image {
  transform: scale(1.05);
}

.course-badge {
  position: absolute;
  top: 16px;
  right: 16px;
  background: var(--white);
  color: var(--primary);
  padding: 6px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  box-shadow: var(--shadow);
}

.course-info {
  padding: 24px;
}

.course-meta {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 12px;
}

.course-provider {
  display: flex;
  align-items: center;
  gap: 6px;
  font-size: 0.875rem;
  color: var(--gray);
  font-weight: 500;
}

.provider-icon {
  color: var(--primary);
  font-size: 0.75rem;
}

.course-rating {
  display: flex;
  align-items: center;
  gap: 4px;
  font-size: 0.875rem;
  color: var(--gray);
}

.stars {
  color: var(--secondary);
}

.course-title {
  font-size: 1.25rem;
  font-weight: 600;
  color: var(--darker);
  margin-bottom: 16px;
  line-height: 1.4;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.course-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 16px;
  border-top: 1px solid var(--light-gray);
}

.course-price {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--primary-dark);
}

.course-price.free {
  color: var(--accent);
}

.enroll-btn {
  background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  font-weight: 500;
  cursor: pointer;
  transition: var(--transition);
  display: flex;
  align-items: center;
  gap: 8px;
}

.enroll-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 15px rgba(99, 102, 241, 0.3);
}

/* Section-specific colors */
.section-popular .course-badge {
  background: linear-gradient(135deg, #ff6b6b, #ee5a52);
  color: white;
}

.section-skills .course-badge {
  background: linear-gradient(135deg, #4ecdc4, #44a08d);
  color: white;
}

.section-free .course-badge {
  background: linear-gradient(135deg, #45b7d1, #96c93d);
  color: white;
}

/* Responsive Design */
@media (max-width: 1024px) {
  .course-grid {
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 24px;
  }
  
  .page-title {
    font-size: 2.5rem;
  }
}

@media (max-width: 768px) {
  .container {
    padding: 30px 16px;
  }
  
  .page-title {
    font-size: 2rem;
  }
  
  .section-title {
    font-size: 1.75rem;
  }
  
  .course-grid {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 16px;
  }
}

@media (max-width: 480px) {
  .page-title {
    font-size: 1.75rem;
  }
  
  .course-info {
    padding: 20px;
  }
  
  .course-footer {
    flex-direction: column;
    gap: 12px;
    align-items: flex-start;
  }
  
  .enroll-btn {
    width: 100%;
    justify-content: center;
  }
}

/* Loading Animation */
@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.course-card {
  animation: fadeInUp 0.6s ease-out;
}

.course-card:nth-child(2) {
  animation-delay: 0.1s;
}

.course-card:nth-child(3) {
  animation-delay: 0.2s;
}
</style>
</head>
<body>

<div class="container">
  <header class="page-header">
    <h1 class="page-title">Discover Your Next Course</h1>
    <p class="page-subtitle">Explore our curated collection of courses designed to help you grow your skills and advance your career</p>
  </header>

  <?php
  // Function to display each section with enhanced design
  function showSection($title, $section, $conn) {
      $res = $conn->query("SELECT * FROM courses WHERE home_section2='$section' ORDER BY id DESC LIMIT 6");
      if($res->num_rows > 0){
          echo "<div class='section-container section-{$section}'>";
          echo "<div class='section-header'>";
          echo "<h2 class='section-title'>{$title}</h2>";
          echo "<a href='#' class='view-all'>View All <i class='fas fa-arrow-right'></i></a>";
          echo "</div>";
          echo "<div class='course-grid'>";
          
          while($r = $res->fetch_assoc()){
              $image_path = !empty($r['image']) ? '../uploads/' . $r['image'] : 'https://images.unsplash.com/photo-1497636577773-f1231844b336?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80';
              $rating = number_format(4.2 + (rand(0, 30) / 10), 1);
              $price = $section === 'free' ? 'Free' : '$' . (49 + rand(0, 150));
              
              echo "<div class='course-card'>";
              echo "<div class='course-image-container'>";
              echo "<img class='course-image' src='{$image_path}' alt='{$r['course_name']}'>";
              echo "<span class='course-badge'>" . ucfirst($section) . "</span>";
              echo "</div>";
              echo "<div class='course-info'>";
              echo "<div class='course-meta'>";
              echo "<span class='course-provider'><i class='fas fa-building provider-icon'></i> {$r['company']}</span>";
              echo "<span class='course-rating'><span class='stars'><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star-half-alt'></i></span> {$rating}</span>";
              echo "</div>";
              echo "<h3 class='course-title'>{$r['course_name']}</h3>";
              echo "<div class='course-footer'>";
              echo "<span class='course-price " . ($section === 'free' ? 'free' : '') . "'>{$price}</span>";
              echo "<button class='enroll-btn'><i class='fas fa-rocket'></i> Enroll Now</button>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
          }
          echo "</div>";
          echo "</div>";
      }
  }

  // Show all 3 sections
  showSection("Popular Courses", "popular", $conn);
  showSection("Skill Development", "skills", $conn);
  showSection("Free Courses", "free", $conn);
  ?>
</div>

<script>
// Add interactive animations
document.addEventListener('DOMContentLoaded', function() {
  const courseCards = document.querySelectorAll('.course-card');
  
  courseCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-8px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
  
  // Add click animation to enroll buttons
  const enrollButtons = document.querySelectorAll('.enroll-btn');
  enrollButtons.forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      this.style.transform = 'scale(0.95)';
      setTimeout(() => {
        this.style.transform = '';
      }, 150);
    });
  });
});
</script>

</body>
</html>