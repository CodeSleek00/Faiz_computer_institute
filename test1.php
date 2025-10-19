<?php include 'db/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Courses</title>
<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #eef4ff;
    margin: 0;
    padding: 0;
}
.main-container {
    display: flex;
    gap: 20px;
    padding: 20px 40px;
    max-width: 1400px;
    margin: 0 auto;
}
.section {
    flex: 1;
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}
.header {
    text-align: left;
    padding: 10px 0 20px 0;
    font-size: 22px;
    font-weight: 600;
    color: #222;
    border-bottom: 2px solid #eef4ff;
    margin-bottom: 15px;
}
.header span {
    color: #0066ff;
}
.courses-container {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.course-pill {
    background: #fff;
    border-radius: 12px;
    display: flex;
    align-items: center;
    padding: 12px 14px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    color: #000;
    border: 1px solid #f0f0f0;
}
.course-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    border-color: #0066ff;
}
.course-pill img {
    width: 50px;
    height: 50px;
    border-radius: 8px;
    object-fit: cover;
    margin-right: 12px;
}
.course-info {
    display: flex;
    flex-direction: column;
    flex: 1;
}
.course-info h3 {
    margin: 0 0 5px 0;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.3;
}
.course-info .provider {
    color: #555;
    font-size: 13px;
    margin-bottom: 4px;
}
.course-info .meta {
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: center;
    gap: 4px;
}
.star {
    color: #f8b400;
    font-size: 14px;
}
.empty-message {
    text-align: center;
    color: #888;
    font-style: italic;
    padding: 20px 0;
}

/* Mobile Styles - Horizontal Carousel */
@media (max-width: 768px) {
    .main-container {
        display: flex;
        flex-direction: row;
        overflow-x: auto;
        gap: 15px;
        padding: 15px 20px;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: none;
    }
    
    .main-container::-webkit-scrollbar {
        display: none;
    }
    
    .section {
        flex: 0 0 auto;
        width: 85vw;
        scroll-snap-align: start;
        padding: 15px;
    }
    
    .header {
        font-size: 18px;
        padding: 0 0 12px 0;
    }
    
    .courses-container {
        gap: 10px;
    }
    
    .course-pill {
        padding: 10px 12px;
    }
    
    .course-pill img {
        width: 45px;
        height: 45px;
    }
    
    .course-info h3 {
        font-size: 15px;
    }
    
    .course-info .provider,
    .course-info .meta {
        font-size: 12px;
    }
    
    /* Carousel Indicators */
    .carousel-indicators {
        display: flex;
        justify-content: center;
        gap: 8px;
        padding: 15px 0;
    }
    
    .indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #ccc;
        transition: all 0.3s ease;
    }
    
    .indicator.active {
        background: #0066ff;
        width: 20px;
        border-radius: 4px;
    }
}

/* Tablet Styles */
@media (max-width: 1024px) and (min-width: 769px) {
    .main-container {
        padding: 20px 30px;
        gap: 15px;
    }
    
    .section {
        padding: 15px;
    }
    
    .header {
        font-size: 20px;
    }
    
    .course-pill img {
        width: 45px;
        height: 45px;
    }
    
    .course-info h3 {
        font-size: 15px;
    }
}
</style>
</head>
<body>

<?php
function showSection($title, $section, $conn) {
    echo "<div class='section'>
            <div class='header'>{$title} <span>→</span></div>
            <div class='courses-container'>";
    
    $courses = $conn->query("SELECT * FROM courses WHERE home_section2='$section' ORDER BY id DESC LIMIT 4");
    if($courses->num_rows == 0){
        echo "<div class='empty-message'>No courses added yet...</div>";
    } else {
        while($c = $courses->fetch_assoc()) {
            $image = !empty($c['image']) ? $c['image'] : 'https://via.placeholder.com/80';
            $rating = 4.8;
            echo "
            <a class='course-pill' href='course_detail.php?id={$c['id']}'>
                <img src='{$image}' alt='{$c['course_name']}'>
                <div class='course-info'>
                    <span class='provider'>{$c['company']}</span>
                    <h3>{$c['course_name']}</h3>
                    <div class='meta'>Professional Certificate · <span class='star'>★</span> {$rating}</div>
                </div>
            </a>";
        }
    }
    echo "</div></div>";
}
?>

<div class="main-container" id="mainCarousel">
    <?php
    showSection("Popular Courses", "popular", $conn);
    showSection("Skill Development", "skills", $conn);
    showSection("Free Courses", "free", $conn);
    ?>
</div>

<div class="carousel-indicators" id="carouselIndicators">
    <div class="indicator active" data-index="0"></div>
    <div class="indicator" data-index="1"></div>
    <div class="indicator" data-index="2"></div>
</div>

<script>
// Carousel functionality
const carousel = document.getElementById('mainCarousel');
const indicators = document.querySelectorAll('.indicator');

// Update indicators on scroll
carousel.addEventListener('scroll', () => {
    const scrollLeft = carousel.scrollLeft;
    const sectionWidth = carousel.querySelector('.section').offsetWidth;
    const gap = 15;
    const activeIndex = Math.round(scrollLeft / (sectionWidth + gap));
    
    indicators.forEach((indicator, index) => {
        if (index === activeIndex) {
            indicator.classList.add('active');
        } else {
            indicator.classList.remove('active');
        }
    });
});

// Click on indicators to scroll to specific section
indicators.forEach(indicator => {
    indicator.addEventListener('click', () => {
        const index = parseInt(indicator.getAttribute('data-index'));
        const sectionWidth = carousel.querySelector('.section').offsetWidth;
        const gap = 15;
        carousel.scrollTo({
            left: index * (sectionWidth + gap),
            behavior: 'smooth'
        });
    });
});
</script>

</body>
</html>