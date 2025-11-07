<?php
include 'db_connect.php';
session_start();

$enrollment_id = $_SESSION['enrollment_id'] ?? null;
if (!$enrollment_id) die("Login required.");

$student = $conn->query("SELECT * FROM students WHERE enrollment_id = '$enrollment_id'")->fetch_assoc();
$student_id = $student['student_id'];

// Fetch all declared exam results for this student
$sql = "
    SELECT e.exam_id, e.exam_name, e.total_questions, s.score
    FROM exam_submissions s
    JOIN exams e ON s.exam_id = e.exam_id
    WHERE s.student_id = $student_id AND e.result_declared = 1
    ORDER BY e.created_at DESC
";
$results = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Exam Results</title>
    <link rel="icon" type="image/png" href="image.png">
    <link rel="apple-touch-icon" href="image.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --light: #f3f4f6;
            --white: #ffffff;
            --gray: #6b7280;
            --radius: 10px;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 20px;
            background-color: var(--light);
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .header h2 {
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }

        .back-btn {
            text-decoration: none;
            color: var(--primary);
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .back-btn i { font-size: 14px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background-color: #f9fafb;
            color: var(--gray);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
        }

        tr:hover { background-color: #f3f4f6; }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray);
        }

        .empty-state i { font-size: 40px; margin-bottom: 10px; }

        .details-section {
            margin-top: 40px;
        }

        .details-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
            color: var(--primary);
        }

        .correct { color: green; font-weight: 600; }
        .wrong { color: red; font-weight: 600; }

        @media (max-width: 768px) {
            .header { flex-direction: column; align-items: flex-start; gap: 10px; }
            table, th, td { font-size: 14px; }
        }
    </style>
</head>
<body>

<div class="container">
    <!-- Header -->
    <div class="header">
        <h2>Hi, <?= htmlspecialchars($student['name']) ?> 👋 | Your Exam Results</h2>
        <a class="back-btn" href="../../test.php"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <!-- Exam Results -->
    <?php if ($results->num_rows > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Exam Name</th>
                    <th>Score</th>
                    <th>Total Questions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $results->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($row['exam_name']) ?></td>
                        <td><?= $row['score'] ?></td>
                        <td><?= $row['total_questions'] ?></td>
                    </tr>

                    <!-- Show detailed answers for this exam -->
                    <tr>
                        <td colspan="3">
                            <div class="details-section">
                                <h3>📘 Answer Review for <?= htmlspecialchars($row['exam_name']) ?></h3>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Your Answer</th>
                                            <th>Correct Answer</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $exam_id = $row['exam_id'];
                                        $q = $conn->query("
                                            SELECT q.question_text, q.correct_option, a.selected_option
                                            FROM exam_answers a
                                            JOIN exam_questions q ON a.question_id = q.question_id
                                            WHERE a.exam_id = $exam_id AND a.student_id = $student_id
                                        ");
                                        if ($q->num_rows > 0) {
                                            while ($ans = $q->fetch_assoc()) {
                                                $status = ($ans['selected_option'] == $ans['correct_option']) ? "<span class='correct'>✔ Correct</span>" : "<span class='wrong'>✘ Wrong</span>";
                                                echo "
                                                    <tr>
                                                        <td>".htmlspecialchars($ans['question_text'])."</td>
                                                        <td>".htmlspecialchars($ans['selected_option'])."</td>
                                                        <td>".htmlspecialchars($ans['correct_option'])."</td>
                                                        <td>$status</td>
                                                    </tr>
                                                ";
                                            }
                                        } else {
                                            echo "<tr><td colspan='4' style='text-align:center;color:gray;'>No answer data available</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="empty-state">
            <i class="fas fa-file-alt"></i>
            <h3>No Results Declared Yet</h3>
            <p>📭 Please check again later. Your exam results will appear here once declared.</p>
        </div>
    <?php } ?>
</div>

</body>
</html>
