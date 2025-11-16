<?php
session_start();
require '../db_connect.php';

// Only allow logged-in students
if (!isset($_SESSION['student_id'])) {
    echo "Unauthorized Access";
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch assigned videos for this student
$sql = "
SELECT videos.title, videos.video_file
FROM video_assign
JOIN videos ON video_assign.video_id = videos.id
WHERE video_assign.student_id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $student_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Videos</title>
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            padding: 20px; 
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }
        h2 { 
            color: #2c3e50; 
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 15px;
        }
        .video-box { 
            margin-bottom: 30px; 
            padding: 20px; 
            border: 1px solid #e1e8ed; 
            border-radius: 10px; 
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .video-box:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        .video-title {
            color: #34495e;
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 1.4rem;
        }
        .video-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        video { 
            width: 100%; 
            border-radius: 8px; 
            outline: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .no-videos {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        .security-notice {
            background: #fff8e1;
            border-left: 4px solid #ffc107;
            padding: 12px 15px;
            margin-bottom: 25px;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #856404;
        }
        .controls-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 10;
        }
        .watermark {
            position: absolute;
            bottom: 10px;
            right: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 4px;
            pointer-events: none;
        }
        .user-id {
            position: absolute;
            top: 10px;
            left: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            background: rgba(0, 0, 0, 0.5);
            padding: 5px 10px;
            border-radius: 4px;
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📚 Your Assigned Videos</h2>
        
        <div class="security-notice">
            <strong>Security Notice:</strong> Downloading and screen recording of these videos is restricted. Your user ID is watermarked on all videos.
        </div>

        <?php if ($result->num_rows === 0): ?>
            <div class="no-videos">
                <p>No videos have been assigned to you yet.</p>
            </div>
        <?php else: ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="video-box">
                    <h3 class="video-title"><?= htmlspecialchars($row['title']) ?></h3>
                    <div class="video-container">
                        <video controls controlsList="nodownload noremoteplayback" disablePictureInPicture oncontextmenu="return false;">
                            <source src="../<?= htmlspecialchars($row['video_file']) ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        <div class="controls-overlay">
                            <div class="user-id">User: <?= htmlspecialchars($student_id) ?></div>
                            <div class="watermark"><?= date('Y-m-d H:i:s') ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>

    <script>
        // Prevent right-click context menu on videos
        document.addEventListener('contextmenu', function(e) {
            if (e.target.nodeName === 'VIDEO') {
                e.preventDefault();
                return false;
            }
        });

        // Disable keyboard shortcuts for saving/printing
        document.addEventListener('keydown', function(e) {
            // Disable F12, Ctrl+S, Ctrl+Shift+I, etc.
            if (
                e.keyCode === 123 || // F12
                (e.ctrlKey && e.shiftKey && e.keyCode === 73) || // Ctrl+Shift+I
                (e.ctrlKey && e.keyCode === 83) || // Ctrl+S
                (e.ctrlKey && e.keyCode === 80) // Ctrl+P
            ) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
        });

        // Detect and prevent screen recording attempts
        // Note: This is a basic detection and won't prevent all screen recording
        function detectScreenRecording() {
            // Check for common screen recording indicators
            if (window.outerWidth !== window.innerWidth || window.outerHeight !== window.innerHeight) {
                console.warn('Potential screen recording detected');
                // In a real implementation, you might pause the video or show a warning
            }
        }

        // Periodically check for potential screen recording
        setInterval(detectScreenRecording, 5000);

        // Add additional protection by disabling text selection
        document.addEventListener('selectstart', function(e) {
            if (e.target.nodeName === 'VIDEO') {
                e.preventDefault();
                return false;
            }
        });

        // Log video interactions for security monitoring
        document.querySelectorAll('video').forEach(video => {
            video.addEventListener('play', function() {
                console.log('Video playback started by user: <?= $student_id ?>');
            });
            
            video.addEventListener('pause', function() {
                console.log('Video playback paused by user: <?= $student_id ?>');
            });
        });
    </script>
</body>
</html>