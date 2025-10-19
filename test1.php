<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Course Explorer | Minimal Design</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
  --primary: #4361ee;
  --primary-light: #4895ef;
  --dark: #2b2d42;
  --gray: #8d99ae;
  --light-gray: #edf2f4;
  --white: #ffffff;
  --shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  --radius: 12px;
  --transition: all 0.3s ease;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Poppins', sans-serif;
  background: #f9fafc;
  color: var(--dark);
  line-height: 1.6;
  padding: 0;
  margin: 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.section-title {
  font-size: 1.75rem;
  font-weight: 600;
  color: var(--dark);
  margin: 60px 0 30px;
  position: relative;
  padding-bottom: 12px;
}

.section-title::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 50px;
  height: 3px;
  background: var(--primary);
  border-radius: 2px;
}

.course-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 25px;
  margin-bottom: 40px;
}

.course-card {
  background: var(--white);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  overflow: hidden;
  transition: var(--transition);
  position: relative;
}

.course-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
}

.course-image {
  width: 100%;
  height: 180px;
  object-fit: cover;
  display: block;
}

.course-info {
  padding: 20px;
}

.course-title {
  font-size: 1.125rem;
  font-weight: 600;
  color: var(--dark);
  margin-bottom: 8px;
  line-height: 1.4;
}

.course-company {
  font-size: 0.875rem;
  color: var(--gray);
  margin-bottom: 12px;
  font-weight: 400;
}

.badge {
  display: inline-block;
  background: var(--primary-light);
  color: var(--white);
  padding: 4px 12px;
  font-size: 0.75rem;
  border-radius: 20px;
  font-weight: 500;
  letter-spacing: 0.5px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .container {
    padding: 0 15px;
  }
  
  .section-title {
    font-size: 1.5rem;
    margin: 40px 0 25px;
  }
  
  .course-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
  }
  
  .course-image {
    height: 160px;
  }
}

@media (max-width: 576px) {
  .course-grid {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .section-title {
    font-size: 1.375rem;
    margin: 30px 0 20px;
  }
  
  .course-info {
    padding: 16px;
  }
  
  .course-title {
    font-size: 1rem;
  }
}
</style>
</head>
<body>

<div class="container">
    <?php
    // Function to display each section
    function showSection($title, $section, $conn) {
        $res = $conn->query("SELECT * FROM courses WHERE home_section2='$section'");
        if($res->num_rows > 0){
            echo "<h2 class='section-title'>$title</h2>";
            echo "<div class='course-grid'>";
            while($r = $res->fetch_assoc()){
                echo "<div class='course-card'>
                        <img class='course-image' src='../uploads/{$r['image']}' alt='{$r['course_name']}'>
                        <div class='course-info'>
                            <h3 class='course-title'>{$r['course_name']}</h3>
                            <p class='course-company'>{$r['company']}</p>
                            <span class='badge'>".ucfirst($section)."</span>
                        </div>
                      </div>";
            }
            echo "</div>";
        }
    }

    // Show all 3 sections
    showSection("Popular Courses", "popular", $conn);
    showSection("Skill Development", "skills", $conn);
    showSection("More Courses", "free", $conn);
    ?>
</div>

</body>
</html>