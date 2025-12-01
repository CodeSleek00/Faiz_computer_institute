<?php
include "../db_connect.php";
$result = mysqli_query($conn, "SELECT * FROM photos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>All Photos</title>
<style>
    img { width: 150px; height:100px; object-fit:cover; margin:10px; }
    .photo-box { display:inline-block; text-align:center; border:1px solid #ccc; padding:10px; margin:10px; }
    a.delete { color:red; text-decoration:none; }
</style>
</head>
<body>
<h2>All Uploaded Photos</h2>

<?php while($row = mysqli_fetch_assoc($result)){ ?>
    <div class="photo-box">
        <img src="../uploads/<?php echo $row['image_path']; ?>">
        <p><b><?php echo $row['category']; ?></b></p>
        <p><?php echo $row['caption']; ?></p>
        <a class="delete" href="delete_photo.php?id=<?php echo $row['id']; ?>">Delete</a>
    </div>
<?php } ?>

</body>
</html>
