<?php
include 'db.php';

$name = $_POST['name'];
$rating = $_POST['rating'];
$review = $_POST['review'];

$sql = "INSERT INTO reviews (student_name, rating, review_text) VALUES ('$name', '$rating', '$review')";
mysqli_query($conn, $sql);

header("Location: reviews.php?success=1");
exit;
?>
