<?php
require '../../db_connect.php';
session_start();

$id = $_GET['id'];
$module = $conn->query("SELECT * FROM modules WHERE module_name = '$id'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['module_name'];
    $desc = $_POST['description'];

    $conn->query("UPDATE modules SET module_name='$name', description='$desc' WHERE module_id='$id'");

    header("Location: manage_modules.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Module</title>
<link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="form-container">
    <h2>Edit Module</h2>

    <form method="POST">
        <label>Module Name</label>
        <input type="text" name="module_name" value="<?= $module['module_name'] ?>" required>

        <label>Description</label>
        <textarea name="module_description"><?= $module['module_description'] ?></textarea>

        <button type="submit" class="btn">Update Module</button>
    </form>
</div>

</body>
</html>
