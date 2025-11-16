<?php
require '../../db_connect.php';
session_start();

$mocktests = $conn->query("
    SELECT module_mocktests.*, modules.module_name
    FROM module_mocktests
    JOIN modules ON module_mocktests.module_id = modules.module_id
    ORDER BY mock_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Mock Tests</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="container">
    <h2>Manage Mock Tests</h2>

    <a href="upload_mocktest.php" class="btn">+ Upload Mock Test</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Module</th>
            <th>Title</th>
            <th>File</th>
            <th>Actions</th>
        </tr>

        <?php while ($m = $mocktests->fetch_assoc()) { ?>
        <tr>
            <td><?= $m['mock_id'] ?></td>
            <td><?= $m['module_name'] ?></td>
            <td><?= $m['title'] ?></td>
            <td>
                <a href="../../uploads/modules/<?= $m['module_id'] ?>/mocktests/<?= $m['file_path'] ?>" download>
                    Download
                </a>
            </td>
            <td>
                <a href="delete_mocktest.php?id=<?= $m['mock_id'] ?>&module=<?= $m['module_id'] ?>&file=<?= $m['file_path'] ?>"
                   class="btn danger small"
                   onclick="return confirm('Delete this mock test?');">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
