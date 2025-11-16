<?php
require '../../db_connect.php';
session_start();

// Fetch modules list
$modules = $conn->query("SELECT * FROM modules ORDER BY module_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];

    // Video upload
    $file = $_FILES['video_file']['name'];
    $tmp = $_FILES['video_file']['tmp_name'];

    $upload_path = "../../uploads/modules/$module_id/videos/";

    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    $filename = time() . "_" . $file;
    move_uploaded_file($tmp, $upload_path . $filename);

    // Insert to DB
    $conn->query("
        INSERT INTO module_videos (module_id, title, file_path)
        VALUES ('$module_id', '$title', '$filename')
    ");

    header("Location: manage_videos.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Video</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Upload Video</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Select Module</label>
        <select name="module_id" required>
            <option value="">Choose Module</option>
            <?php while ($m = $modules->fetch_assoc()) { ?>
                <option value="<?= $m['module_id'] ?>"><?= $m['module_name'] ?></option>
            <?php } ?>
        </select>

        <label>Video Title</label>
        <input type="text" name="title" required>

        <label>Select Video File (MP4, MOV)</label>
        <input type="file" name="video_file" accept="video/*" required>

        <button class="btn">Upload Video</button>
    </form>
</div>

</body>
</html>
