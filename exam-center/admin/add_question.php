<?php
include 'db_connect.php';

$exam_id = $_GET['exam_id'] ?? 0;
$total = $_GET['total'] ?? 0;
$q_num = $_GET['q_num'] ?? 1;

if (!$exam_id || !$total) {
    die("Invalid Exam Information");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']);
    $a = trim($_POST['option_a']);
    $b = trim($_POST['option_b']);
    $c = trim($_POST['option_c']);
    $d = trim($_POST['option_d']);
    $correct = strtolower(trim($_POST['correct_option']));

    // ✅ Validation
    if (!in_array($correct, ['a', 'b', 'c', 'd'])) {
        echo "<script>alert('Correct option must be a, b, c, or d');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO exam_questions 
            (exam_id, question, option_a, option_b, option_c, option_d, correct_option) 
            VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $exam_id, $question, $a, $b, $c, $d, $correct);
        $stmt->execute();

        // ✅ Redirect
        if ($q_num < $total) {
            header("Location: add_question.php?exam_id=$exam_id&total=$total&q_num=" . ($q_num + 1));
        } else {
            header("Location: assign_exam.php?exam_id=$exam_id");
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Exam Question</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #16a34a;
            --light-bg: #f3f4f6;
            --white: #ffffff;
            --gray: #6b7280;
            --radius: 10px;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
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
            max-width: 750px;
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

        label {
            font-weight: 500;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: var(--radius);
            font-size: 15px;
            resize: vertical;
        }

        textarea { min-height: 100px; }

        input:focus, textarea:focus {
            border-color: var(--primary);
            outline: none;
        }

        button {
            background: var(--success);
            color: var(--white);
            border: none;
            padding: 14px;
            font-weight: 600;
            font-size: 16px;
            border-radius: var(--radius);
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover { background: #15803d; }

        .progress {
            text-align: center;
            color: var(--gray);
            margin-bottom: 15px;
        }

        @media (max-width: 480px) {
            body { padding: 20px; }
            .form-box { padding: 20px; }
            h2 { font-size: 20px; }
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>🧾 Add Question <?= htmlspecialchars($q_num) ?> / <?= htmlspecialchars($total) ?></h2>
    <div class="progress">Exam ID: <?= htmlspecialchars($exam_id) ?></div>

    <form method="POST">
        <label for="question">Question:</label>
        <textarea name="question" id="question" placeholder="Enter full question here..." required></textarea>

        <label>Option A:</label>
        <input type="text" name="option_a" placeholder="Enter option A" required>

        <label>Option B:</label>
        <input type="text" name="option_b" placeholder="Enter option B" required>

        <label>Option C:</label>
        <input type="text" name="option_c" placeholder="Enter option C" required>

        <label>Option D:</label>
        <input type="text" name="option_d" placeholder="Enter option D" required>

        <label for="correct_option">Correct Option:</label>
        <select name="correct_option" id="correct_option" required>
            <option value="">-- Select Correct Option --</option>
            <option value="a">A</option>
            <option value="b">B</option>
            <option value="c">C</option>
            <option value="d">D</option>
        </select>

        <button type="submit">💾 Save & Next</button>
    </form>
</div>

</body>
</html>
