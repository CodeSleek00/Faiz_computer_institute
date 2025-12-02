<?php 
include 'db/db_connect.php';
$id = $_GET['id'] ?? 0;
$course = $conn->query("SELECT * FROM courses WHERE id=$id")->fetch_assoc();
$syllabus = $conn->query("SELECT * FROM course_syllabus WHERE course_id=$id");
$docs = $conn->query("SELECT * FROM course_documents WHERE course_id=$id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $course['course_name'] ?> - Course Details</title>
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
    --success: #2b8a3e;
    --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
    background: var(--light-blue);
    color: var(--text-dark);
    line-height: 1.6;
}

/* Header and Navigation */
.header {
    background: var(--white);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    position: sticky;
    top: 0;
    z-index: 100;
}

.nav-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 70px;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    height: 40px;
    width: auto;
}

.logo-text {
    font-size: 22px;
    font-weight: 700;
    color: var(--primary-blue);
    letter-spacing: -0.5px;
}

.back-btn {
    background: var(--light-blue);
    color: var(--primary-blue);
    border: none;
    border-radius: 8px;
    padding: 8px 16px;
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: var(--transition);
}

.back-btn:hover {
    background: var(--secondary-blue);
    color: var(--white);
    transform: translateY(-2px);
}

/* Main Content */
.main-container {
    max-width: 1100px;
    margin: 30px auto;
    padding: 0 20px;
}

.course-card {
    background: var(--white);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 30px;
}

.course-header {
    position: relative;
}

.course-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
}

.image-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    padding: 30px;
    color: var(--white);
}

.course-title {
    font-size: 32px;
    font-weight: 700;
    margin-bottom: 8px;
}

.course-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 15px;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 15px;
    background: rgba(255, 255, 255, 0.2);
    padding: 6px 12px;
    border-radius: 20px;
    backdrop-filter: blur(5px);
}

.course-body {
    padding: 30px;
}

.section-title {
    font-size: 22px;
    font-weight: 600;
    color: var(--primary-blue);
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--light-blue);
}

.course-description {
    font-size: 16px;
    line-height: 1.8;
    margin-bottom: 25px;
    color: var(--text-dark);
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.detail-card {
    background: var(--light-blue);
    border-radius: var(--radius);
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: var(--transition);
}

.detail-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(26, 106, 228, 0.1);
}

.detail-icon {
    background: var(--primary-blue);
    color: var(--white);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.detail-text h4 {
    font-size: 14px;
    color: var(--dark-gray);
    margin-bottom: 5px;
}

.detail-text p {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-dark);
}

/* Syllabus and Documents */
.content-section {
    margin-bottom: 30px;
}

.syllabus-list, .documents-list {
    list-style: none;
}

.syllabus-item, .document-item {
    background: var(--light-gray);
    border-radius: 8px;
    padding: 15px 20px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: var(--transition);
    border-left: 4px solid transparent;
}

.syllabus-item:hover, .document-item:hover {
    border-left-color: var(--primary-blue);
    background: var(--light-blue);
    transform: translateX(5px);
}

