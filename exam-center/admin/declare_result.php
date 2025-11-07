<?php
include 'db_connect.php';

if (!isset($_GET['exam_id']) || !is_numeric($_GET['exam_id'])) {
    die("⚠️ Invalid exam ID.");
}

$exam_id = intval($_GET['exam_id']);

try {
    // Check if exam exists
    $check = $conn->prepare("SELECT exam_id, result_declared FROM exams WHERE exam_id = ?");
    $check->bind_param("i", $exam_id);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        die("❌ Exam not found.");
    }

    $exam = $result->fetch_assoc();

    // Prevent duplicate declaration
    if ($exam['result_declared'] == 1) {
        echo "<script>alert('Result already declared for this exam!'); window.location='exam_dashboard.php';</script>";
        exit;
    }

    // Update exam record
    $stmt = $conn->prepare("UPDATE exams SET result_declared = 1 WHERE exam_id = ?");
    $stmt->bind_param("i", $exam_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('✅ Result declared successfully!'); window.location='exam_dashboard.php?success=1';</script>";
    } else {
        echo "<script>alert('⚠️ No changes made.'); window.location='exam_dashboard.php';</script>";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
