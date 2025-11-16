<?php
require '../../db_connect.php';
session_start();

// Fetch modules
$modules = $conn->query("SELECT * FROM modules ORDER BY module_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];

    // File upload
    $file = $_FILES['mock_file']['name'];
    $tmp = $_FILES['mock_file']['tmp_name'];

    $upload_path = "../../uploads/modules/$module_id/mocktests/";

    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    $filename = time() . "_" . $file;
    move_uploaded_file($tmp, $upload_path . $filename);

    // DB Insert
    $conn->query("
        INSERT INTO module_mocktests (module_id, title, file_path)
        VALUES ('$module_id', '$title', '$filename')
    ");

    header("Location: manage_mocktest.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Mock Test</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Upload Mock Test</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Select Module</label>
        <select name="module_id" required>
            <option value="">Choose Module</option>
            <?php while ($m = $modules->fetch_assoc()) { ?>
                <option value="<?= $m['module_id'] ?>"><?= $m['module_name'] ?></option>
            <?php } ?>
        </select>

        <label>Mock Test Title</label>
        <input type="text" name="title" required>

        <label>Choose File (PDF, DOCX, JPG, PNG)</label>
        <input type="file" name="mock_file" required>

        <button class="btn">Upload Mock Test</button>
    </form>
</div>

</body>
</html>
