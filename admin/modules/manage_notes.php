<?php
require '../../db_connect.php';
session_start();

$notes = $conn->query("
    SELECT module_notes.*, modules.module_name 
    FROM module_notes 
    JOIN modules ON module_notes.module_id = modules.module_id
    ORDER BY note_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Notes</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="container">
    <h2>Manage Notes</h2>

    <a href="upload_notes.php" class="btn">+ Upload Notes</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Module</th>
            <th>Title</th>
            <th>File</th>
            <th>Actions</th>
        </tr>

        <?php while ($n = $notes->fetch_assoc()) { ?>
        <tr>
            <td><?= $n['note_id'] ?></td>
            <td><?= $n['module_name'] ?></td>
            <td><?= $n['title'] ?></td>
            <td><a href="../../uploads/modules/<?= $n['module_id'] ?>/notes/<?= $n['file_path'] ?>" download>Download</a></td>

            <td>
                <a href="delete_note.php?id=<?= $n['note_id'] ?>&module=<?= $n['module_id'] ?>&file=<?= $n['file_path'] ?>"
                   class="btn danger small"
                   onclick="return confirm('Delete this note?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
