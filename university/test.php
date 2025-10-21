<?php
include '../db/db_connect.php';

function showCourseSection($conn, $category, $limit = 10) {
    $courses = $conn->query("SELECT * FROM university_courses WHERE category='$category' LIMIT $limit");
    ?>
    <div class="courses-university-section">
        <div class="courses-university-header">
            <div class="courses-university-header-text">
                <h2><?= htmlspecialchars($category) ?></h2>
                <p>Discover our comprehensive <?= htmlspecialchars($category) ?> programs</p>
            </div>
            <button class="courses-university-show-more-btn" onclick="window.location.href='courses.php?category=<?= urlencode($category) ?>'">
                View All
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <div class="courses-university-carousel">
            <?php while($c = $courses->fetch_assoc()):
                $imagePath = !empty($c['image']) && file_exists("../uploads/".$c['image']) 
                    ? "../uploads/".$c['image'] 
                    : "../uploads/default.jpg";
            ?>
            <div class="courses-university-card">
                <div class="courses-university-card-image">
                    <img src="<?= $imagePath ?>" alt="<?= htmlspecialchars($c['course_name']) ?>">
                    <div class="courses-university-card-category"><?= htmlspecialchars($category) ?></div>
                </div>
                <div class="courses-university-content">
                    <h3><?= htmlspecialchars($c['course_name']) ?></h3>
                    <p><?= substr($c['description'], 0, 80) ?>...</p>
                    <div class="courses-university-card-footer">
                        <span class="courses-university-duration">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <?= $c['duration'] ?>
                        </span>
                        <a href="view.php?id=<?= $c['id'] ?>" class="courses-university-view-link">
                            View Details
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
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
<title>Our Courses | University Programs</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root {
    --primary: #4361ee;
    --primary-dark: #3a56d4;
    --secondary: #7209b7;
    --accent: #f72585;
    --light: #f8f9fa;
    --dark: #212529;
    --gray: #6c757d;
    --light-gray: #e9ecef;
    --border-radius: 12px;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
    color: var(--dark);
    font-family: 'Poppins', sans-serif;
    line-height: 1.6;
}

.courses-university-container {
    max-width: 1300px;
    margin: 80px auto;
    padding: 0 20px;
}

.courses-university-title {
    text-align: center;
    font-size: 2.8rem;
    margin-bottom: 20px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 700;
}

.courses-university-subtitle {
    text-align: center;
    font-size: 1.2rem;
    color: var(--gray);
    margin-bottom: 60px;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

/* Course Section */
.courses-university-section {
    margin-bottom: 80px;
    position: relative;
}

.courses-university-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--light-gray);
}

.courses-university-header-text h2 {
    font-size: 1.8rem;
    color: var(--dark);
    margin-bottom: 5px;
    font-weight: 600;
}

.courses-university-header-text p {
    font-size: 1rem;
    color: var(--gray);
    font-weight: 400;
}

.courses-university-show-more-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--primary);
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: var(--border-radius);
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
}

.courses-university-show-more-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
}

/* Carousel */
.courses-university-carousel {
    display: flex;
    gap: 25px;
    overflow-x: auto;
    scroll-behavior: smooth;
    padding: 10px 5px 25px;
    position: relative;
}

.courses-university-carousel::-webkit-scrollbar {
    height: 8px;
}

.courses-university-carousel::-webkit-scrollbar-thumb {
    background: var(--primary);
    border-radius: 4px;
}

.courses-university-carousel::-webkit-scrollbar-track {
    background: var(--light-gray);
    border-radius: 4px;
}

/* Card */
.courses-university-card {
    background: white;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    flex: 0 0 320px;
    transition: var(--transition);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.courses-university-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.courses-university-card-image {
    position: relative;
    height: 180px;
    overflow: hidden;
}

.courses-university-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.courses-university-card:hover .courses-university-card-image img {
    transform: scale(1.05);
}

.courses-university-card-category {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(5px);
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.courses-university-content {
    padding: 25px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.courses-university-content h3 {
    font-size: 1.25rem;
    margin-bottom: 12px;
    color: var(--dark);
    font-weight: 600;
    line-height: 1.4;
}

.courses-university-content p {
    font-size: 0.9rem;
    color: var(--gray);
    margin-bottom: 20px;
    flex-grow: 1;
}

.courses-university-card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
}

.courses-university-duration {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
    color: var(--gray);
    font-weight: 500;
}

.courses-university-view-link {
    display: flex;
    align-items: center;
    gap: 6px;
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: var(--transition);
}

.courses-university-view-link:hover {
    color: var(--primary-dark);
    gap: 8px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .courses-university-card {
        flex: 0 0 300px;
    }
}

@media (max-width: 768px) {
    .courses-university-container {
        margin: 60px auto;
    }
    
    .courses-university-title {
        font-size: 2.2rem;
    }
    
    .courses-university-subtitle {
        font-size: 1rem;
        margin-bottom: 40px;
    }
    
    .courses-university-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .courses-university-card {
        flex: 0 0 280px;
    }
}

@media (max-width: 480px) {
    .courses-university-container {
        margin: 40px auto;
        padding: 0 15px;
    }
    
    .courses-university-title {
        font-size: 1.8rem;
    }
    
    .courses-university-card {
        flex: 0 0 260px;
    }
    
    .courses-university-content {
        padding: 20px;
    }
    
    .courses-university-card-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .courses-university-view-link {
        align-self: flex-end;
    }
}
</style>
</head>
<body>

<div class="courses-university-container">
    <h1 class="courses-university-title">Explore Our Courses</h1>
    <p class="courses-university-subtitle">Discover a wide range of programs designed to help you achieve your academic and career goals</p>

    <?php 
    showCourseSection($conn, 'Graduation'); 
    ?>

    <?php 
    showCourseSection($conn, 'Diploma'); 
    showCourseSection($conn, 'Post Graduation'); 
    ?>
</div>

</body>
</html>