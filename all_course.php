<?php 
include 'db/db_connect.php';

// Fetch all courses
$courses = $conn->query("SELECT * FROM courses ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Courses - LearnHub</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
:root {
    --primary-blue: #1a6ae4;
    --secondary-blue: #4d8ef7;
    --light-blue: #eef5ff;
    --dark-blue: #0d4ba3;
    --white: #ffffff;
    --light-gray: #f8f9fa;
    --medium-gray: #e9ecef;
    --dark-gray: #6c757d;
    --text-dark: #343a40;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    --shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.12);
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
    background: #f9fbfd;
    color: var(--text-dark);
    line-height: 1.6;
}

/* Header */
.header {
    background: var(--white);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    padding: 20px 0;
    margin-bottom: 40px;
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.logo {
    height: 36px;
    width: auto;
}

.logo-text {
    font-size: 24px;
    font-weight: 700;
    color: var(--primary-blue);
    letter-spacing: -0.5px;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.search-container {
    position: relative;
    width: 300px;
}

.search-input {
    width: 100%;
    padding: 10px 15px 10px 40px;
    border: 1px solid var(--medium-gray);
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: var(--transition);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-blue);
    box-shadow: 0 0 0 3px rgba(26, 106, 228, 0.1);
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--dark-gray);
}

/* Main Content */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.page-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 10px;
    text-align: center;
}

.page-subtitle {
    font-size: 16px;
    color: var(--dark-gray);
    text-align: center;
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Course Grid */
.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.course-card {
    background: var(--white);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.course-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-hover);
}

.course-image-container {
    height: 180px;
    overflow: hidden;
    position: relative;
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
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary-blue);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
    backdrop-filter: blur(4px);
}

.course-content {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.course-title {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 10px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.course-company {
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--dark-gray);
    font-size: 14px;
    margin-bottom: 15px;
}

.course-company i {
    color: var(--primary-blue);
}

.course-meta {
    display: flex;
    justify-content: space-between;
    margin-top: auto;
    padding-top: 15px;
    border-top: 1px solid var(--medium-gray);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--dark-gray);
}

.meta-item i {
    color: var(--primary-blue);
}

.view-btn {
    display: inline-block;
    background: var(--primary-blue);
    color: var(--white);
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    transition: var(--transition);
    margin-top: 15px;
    border: 2px solid transparent;
}

.view-btn:hover {
    background: var(--dark-blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 106, 228, 0.25);
}

.view-btn i {
    margin-left: 5px;
    transition: transform 0.3s ease;
}

.view-btn:hover i {
    transform: translateX(3px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 20px;
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    margin-bottom: 40px;
}

.empty-icon {
    font-size: 48px;
    color: var(--medium-gray);
    margin-bottom: 20px;
}

.empty-state h3 {
    font-size: 22px;
    color: var(--text-dark);
    margin-bottom: 10px;
}

.empty-state p {
    color: var(--dark-gray);
    max-width: 500px;
    margin: 0 auto 25px;
}

/* Footer */
.footer {
    background: var(--white);
    padding: 25px 0;
    text-align: center;
    color: var(--dark-gray);
    font-size: 14px;
    margin-top: 40px;
    border-top: 1px solid var(--medium-gray);
}

.footer-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Responsive Design */
@media (max-width: 992px) {
    .course-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    }
    
    .search-container {
        width: 250px;
    }
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        gap: 15px;
    }
    
    .search-container {
        width: 100%;
        max-width: 400px;
    }
    
    .page-title {
        font-size: 28px;
    }
    
    .course-grid {
        grid-template-columns: 1fr;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
}

@media (max-width: 480px) {
    .container, .header-container {
        padding: 0 15px;
    }
    
    .page-title {
        font-size: 24px;
    }
    
    .course-image-container {
        height: 160px;
    }
    
    .course-content {
        padding: 15px;
    }
}
</style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <a href="#" class="logo-container">
               
                <span class="logo-text">Faiz Computer Institute</span>
            </a>
            
            <div class="header-actions">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Search courses...">
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <h1 class="page-title">All Courses</h1>
        <p class="page-subtitle">Explore our curated collection of professional courses designed to help you grow your skills and advance your career.</p>
        
        <?php if ($courses->num_rows > 0): ?>
            <div class="course-grid">
                <?php while($row = $courses->fetch_assoc()): ?>
                    <div class="course-card">
                        <div class="course-image-container">
                            <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($row['course_name']); ?>" 
                                 class="course-image"
                                 onerror="this.src='https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80'">
                            <div class="course-badge">
                                <i class="fas fa-graduation-cap"></i>
                                <span>Course</span>
                            </div>
                        </div>
                        
                        <div class="course-content">
                            <h3 class="course-title"><?php echo htmlspecialchars($row['course_name']); ?></h3>
                            
                            <div class="course-company">
                                <i class="fas fa-building"></i>
                                <span><?php echo htmlspecialchars($row['company']); ?></span>
                            </div>
                            
                            <div class="course-meta">
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span><?php echo htmlspecialchars($row['duration']); ?></span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clipboard-check"></i>
                                    <span><?php echo htmlspecialchars($row['total_exams']); ?> Exams</span>
                                </div>
                            </div>
                            
                            <a href="course_detail.php?id=<?php echo $row['id']; ?>" class="view-btn">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3>No Courses Available</h3>
                <p>There are currently no courses available. Please check back later or contact the administrator for more information.</p>
                <a href="#" class="view-btn" style="width: auto; display: inline-block;">
                    <i class="fas fa-home"></i> Return Home
                </a>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> LearnHub. All rights reserved.</p>
            <p style="margin-top: 5px; font-size: 13px;">Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for learners</p>
        </div>
    </footer>

    <script>
        // Simple search functionality
        document.querySelector('.search-input').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const courseCards = document.querySelectorAll('.course-card');
            
            courseCards.forEach(card => {
                const title = card.querySelector('.course-title').textContent.toLowerCase();
                const company = card.querySelector('.course-company span').textContent.toLowerCase();
                
                if (title.includes(searchTerm) || company.includes(searchTerm)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
        
        // Add animation to cards on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.course-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
        
        // Handle image loading errors
        document.querySelectorAll('.course-image').forEach(img => {
            img.addEventListener('error', function() {
                this.src = 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80';
            });
        });
    </script>
</body>
</html>