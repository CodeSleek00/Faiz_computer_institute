<?php // feedback.php ?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Student Feedback</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
<h1>Student Feedback</h1>


<div class="card form-card">
<h2>Write your feedback</h2>
<form id="feedbackForm">
<label for="student_name">Name</label>
<input type="text" id="student_name" name="student_name" required placeholder="Your name">


<label>Rating</label>
<div class="star-rating" id="starRating">
<input type="radio" name="rating" id="r5" value="5"><label for="r5">★</label>
<input type="radio" name="rating" id="r4" value="4"><label for="r4">★</label>
<input type="radio" name="rating" id="r3" value="3"><label for="r3">★</label>
<input type="radio" name="rating" id="r2" value="2"><label for="r2">★</label>
<input type="radio" name="rating" id="r1" value="1"><label for="r1">★</label>
</div>


<label for="comment">Feedback</label>
<textarea id="comment" name="comment" rows="4" required placeholder="Write your feedback..."></textarea>


<button type="submit" class="btn">Submit Feedback</button>
</form>
<div id="msg" class="msg"></div>
</div>


<div class="card list-card">
<h2>All Feedbacks</h2>
<div id="feedbackList">Loading feedbacks...</div>
</div>
</div>


<script src="script.js"></script>
</body>
</html>