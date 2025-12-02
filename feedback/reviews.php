<?php
include 'db.php';

// Fetch all reviews
$reviews = mysqli_query($conn, "SELECT * FROM reviews ORDER BY id DESC");
$total_reviews = mysqli_num_rows($reviews);
mysqli_data_seek($reviews, 0);

// Calculate average rating
$total_rating = 0;
$rating_counts = [0, 0, 0, 0, 0];

while ($row = mysqli_fetch_assoc($reviews)) {
    $total_rating += $row['rating'];
    $rating_counts[$row['rating']-1]++;
}

$average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;
mysqli_data_seek($reviews, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reviews</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 50px;
            padding: 30px 0;
        }

        .header h1 {
            font-size: 2.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .header p {
            color: #666;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Stats Section */
        .stats-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 50px;
            flex-wrap: wrap;
        }

        .stat-card {
            background: white;
            padding: 25px 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            text-align: center;
            min-width: 200px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 3.2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #636e72;
            font-size: 1rem;
            font-weight: 500;
        }

        .average-stars {
            color: #ffc107;
            font-size: 2rem;
            margin: 10px 0;
            letter-spacing: 2px;
        }

        /* Form Section */
        .form-section {
            background: white;
            border-radius: 20px;
            padding: 40px;
            margin-bottom: 60px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.08);
        }

        .form-title {
            font-size: 1.8rem;
            color: #2d3436;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .form-title:before {
            content: "✍️";
            font-size: 1.5rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-size: 0.95rem;
            color: #495057;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #4dabf7;
            background: white;
            box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.1);
        }

        .full-width {
            grid-column: 1 / -1;
        }

        textarea.form-input {
            min-height: 140px;
            resize: vertical;
            line-height: 1.5;
        }

        .rating-group {
            margin-bottom: 25px;
        }

        .stars-container {
            display: flex;
            gap: 6px;
            margin: 10px 0;
        }

        .rating-star {
            font-size: 2.5rem;
            color: #e9ecef;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }

        .rating-star:hover {
            color: #ffd43b;
            transform: scale(1.1);
        }

        .rating-star.active {
            color: #ffc107;
        }

        .rating-text {
            font-size: 0.95rem;
            color: #6c757d;
            margin-top: 8px;
            font-weight: 500;
        }

        .submit-btn {
            background: linear-gradient(135deg, #4dabf7 0%, #339af0 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px 40px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            grid-column: 1 / -1;
            justify-self: start;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #339af0 0%, #228be6 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(51, 154, 240, 0.3);
        }

        .submit-btn:before {
            content: "📝";
        }

        /* Reviews Grid */
        .reviews-section {
            margin-bottom: 60px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 2rem;
            color: #2d3436;
            font-weight: 700;
        }

        .section-title:before {
            content: "⭐";
            margin-right: 10px;
        }

        .reviews-count {
            background: #e3f2fd;
            color: #1971c2;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
        }

        /* Cards Grid */
        .reviews-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 30px;
        }

        .review-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid #f1f3f4;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .review-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
            border-color: #e9ecef;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .reviewer-info {
            flex: 1;
        }

        .reviewer-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2d3436;
            margin-bottom: 5px;
        }

        .review-date {
            font-size: 0.85rem;
            color: #868e96;
            font-weight: 500;
        }

        .review-rating {
            color: #ffc107;
            font-size: 1.5rem;
            letter-spacing: 2px;
        }

        .review-content {
            color: #495057;
            line-height: 1.7;
            flex: 1;
            font-size: 1rem;
        }

        .review-content p {
            margin: 0;
        }

        .card-footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #f1f3f4;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .review-id {
            color: #adb5bd;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .verified-badge {
            background: #d3f9d8;
            color: #2b8a3e;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* No Reviews */
        .no-reviews {
            text-align: center;
            padding: 80px 20px;
            grid-column: 1 / -1;
        }

        .no-reviews-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .no-reviews h3 {
            color: #868e96;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .no-reviews p {
            color: #adb5bd;
            font-size: 1.1rem;
        }

        /* Success Message */
        .success-message {
            background: #d3f9d8;
            color: #2b8a3e;
            padding: 16px 24px;
            border-radius: 12px;
            margin-top: 20px;
            display: none;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            border: 1px solid #b2f2bb;
            grid-column: 1 / -1;
        }

        .success-message:before {
            content: "✅";
            font-size: 1.2rem;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 80px;
            padding-top: 30px;
            border-top: 1px solid #e9ecef;
            color: #868e96;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .reviews-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 0 10px;
            }
            
            .header {
                margin-bottom: 30px;
            }
            
            .header h1 {
                font-size: 2.2rem;
            }
            
            .stats-container {
                gap: 20px;
            }
            
            .stat-card {
                min-width: 160px;
                padding: 20px;
            }
            
            .form-section {
                padding: 25px;
            }
            
            .reviews-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .section-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
        }

        @media (max-width: 480px) {
            .stats-container {
                flex-direction: column;
                align-items: center;
            }
            
            .stat-card {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Student Reviews</h1>
            <p>Real feedback from real students. Share your experience and help others make informed decisions.</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-value"><?php echo $total_reviews; ?></div>
                <div class="stat-label">Total Reviews</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value"><?php echo $average_rating; ?>/5</div>
                <div class="average-stars">
                    <?php 
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= floor($average_rating) ? '★' : '☆';
                    }
                    ?>
                </div>
                <div class="stat-label">Average Rating</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value"><?php echo $rating_counts[4]; ?></div>
                <div class="stat-label">5-Star Reviews</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-value"><?php echo date('Y'); ?></div>
                <div class="stat-label">Active Year</div>
            </div>
        </div>

        <!-- Review Form -->
       
<div class="form-section">
    <h2 class="form-title">Share Your Experience</h2>
    
    <form action="submit_review.php" method="POST" id="reviewForm">
        <div class="form-grid">

            <div class="form-group">
                <label class="form-label">Your Name</label>
                <input type="text" name="name" class="form-input" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label class="form-label">Email (Optional)</label>
                <input type="email" name="email" class="form-input" placeholder="email@example.com">
            </div>

            <div class="form-group full-width">
                <label class="form-label">Your Rating</label>

                <div class="stars-container" id="starSelect">
                    <span class="rating-star" data-value="1">★</span>
                    <span class="rating-star" data-value="2">★</span>
                    <span class="rating-star" data-value="3">★</span>
                    <span class="rating-star" data-value="4">★</span>
                    <span class="rating-star" data-value="5">★</span>
                </div>

                <div class="rating-text" id="ratingText">
                    Click stars to rate your experience
                </div>

                <input type="hidden" name="rating" id="ratingValue" required>
            </div>

            <div class="form-group full-width">
                <label class="form-label">Your Review</label>
                <textarea name="review" class="form-input" placeholder="Tell us about your experience..." required></textarea>
            </div>

            <button type="submit" class="submit-btn">Submit Your Review</button>

            <div id="successMessage" class="success-message">
                Thank you for your review! Your feedback helps others.
            </div>
        </div>
    </form>
</div>


        <!-- Reviews Grid -->
        <div class="reviews-section">
            <div class="section-header">
                <h2 class="section-title">Student Feedback</h2>
                <div class="reviews-count"><?php echo $total_reviews; ?> Reviews</div>
            </div>
            
            <div class="reviews-grid">
                <?php if ($total_reviews > 0): ?>
                    <?php 
                    $counter = 0;
                    while ($row = mysqli_fetch_assoc($reviews)): 
                        $counter++;
                    ?>
                        <div class="review-card">
                            <div class="card-header">
                                <div class="reviewer-info">
                                    <div class="reviewer-name"><?= htmlspecialchars($row['student_name']) ?></div>
                                    <div class="review-date"><?= date("M d, Y", strtotime($row['created_at'])) ?></div>
                                </div>
                                <div class="review-rating">
                                    <?= str_repeat("★", $row['rating']) ?>
                                </div>
                            </div>
                            
                            <div class="review-content">
                                <p><?= htmlspecialchars($row['review_text']) ?></p>
                            </div>
                            
                            <div class="card-footer">
                                <div class="review-id">#<?= $counter ?></div>
                                <div class="verified-badge">Verified Student</div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-reviews">
                        <div class="no-reviews-icon">💬</div>
                        <h3>No Reviews Yet</h3>
                        <p>Be the first to share your experience!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© <?php echo date('Y'); ?> Student Reviews Platform. All reviews are submitted by verified students.</p>
        </div>
    </div>

    <script>
        // ------ STAR RATING SCRIPT ------
const stars = document.querySelectorAll(".rating-star");
const ratingValue = document.getElementById("ratingValue");
const ratingText = document.getElementById("ratingText");

stars.forEach(star => {
    star.addEventListener("click", () => {
        let value = star.getAttribute("data-value");
        ratingValue.value = value;

        // Active stars fill
        stars.forEach(s => s.classList.remove("active"));
        for (let i = 0; i < value; i++) {
            stars[i].classList.add("active");
        }

        ratingText.textContent = `You selected ${value} star${value > 1 ? "s" : ""}`;
    });
});

// ------ SUCCESS MESSAGE -------
document.getElementById("reviewForm").addEventListener("submit", function () {
    document.getElementById("successMessage").style.display = "block";
});
    </script>
</body>
</html>