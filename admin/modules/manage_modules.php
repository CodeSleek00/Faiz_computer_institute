<?php
require '../../db_connect.php';
session_start();

// Fetch all modules
$modules = $conn->query("SELECT * FROM module_sections ORDER BY module_id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Modules</title>
<link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="container">
    <h2>Manage Modules</h2>

    <a href="add_module.php" class="btn">+ Add New Module</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Module Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $modules->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['module_name'] ?></td>
            <td><?= $row['description'] ?></td>

            <td>
                <a href="edit_module.php?id=<?= $row['module_id'] ?>" class="btn small">Edit</a>
                <a href="delete_module.php?id=<?= $row['module_id'] ?>" class="btn danger small"
                   onclick="return confirm('Are you sure you want to delete this module?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
