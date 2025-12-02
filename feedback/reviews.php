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
    <title>Student Reviews</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            margin: 0;
            padding: 20px;
        }
        .review-container {
            max-width: 700px;
            margin: auto;
        }
        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        .review-box {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
        }
        .stars span {
            font-size: 25px;
            cursor: pointer;
            color: #ccc;
        }
        .stars .selected {
            color: gold;
        }
        .review-item {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
        }
        .rating {
            color: gold;
            font-size: 20px;
        }
    </style>
</head>
<body>

<div class="review-container">

    <h2>Write Your Review</h2>

    <form action="submit_review.php" method="POST" class="review-box">
        <label>Your Name</label>
        <input type="text" name="name" required style="width:100%; padding:8px; margin-top:5px; margin-bottom:10px;">

        <label>Select Rating</label>
        <div class="stars" id="starSelect">
            <span data-value="1">★</span>
            <span data-value="2">★</span>
            <span data-value="3">★</span>
            <span data-value="4">★</span>
            <span data-value="5">★</span>
        </div>
        <input type="hidden" name="rating" id="ratingValue" required>

        <label>Your Review</label>
        <textarea name="review" required style="width:100%; height:120px; padding:8px;"></textarea>

        <button type="submit" style="margin-top:10px; width:100%; padding:10px; background:blue; color:white; border:none; cursor:pointer;">
            Submit Review
        </button>
    </form>

    <h2>Student Reviews</h2>

    <?php while ($row = mysqli_fetch_assoc($reviews)) { ?>
        <div class="review-item">
            <strong><?= $row['student_name'] ?></strong><br>
            <span class="rating"><?= str_repeat("★", $row['rating']) ?></span>
            <p><?= $row['review_text'] ?></p>
            <small>Posted on <?= $row['created_at'] ?></small>
        </div>
    <?php } ?>

</div>

<script>
const stars = document.querySelectorAll(".stars span");
const ratingValue = document.getElementById("ratingValue");

stars.forEach(star => {
    star.addEventListener("click", () => {
        let val = star.getAttribute("data-value");
        ratingValue.value = val;

        stars.forEach(s => s.classList.remove("selected"));
        for (let i = 0; i < val; i++) stars[i].classList.add("selected");
    });
});
</script>

</body>
</html>
