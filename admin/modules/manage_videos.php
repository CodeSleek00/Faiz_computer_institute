<?php
require '../../db_connect.php';
session_start();

$videos = $conn->query("
    SELECT module_videos.*, modules.module_name 
    FROM module_videos 
    JOIN modules ON module_videos.module_id = modules.module_id
    ORDER BY video_id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Videos</title>
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>

<div class="container">
    <h2>Manage Videos</h2>

    <a href="upload_videos.php" class="btn">+ Upload New Video</a>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Module</th>
            <th>Title</th>
            <th>Video</th>
            <th>Actions</th>
        </tr>

        <?php while ($v = $videos->fetch_assoc()) { ?>
        <tr>
            <td><?= $v['video_id'] ?></td>
            <td><?= $v['module_name'] ?></td>
            <td><?= $v['title'] ?></td>
            <td>
                <video width="150" controls>
                    <source src="../../uploads/modules/<?= $v['module_id'] ?>/videos/<?= $v['file_path'] ?>">
                </video>
            </td>
            <td>
                <a href="delete_video.php?id=<?= $v['video_id'] ?>&module=<?= $v['module_id'] ?>&file=<?= $v['file_path'] ?>" 
                   class="btn danger small"
                   onclick="return confirm('Delete this video?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
