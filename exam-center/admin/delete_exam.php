<?php
include 'db_connect.php';

if (isset($_GET['exam_id'])) {
    $exam_id = intval($_GET['exam_id']);

    // Begin transaction for data consistency
    $conn->begin_transaction();

    try {
        // Delete related data safely using prepared statements
        $stmt1 = $conn->prepare("DELETE FROM exam_questions WHERE exam_id = ?");
        $stmt1->bind_param("i", $exam_id);
        $stmt1->execute();

        $stmt2 = $conn->prepare("DELETE FROM exam_assignments WHERE exam_id = ?");
        $stmt2->bind_param("i", $exam_id);
        $stmt2->execute();

        $stmt3 = $conn->prepare("DELETE FROM exam_submissions WHERE exam_id = ?");
        $stmt3->bind_param("i", $exam_id);
        $stmt3->execute();

        $stmt4 = $conn->prepare("DELETE FROM exams WHERE exam_id = ?");
        $stmt4->bind_param("i", $exam_id);
        $stmt4->execute();

        // Commit transaction
        $conn->commit();

        header("Location: exam_dashboard.php?delete_success=1");
        exit;
    } catch (Exception $e) {
        // Rollback if something fails
        $conn->rollback();
        echo "Error deleting exam: " . $e->getMessage();
    }
} else {
    echo "Invalid request. Exam ID missing.";
}
?>
