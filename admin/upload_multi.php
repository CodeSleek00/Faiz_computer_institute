<?php
include "../db_connect.php";

$category = $_POST['category'];
$caption = $_POST['caption'];

$files = $_FILES['photos'];

for($i = 0; $i < count($files['name']); $i++) {

    $file_name = time() . "_" . $files['name'][$i];
    $tmp_name = $files['tmp_name'][$i];

    $target_dir = "../uploads/";
    $target_file = $target_dir . $file_name;

    if(move_uploaded_file($tmp_name, $target_file)) {

        $sql = "INSERT INTO photos(category, image_path, caption)
                VALUES ('$category', '$file_name', '$caption')";
        mysqli_query($conn, $sql);
    }
}

echo "<script>alert('All photos uploaded successfully!'); window.location='add_photo.php';</script>";
?>
