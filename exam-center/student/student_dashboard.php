<?php
include 'db_connect.php';
session_start();

// Ensure login
$enrollment_id = $_SESSION['enrollment_id'] ?? null;
if (!$enrollment_id) {
    header("Location: login.php");
    exit;
}

// Fetch student
$stmt = $conn->prepare("SELECT * FROM students WHERE enrollment_id = ?");
$stmt->bind_param("s", $enrollment_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$student) die("Student not found.");

$student_id = intval($student['student_id']);

// Fetch assigned exams (via batch or direct)
$query = "
    SELECT DISTINCT e.*
    FROM exams e
    JOIN exam_assignments ea ON e.exam_id = ea.exam_id
    WHERE ea.student_id = ? 
       OR ea.batch_id IN (SELECT batch_id FROM student_batches WHERE student_id = ?)
    ORDER BY e.created_at DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $student_id, $student_id);
$stmt->execute();
$assigned = $stmt->get_result();

// Fetch all submissions once (for performance)
$submitted = [];
$sub = $conn->prepare("SELECT exam_id FROM exam_submissions WHERE student_id = ?");
$sub->bind_param("i", $student_id);
$sub->execute();
$res = $sub->get_result();
while ($r = $res->fetch_assoc()) $submitted[] = $r['exam_id'];
$sub->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Exams</title>
    <link rel="icon" type="image/png" href="image.png">
    <link rel="apple-touch-icon" href="image.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --light: #f3f4f6;
            --white: #fff;
            --gray: #6b7280;
            --success: #16a34a;
            --radius: 12px;
        }
        body {
            margin: 0;
            padding: 20px;
            background: var(--light);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }
        .container {
            max-width: 950px;
            margin: auto;
            background: var(--white);
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }
        .header h2 { margin: 0; font-size: 22px; font-weight: 600; }
        .back-btn {
            text-decoration: none; color: var(--primary);
            display: flex; align-items: center; gap: 6px;
        }
        .exam-card {
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            border-radius: var(--radius);
            padding: 20px;
            margin-bottom: 18px;
            transition: all 0.2s;
        }
        .exam-card:hover { background: #eef2ff; }
        .exam-title { font-weight: 600; font-size: 18px; color: var(--primary); }
        .exam-info { color: var(--gray); margin-bottom: 10px; font-size: 14px; }
        .start-btn {
            display: inline-block; background: var(--primary);
            color: var(--white); padding: 9px 16px;
            border-radius: 8px; text-decoration: none;
            font-weight: 500; transition: 0.2s;
        }
        .start-btn:hover { background: #4338ca; }
        .taken-msg {
            color: var(--success); font-weight: 500;
            display: flex; align-items: center; gap: 6px;
            font-size: 15px;
        }
        @media (max-width: 768px) {
            .header { flex-direction: column; align-items: flex-start; gap: 8px; }
            .exam-title { font-size: 16px; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Hi, <?= htmlspecialchars($student['name']) ?> 👋</h2>
        <a class="back-btn" href="../../test.php"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <h3>Your Assigned Exams</h3>

    <?php if ($assigned->num_rows > 0): ?>
        <?php while ($exam = $assigned->fetch_assoc()): ?>
            <div class="exam-card">
                <div class="exam-title"><?= htmlspecialchars($exam['exam_name']) ?></div>
                <div class="exam-info">
                    Questions: <?= $exam['total_questions'] ?> | Duration: <?= $exam['duration'] ?> mins
                </div>

                <?php if (in_array($exam['exam_id'], $submitted)): ?>
                    <div class="taken-msg">
                        <i class="fas fa-check-circle"></i> You have already submitted this exam.
                    </div>
                <?php else: ?>
                    <a href="take_exam.php?exam_id=<?= $exam['exam_id'] ?>" class="start-btn">
                        <i class="fas fa-pen"></i> Start Exam
                    </a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No exams have been assigned yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
<?php $conn->close(); ?>
