<?php
include 'db.php';

// Fetch all reviews
$reviews = mysqli_query($conn, "SELECT * FROM reviews ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reviews | Feedback Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4a6bff;
            --primary-light: #eef1ff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --light-bg: #f8f9fa;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7ff 0%, #f0f2ff 100%);
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding: 20px;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 2.8rem;
            margin-bottom: 10px;
            background: linear-gradient(90deg, #4a6bff, #6a11cb);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .header p {
            color: var(--secondary-color);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .content-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 50px;
        }

        @media (max-width: 900px) {
            .content-wrapper {
                grid-template-columns: 1fr;
            }
        }

        .review-form-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .review-form-container:hover {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .form-title {
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-title i {
            color: var(--primary-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 14px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 107, 255, 0.2);
        }

        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: 5px;
            margin: 10px 0 20px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2.2rem;
            color: #ddd;
            cursor: pointer;
            transition: var(--transition);
        }

        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: var(--warning-color);
        }

        .rating-text {
            margin-top: 5px;
            font-size: 0.9rem;
            color: var(--secondary-color);
        }

        .submit-btn {
            background: linear-gradient(90deg, #4a6bff, #6a11cb);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 16px 30px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(90deg, #3a5bef, #5a0bcb);
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(74, 107, 255, 0.3);
        }

        .reviews-container {
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 30px;
            box-shadow: var(--shadow);
            max-height: 700px;
            overflow-y: auto;
        }

        .reviews-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid var(--primary-light);
        }

        .reviews-header h2 {
            font-size: 1.8rem;
            color: #333;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .reviews-count {
            background: var(--primary-light);
            color: var(--primary-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        .review-card {
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 5px solid var(--primary-color);
            background: var(--light-bg);
            transition: var(--transition);
        }

        .review-card:hover {
            transform: translateX(5px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .reviewer-name {
            font-weight: 700;
            font-size: 1.2rem;
            color: #333;
        }

        .review-date {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .review-rating {
            color: var(--warning-color);
            font-size: 1.3rem;
            margin: 8px 0;
            letter-spacing: 2px;
        }

        .review-text {
            margin-top: 10px;
            color: #555;
            line-height: 1.7;
        }

        .no-reviews {
            text-align: center;
            padding: 40px 20px;
            color: var(--secondary-color);
        }

        .no-reviews i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #ddd;
        }

        /* Scrollbar styling */
        .reviews-container::-webkit-scrollbar {
            width: 8px;
        }

        .reviews-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .reviews-container::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 10px;
        }

        .stats-bar {
            display: flex;
            justify-content: space-around;
            background: var(--white);
            border-radius: var(--border-radius);
            padding: 20px;
            margin-bottom: 40px;
            box-shadow: var(--shadow);
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            display: none;
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .pulse {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-comments"></i> Student Feedback Portal</h1>
            <p>Share your learning experience and read reviews from fellow students. Your feedback helps us improve.</p>
        </div>

        <!-- Stats Bar -->
        <?php
        $total_reviews = mysqli_num_rows($reviews);
        mysqli_data_seek($reviews, 0); // Reset pointer to calculate average
        
        $total_rating = 0;
        $rating_counts = [0, 0, 0, 0, 0]; // For counting each star rating
        
        while ($row = mysqli_fetch_assoc($reviews)) {
            $total_rating += $row['rating'];
            $rating_counts[$row['rating']-1]++; // Increment count for this rating
        }
        
        $average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;
        mysqli_data_seek($reviews, 0); // Reset pointer again for displaying reviews
        ?>
        
        <div class="stats-bar">
            <div class="stat-item">
                <div class="stat-value"><?php echo $total_reviews; ?></div>
                <div class="stat-label">Total Reviews</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo $average_rating; ?> <span style="color: var(--warning-color); font-size: 1.5rem;">★</span></div>
                <div class="stat-label">Average Rating</div>
            </div>
            <div class="stat-item">
                <div class="stat-value"><?php echo $rating_counts[4]; ?></div>
                <div class="stat-label">5-Star Reviews</div>
            </div>
        </div>

        <div class="content-wrapper">
            <!-- Review Form -->
            <div class="review-form-container">
                <h2 class="form-title"><i class="fas fa-pen-alt"></i> Write Your Review</h2>
                
                <div id="successMessage" class="success-message">
                    <i class="fas fa-check-circle"></i> Thank you! Your review has been submitted successfully.
                </div>
                
                <form action="submit_review.php" method="POST" id="reviewForm">
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Your Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-star"></i> Select Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" required>
                            <label for="star5" title="5 stars">★</label>
                            <input type="radio" id="star4" name="rating" value="4">
                            <label for="star4" title="4 stars">★</label>
                            <input type="radio" id="star3" name="rating" value="3">
                            <label for="star3" title="3 stars">★</label>
                            <input type="radio" id="star2" name="rating" value="2">
                            <label for="star2" title="2 stars">★</label>
                            <input type="radio" id="star1" name="rating" value="1">
                            <label for="star1" title="1 star">★</label>
                        </div>
                        <div class="rating-text" id="ratingText">Click on a star to rate</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="review"><i class="fas fa-comment-dots"></i> Your Review</label>
                        <textarea id="review" name="review" class="form-control" rows="5" placeholder="Share your experience, what you liked, and suggestions for improvement..." required></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn pulse">
                        <i class="fas fa-paper-plane"></i> Submit Review
                    </button>
                </form>
            </div>

            <!-- Reviews List -->
            <div class="reviews-container">
                <div class="reviews-header">
                    <h2><i class="fas fa-list-alt"></i> Student Reviews</h2>
                    <div class="reviews-count"><?php echo $total_reviews; ?> Reviews</div>
                </div>
                
                <?php if ($total_reviews > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($reviews)): ?>
                        <div class="review-card">
                            <div class="review-header">
                                <div class="reviewer-name"><?= htmlspecialchars($row['student_name']) ?></div>
                                <div class="review-date"><?= date("M d, Y", strtotime($row['created_at'])) ?></div>
                            </div>
                            <div class="review-rating">
                                <?= str_repeat("★", $row['rating']) . str_repeat("☆", 5 - $row['rating']) ?>
                                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">(<?= $row['rating'] ?>/5)</span>
                            </div>
                            <div class="review-text">
                                <?= htmlspecialchars($row['review_text']) ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="no-reviews">
                        <i class="far fa-comment-dots"></i>
                        <h3>No Reviews Yet</h3>
                        <p>Be the first to share your experience!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="footer">
            <p>Student Feedback Portal &copy; <?php echo date('Y'); ?> | All reviews are moderated to ensure quality.</p>
        </div>
    </div>

    <script>
        // Star rating interaction
        const starInputs = document.querySelectorAll('.star-rating input');
        const ratingText = document.getElementById('ratingText');
        
        // Rating descriptions
        const ratingDescriptions = {
            1: "Poor - Needs significant improvement",
            2: "Fair - Has room for improvement",
            3: "Good - Met expectations",
            4: "Very Good - Exceeded expectations",
            5: "Excellent - Outstanding experience"
        };
        
        starInputs.forEach(input => {
            input.addEventListener('change', function() {
                const ratingValue = this.value;
                ratingText.textContent = ratingDescriptions[ratingValue];
                ratingText.style.color = "#333";
                ratingText.style.fontWeight = "600";
            });
            
            input.addEventListener('mouseover', function() {
                const hoverValue = this.value;
                ratingText.textContent = ratingDescriptions[hoverValue];
            });
        });
        
        // Form submission simulation (for demo purposes)
        const reviewForm = document.getElementById('reviewForm');
        const successMessage = document.getElementById('successMessage');
        
        reviewForm.addEventListener('submit', function(e) {
            // In a real application, this would be handled by submit_review.php
            // This is just for visual feedback in the demo
            e.preventDefault();
            
            // Show success message
            successMessage.style.display = 'block';
            
            // Reset form
            reviewForm.reset();
            ratingText.textContent = "Click on a star to rate";
            ratingText.style.color = "";
            ratingText.style.fontWeight = "";
            
            // Hide success message after 5 seconds
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 5000);
            
            // In real implementation, remove the e.preventDefault() above
            // and let the form submit normally to submit_review.php
        });
        
        // Add some interactivity to review cards
        const reviewCards = document.querySelectorAll('.review-card');
        reviewCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.borderLeftColor = "#6a11cb";
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.borderLeftColor = "var(--primary-color)";
            });
        });
    </script>
</body>
</html>