.syllabus-item::before, .document-item::before {
    content: "✓";
    background: var(--primary-blue);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

/* Action Section */
.action-section {
    background: var(--light-blue);
    border-radius: var(--radius);
    padding: 25px;
    text-align: center;
    margin-top: 30px;
}

.price {
    font-size: 36px;
    font-weight: 700;
    color: var(--primary-blue);
    margin-bottom: 20px;
}

.enroll-btn {
    background: var(--primary-blue);
    color: var(--white);
    border: none;
    border-radius: 8px;
    padding: 16px 40px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: var(--transition);
    box-shadow: 0 4px 15px rgba(26, 106, 228, 0.3);
}

.enroll-btn:hover {
    background: var(--dark-blue);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(26, 106, 228, 0.4);
}

/* Footer */
.footer {
    background: var(--white);
    padding: 20px;
    text-align: center;
    color: var(--dark-gray);
    font-size: 14px;
    margin-top: 40px;
    border-top: 1px solid var(--medium-gray);
}

/* Responsive Design */
@media (max-width: 768px) {
    .course-image {
        height: 300px;
    }
    
    .image-overlay {
        padding: 20px;
    }
    
    .course-title {
        font-size: 26px;
    }
    
    .course-meta {
        gap: 10px;
    }
    
    .meta-item {
        font-size: 13px;
        padding: 5px 10px;
    }
    
    .course-body {
        padding: 20px;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .nav-container {
        padding: 0 15px;
        height: 60px;
    }
    
    .logo-text {
        font-size: 20px;
    }
    
    .back-btn {
        padding: 6px 12px;
        font-size: 14px;
    }
}

@media (max-width: 480px) {
    .course-image {
        height: 250px;
    }
    
    .course-title {
        font-size: 22px;
    }
    
    .section-title {
        font-size: 20px;
    }
    
    .enroll-btn {
        width: 100%;
        justify-content: center;
    }
    
    .price {
        font-size: 28px;
    }
    
    .main-container {
        padding: 0 15px;
    }
}
</style>
</head>
<body>
    <!-- Header with Logo and Back Button -->
    <header class="header">
        <div class="nav-container">
            <div class="logo-container">
                <!-- Logo SVG in blue/white theme -->
                <svg class="logo" viewBox="0 0 100 100" width="40" height="40">
                    <rect x="10" y="10" width="80" height="80" rx="15" fill="#1a6ae4"/>
                    <path d="M30,40 L50,60 L70,30" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    <circle cx="50" cy="50" r="30" stroke="white" stroke-width="2" fill="none"/>
                </svg>
                <span class="logo-text">LearnHub</span>
            </div>
            <button class="back-btn" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back to Courses
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-container">
        <div class="course-card">
            <div class="course-header">
                <img src="<?= !empty($course['image']) ? $course['image'] : 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1200&q=80' ?>" 
                     alt="<?= $course['course_name'] ?>" class="course-image">
                <div class="image-overlay">
                    <h1 class="course-title"><?= $course['course_name'] ?></h1>
                    <div class="course-meta">
                        <div class="meta-item">
                            <i class="fas fa-building"></i>
                            <span><?= $course['company'] ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="far fa-clock"></i>
                            <span><?= $course['duration'] ?></span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-clipboard-check"></i>
                            <span><?= $course['total_exams'] ?> Exams</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="course-body">
                <!-- Course Description -->
                <section class="content-section">
                    <h2 class="section-title">Course Overview</h2>
                    <p class="course-description"><?= nl2br($course['description']) ?></p>
                </section>
                
                <!-- Course Details Grid -->
                <section class="content-section">
                    <h2 class="section-title">Course Details</h2>
                    <div class="details-grid">
                        <div class="detail-card">
                            <div class="detail-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="detail-text">
                                <h4>Duration</h4>
                                <p><?= $course['duration'] ?></p>
                            </div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="detail-text">
                                <h4>Company</h4>
                                <p><?= $course['company'] ?></p>
                            </div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-icon">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="detail-text">
                                <h4>Total Exams</h4>
                                <p><?= $course['total_exams'] ?></p>
                            </div>
                        </div>
                        <div class="detail-card">
                            <div class="detail-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="detail-text">
                                <h4>Skill Level</h4>
                                <p>Intermediate</p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Syllabus Section -->
                <section class="content-section">
                    <h2 class="section-title">Course Syllabus</h2>
                    <ul class="syllabus-list">
                        <?php 
                        if ($syllabus->num_rows > 0) {
                            while($s = $syllabus->fetch_assoc()) {
                                echo "<li class='syllabus-item'>" . htmlspecialchars($s['syllabus_item']) . "</li>";
                            }
                        } else {
                            echo "<li class='syllabus-item'>No syllabus available for this course.</li>";
                        }
                        ?>
                    </ul>
                </section>
                
                <!-- Documents Section -->
                <section class="content-section">
                    <h2 class="section-title">Course Documents</h2>
                    <ul class="documents-list">
                        <?php 
                        if ($docs->num_rows > 0) {
                            while($d = $docs->fetch_assoc()) {
                                echo "<li class='document-item'>" . htmlspecialchars($d['document_name']) . "</li>";
                            }
                        } else {
                            echo "<li class='document-item'>No documents available for this course.</li>";
                        }
                        ?>
                    </ul>
                </section>
                
                <!-- Action Section -->
                <div class="action-section">
                    <div class="price">Free</div>
                    <button class="enroll-btn">
                        <i class="fas fa-rocket"></i> Enroll Now
                    </button>
                    <p style="margin-top: 15px; color: var(--dark-gray); font-size: 14px;">
                        Start learning immediately after enrollment
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; <?= date('Y') ?> LearnHub. All rights reserved.</p>
        <p style="margin-top: 5px;">Designed with <i class="fas fa-heart" style="color: #e74c3c;"></i> for learners worldwide</p>
    </footer>

    <script>
        // Simple animation for enroll button
        document.querySelector('.enroll-btn').addEventListener('click', function() {
            // Animate button on click
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
                alert('Enrollment successful! You now have access to this course.');
            }, 200);
        });
        
        // Add hover effects to syllabus and document items
        const listItems = document.querySelectorAll('.syllabus-item, .document-item');
        listItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.boxShadow = '0 4px 10px rgba(26, 106, 228, 0.15)';
            });
            item.addEventListener('mouseleave', function() {
                this.style.boxShadow = 'none';
            });
        });
    </script>
</body>
</html>