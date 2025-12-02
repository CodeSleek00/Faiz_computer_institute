<?php
include "db_connect.php";

$cat = isset($_GET['cat']) ? $_GET['cat'] : "Classroom";

$data = mysqli_query($conn, "SELECT * FROM photos WHERE category='$cat' ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Photo Gallery</title>
<style>
    body { font-family: Arial; padding: 20px; }
    .menu a { margin-right: 15px; text-decoration:none; background:#eee; padding:8px 12px; }
    .grid { display:flex; flex-wrap:wrap; gap:20px; margin-top:20px; }
    .box { width:250px; border:1px solid #ccc; padding:10px; }
    .box img { width:100%; height:180px; object-fit:cover; }
</style>
</head>
<body>

<h1>Photo Gallery</h1>

<div class="menu">
    <a href="?cat=Classroom">Classroom</a>
    <a href="?cat=Office">Office</a>
    <a href="?cat=Events">Events</a>
</div>

<h2><?php echo $cat; ?></h2>

<div class="grid">
<?php while($row = mysqli_fetch_assoc($data)){ ?>
    <div class="box">
        <img src="uploads/<?php echo $row['image_path']; ?>">
        <p><?php echo $row['caption']; ?></p>
    </div>
<?php } ?>
</div>

</body>
</html>
