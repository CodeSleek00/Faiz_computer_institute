<?php
require '../../db_connect.php';
session_start();

// Fetch modules
$modules = $conn->query("SELECT * FROM modules ORDER BY module_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $module_id = $_POST['module_id'];
    $title = $_POST['title'];

    // File upload
    $file = $_FILES['note_file']['name'];
    $tmp = $_FILES['note_file']['tmp_name'];

    $upload_path = "../../uploads/modules/$module_id/notes/";

    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
    }

    $filename = time() . "_" . $file;
    move_uploaded_file($tmp, $upload_path . $filename);

    // Insert DB
    $conn->query("
        INSERT INTO module_notes (module_id, title, file_path)
        VALUES ('$module_id', '$title', '$filename')
    ");

    header("Location: manage_notes.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Notes</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Upload Notes</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Select Module</label>
        <select name="module_id" required>
            <option value="">Choose Module</option>
            <?php while ($m = $modules->fetch_assoc()) { ?>
                <option value="<?= $m['module_id'] ?>"><?= $m['module_name'] ?></option>
            <?php } ?>
        </select>

        <label>Note Title</label>
        <input type="text" name="title" required>

        <label>Choose File (PDF, DOCX, JPG, PNG)</label>
        <input type="file" name="note_file" required>

        <button class="btn">Upload Notes</button>
    </form>
</div>

</body>
</html>
