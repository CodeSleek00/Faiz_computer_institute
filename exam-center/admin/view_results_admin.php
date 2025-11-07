<?php
include 'db_connect.php';

// Validate exam_id
$exam_id = isset($_GET['exam_id']) ? intval($_GET['exam_id']) : 0;
if ($exam_id <= 0) {
    die("<h3>Invalid Exam ID</h3>");
}

// Fetch exam details safely
$stmt = $conn->prepare("SELECT * FROM exams WHERE exam_id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$exam = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$exam) {
    die("<h3>Exam not found</h3>");
}

// Fetch all submissions with student info
$stmt = $conn->prepare("
    SELECT s.*, st.name, st.enrollment_id 
    FROM exam_submissions s
    JOIN students st ON s.student_id = st.student_id
    WHERE s.exam_id = ?
    ORDER BY s.score DESC
");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$results = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Results - <?= htmlspecialchars($exam['exam_name']) ?></title>
    <link rel="icon" type="image/png" href="image.png">
    <link rel="apple-touch-icon" href="image.png">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #eef1f5;
            padding: 40px;
        }
        .container {
            max-width: 950px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 25px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        tr:hover {
            background-color: #f3f4f6;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 18px;
            background: #4f46e5;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }
        .back-btn:hover {
            background: #4338ca;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>🧾 Results - <?= htmlspecialchars($exam['exam_name']) ?></h2>
    <table>
        <tr>
            <th>Student Name</th>
            <th>Enrollment ID</th>
            <th>Score</th>
            <th>Submitted On</th>
        </tr>
        <?php if ($results->num_rows > 0): ?>
            <?php while ($r = $results->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= htmlspecialchars($r['enrollment_id']) ?></td>
                    <td><?= htmlspecialchars($r['score']) ?> / <?= htmlspecialchars($exam['total_questions']) ?></td>
                    <td><?= date('d M Y, h:i A', strtotime($r['submitted_at'])) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4" style="text-align:center; color:gray;">No submissions yet.</td></tr>
        <?php endif; ?>
    </table>
    <a href="exam_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
