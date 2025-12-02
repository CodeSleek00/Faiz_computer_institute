<?php
include 'db.php';

// Fetch all reviews
$reviews = mysqli_query($conn, "SELECT * FROM reviews ORDER BY id DESC");
$total_reviews = mysqli_num_rows($reviews);
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
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background-color: #fafafa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header h1 {
            font-size: 2.2rem;
            font-weight: 300;
            color: #222;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 1rem;
        }

        /* Review Form */
        .form-container {
            background: white;
            border-radius: 8px;
            padding: 30px;
            margin-bottom: 40px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #666;
        }

        textarea.form-input {
            min-height: 120px;
            resize: vertical;
        }

        .rating-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .stars {
            display: flex;
            gap: 2px;
        }

        .star {
            font-size: 28px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
            user-select: none;
        }

        .star.selected {
            color: #000;
        }

        .rating-text {
            font-size: 0.9rem;
            color: #888;
        }

        .submit-btn {
            width: 100%;
            padding: 14px;
            background: #000;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-btn:hover {
            background: #333;
        }

        /* Reviews Section */
        .reviews-header {
            margin-bottom: 25px;
        }

        .reviews-header h2 {
            font-size: 1.4rem;
            font-weight: 500;
            color: #222;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .review-count {
            font-size: 0.9rem;
            color: #888;
            font-weight: normal;
        }

        .review-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .reviewer-info h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .review-date {
            font-size: 0.85rem;
            color: #888;
        }

        .review-rating {
            font-size: 20px;
            color: #000;
        }

        .review-content {
            color: #444;
            line-height: 1.7;
        }

        .review-content p {
            margin-top: 10px;
        }

        .no-reviews {
            text-align: center;
            padding: 60px 20px;
            color: #888;
        }

        .no-reviews p {
            margin-top: 10px;
        }

        .average-rating {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        .rating-summary {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .average-number {
            font-size: 3rem;
            font-weight: 300;
        }

        .average-stars {
            font-size: 24px;
            margin-bottom: 4px;
        }

        .total-reviews {
            color: #888;
            font-size: 0.9rem;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 0.9rem;
        }

        /* Loading state for reviews */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid #ddd;
            border-top-color: #000;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-right: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Success message */
        .success-message {
            background: #f0f0f0;
            border-radius: 6px;
            padding: 15px;
            margin-top: 15px;
            display: none;
            animation: fadeIn 0.3s;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Responsive */
        @media (max-width: 600px) {
            .container {
                padding: 0;
            }
            
            .form-container,
            .review-card,
            .average-rating {
                padding: 20px;
                border-radius: 0;
                border-left: none;
                border-right: none;
                box-shadow: none;
            }
            
            .review-header {
                flex-direction: column;
                gap: 10px;
            }
            
            .rating-summary {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Student Reviews</h1>
            <p>Honest feedback from students</p>
        </div>

        <!-- Average Rating -->
        <?php
        $total_rating = 0;
        $rating_counts = [0, 0, 0, 0, 0];
        
        while ($row = mysqli_fetch_assoc($reviews)) {
            $total_rating += $row['rating'];
            $rating_counts[$row['rating']-1]++;
        }
        
        $average_rating = $total_reviews > 0 ? round($total_rating / $total_reviews, 1) : 0;
        mysqli_data_seek($reviews, 0);
        ?>
        
        <?php if ($total_reviews > 0): ?>
        <div class="average-rating">
            <div class="rating-summary">
                <div>
                    <div class="average-number"><?php echo $average_rating; ?></div>
                    <div class="total-reviews"><?php echo $total_reviews; ?> reviews</div>
                </div>
                <div>
                    <div class="average-stars">
                        <?php 
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= floor($average_rating) ? '★' : '☆';
                        }
                        ?>
                    </div>
                    <div class="rating-text">Average rating</div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Review Form -->
        <div class="form-container">
            <form action="submit_review.php" method="POST" id="reviewForm">
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input" placeholder="Your name" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Rating</label>
                    <div class="rating-container">
                        <div class="stars" id="starSelect">
                            <span class="star" data-value="1">☆</span>
                            <span class="star" data-value="2">☆</span>
                            <span class="star" data-value="3">☆</span>
                            <span class="star" data-value="4">☆</span>
                            <span class="star" data-value="5">☆</span>
                        </div>
                        <span class="rating-text" id="ratingText">Select rating</span>
                    </div>
                    <input type="hidden" name="rating" id="ratingValue" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Review</label>
                    <textarea name="review" class="form-input" placeholder="Share your honest experience..." required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Submit Review</button>
                <div id="successMessage" class="success-message">
                    Thank you for your review. It has been submitted successfully.
                </div>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="reviews-header">
            <h2>
                <span>Student Feedback</span>
                <?php if ($total_reviews > 0): ?>
                <span class="review-count">(<?php echo $total_reviews; ?>)</span>
                <?php endif; ?>
            </h2>
        </div>

        <?php if ($total_reviews > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($reviews)): ?>
                <div class="review-card">
                    <div class="review-header">
                        <div class="reviewer-info">
                            <h4><?= htmlspecialchars($row['student_name']) ?></h4>
                            <div class="review-date"><?= date("F j, Y", strtotime($row['created_at'])) ?></div>
                        </div>
                        <div class="review-rating">
                            <?= str_repeat("★", $row['rating']) ?>
                        </div>
                    </div>
                    <div class="review-content">
                        <p><?= htmlspecialchars($row['review_text']) ?></p>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-reviews">
                <p>No reviews yet. Be the first to share your experience.</p>
            </div>
        <?php endif; ?>

        <div class="footer">
            <p>© <?php echo date('Y'); ?> Student Reviews</p>
        </div>
    </div>

    <script>
        // Simple star rating
        const stars = document.querySelectorAll('.star');
        const ratingValue = document.getElementById('ratingValue');
        const ratingText = document.getElementById('ratingText');
        
        // Rating descriptions
        const descriptions = {
            1: 'Poor',
            2: 'Fair', 
            3: 'Good',
            4: 'Very Good',
            5: 'Excellent'
        };
        
        stars.forEach(star => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                ratingValue.value = value;
                
                // Update stars
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    s.textContent = starValue <= value ? '★' : '☆';
                    s.classList.toggle('selected', starValue <= value);
                });
                
                // Update text
                ratingText.textContent = descriptions[value] || 'Select rating';
            });
            
            // Hover effect
            star.addEventListener('mouseenter', () => {
                const hoverValue = star.getAttribute('data-value');
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    s.style.color = starValue <= hoverValue ? '#666' : '#ddd';
                });
            });
            
            star.addEventListener('mouseleave', () => {
                const selectedValue = ratingValue.value;
                stars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    s.style.color = starValue <= selectedValue ? '#000' : '#ddd';
                });
            });
        });
        
        // Form submission feedback
        const form = document.getElementById('reviewForm');
        const successMessage = document.getElementById('successMessage');
        
        form.addEventListener('submit', function(e) {
            // In real implementation, remove this and let form submit normally
            // This is just for visual feedback
            e.preventDefault();
            
            // Show success message
            successMessage.style.display = 'block';
            
            // Reset form
            setTimeout(() => {
                form.reset();
                stars.forEach(s => {
                    s.textContent = '☆';
                    s.classList.remove('selected');
                });
                ratingText.textContent = 'Select rating';
                ratingValue.value = '';
                
                // Hide message after 3 seconds
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            }, 500);
        });
    </script>
</body>
</html>