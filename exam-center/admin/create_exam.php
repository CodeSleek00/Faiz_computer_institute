<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exam_name = trim($_POST['exam_name']);
    $total_questions = (int)$_POST['total_questions'];
    $marks = (int)$_POST['marks'];
    $duration = !empty($_POST['duration']) ? (int)$_POST['duration'] : NULL;
    $plan_type = $_POST['plan_type'];

    $stmt = $conn->prepare("INSERT INTO exams (exam_name, total_questions, duration, marks_per_question, plan_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiis", $exam_name, $total_questions, $duration, $marks, $plan_type);
    $stmt->execute();

    $exam_id = $stmt->insert_id;
    header("Location: add_question.php?exam_id=$exam_id&total=$total_questions");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Exam</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --light-bg: #f3f4f6;
            --white: #ffffff;
            --gray: #6b7280;
            --radius: 10px;
            --shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-bg);
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        .form-box {
            background: var(--white);
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: var(--primary);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="number"],
        select {
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: var(--radius);
            font-size: 15px;
            transition: border 0.2s;
        }

        input:focus, select:focus {
            border-color: var(--primary);
            outline: none;
        }

        button {
            background: var(--primary);
            color: var(--white);
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: var(--radius);
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #4338ca;
        }

        small {
            color: var(--gray);
            font-size: 13px;
        }

        @media (max-width: 480px) {
            .form-box { padding: 20px; }
            h2 { font-size: 20px; }
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>📝 Create New Exam</h2>
    <form method="POST">
        <input type="text" name="exam_name" placeholder="Enter Exam Name" required>
        <input type="number" name="total_questions" placeholder="Total Questions" min="1" required>
        <input type="number" name="marks" placeholder="Marks per Question" min="1" required>
        <input type="number" name="duration" placeholder="Duration (in minutes - optional)">
        
        <select name="plan_type" required>
            <option value="">Select Plan to Assign</option>
            <option value="basic">Basic Plan</option>
            <option value="custom">Custom Plan</option>
            <option value="advance">Advance Plan</option>
        </select>

        <button type="submit">➕ Add Questions</button>
        <small>Duration can be left blank for untimed exams.</small>
    </form>
</div>

</body>
</html>
