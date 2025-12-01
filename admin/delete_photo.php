<?php
include "../db_connect.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM photos WHERE id=$id");

echo "<script>alert('Photo Deleted.'); window.location='view_photos.php';</script>";
?>
