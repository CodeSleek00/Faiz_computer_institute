<?php
include "../db_connect.php";

$category = $_POST['category'];
$caption = $_POST['caption'];

$target_dir = "../uploads/";
$file_name = time() . "_" . basename($_FILES["photo"]["name"]);
$target_file = $target_dir . $file_name;

if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){

    $sql = "INSERT INTO photos(category, image_path, caption)
            VALUES ('$category', '$file_name', '$caption')";

    mysqli_query($conn, $sql);

    echo "<script>alert('Photo uploaded successfully!'); window.location='add_photo.php';</script>";
} else {
    echo "Error uploading file.";
}
?>
