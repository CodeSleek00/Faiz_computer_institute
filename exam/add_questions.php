<?php
require '../db_connect.php';
$exam_id = intval($_GET['exam_id']);

// Fetch exam details
$exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
$total_questions = $exam['total_questions'];

// Count existing questions
$qcount = $conn->query("SELECT COUNT(*) as cnt FROM questions WHERE exam_id=$exam_id")->fetch_assoc()['cnt'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $question = $_POST['question_text'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $correct = $_POST['correct_option'];

    $stmt = $conn->prepare("INSERT INTO questions (exam_id, question_text, option_a, option_b, option_c, option_d, correct_option) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("issssss",$exam_id,$question,$a,$b,$c,$d,$correct);
    $stmt->execute();
    header("Location: add_questions.php?exam_id=$exam_id");
    exit();
}

$questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");
?>

<h2>Add Questions for <?= htmlspecialchars($exam['exam_name']) ?></h2>

<?php if($qcount < $total_questions): ?>
<form method="POST">
    <textarea name="question_text" placeholder="Question" required></textarea><br>
    <input name="option_a" placeholder="Option A" required>
    <input name="option_b" placeholder="Option B" required><br>
    <input name="option_c" placeholder="Option C" required>
    <input name="option_d" placeholder="Option D" required><br>
    <select name="correct_option" required>
        <option value="">Correct Option</option>
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select><br>
    <button type="submit">Add Question</button>
</form>
<?php else: ?>
    <p>All questions added! ✅ Now assign this exam to students.</p>
    <a href="assign_exam.php?exam_id=<?= $exam_id ?>">Assign to Students</a>
<?php endif; ?>

<h3>Existing Questions</h3>
<ol>
<?php while($q=$questions->fetch_assoc()): ?>
    <li><?= htmlspecialchars($q['question_text']) ?> (Correct: <?= $q['correct_option'] ?>)</li>
<?php endwhile; ?>
</ol>
