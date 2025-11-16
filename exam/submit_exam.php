<?php
require 'session_check.php';
require '../db_connect.php';

$student_id = $_SESSION['student_id']; // FAIZ-Olevelmod-1001

if($_SERVER['REQUEST_METHOD']==='POST'){
    $exam_id = intval($_POST['exam_id']);

    // Fetch exam details
    $exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
    if(!$exam){
        die("Invalid Exam!");
    }
    $marks_per = $exam['marks_per_question'];

    // Fetch questions
    $questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");

    $correct = 0;
    $wrong = 0;

    // Insert new student_exam record (Multiple attempts allowed)
    $stmt = $conn->prepare("INSERT INTO student_exams (student_id, exam_id, total_questions) VALUES (?,?,?)");
    $stmt->bind_param("ssi",$student_id,$exam_id,$exam['total_questions']);
    $stmt->execute();
    $student_exam_id = $stmt->insert_id;

    // Insert each answer and calculate correct/wrong
    while($q = $questions->fetch_assoc()){
        $qid = $q['id'];
        $selected = $_POST['q'.$qid] ?? '';
        $is_correct = ($selected === $q['correct_option']) ? 1 : 0;
        if($is_correct) $correct++; else $wrong++;

        $stmt2 = $conn->prepare("
            INSERT INTO student_answers 
            (student_exam_id, question_id, selected_option, is_correct) 
            VALUES (?,?,?,?)
        ");
        $stmt2->bind_param("iisi",$student_exam_id,$qid,$selected,$is_correct);
        $stmt2->execute();
    }

    $score = $correct * $marks_per;

    // Update student_exam with score & stats
    $conn->query("
        UPDATE student_exams 
        SET score=$score, correct_answers=$correct, wrong_answers=$wrong 
        WHERE id=$student_exam_id
    ");

    // Redirect to result page
    header("Location: exam_result.php?id=$student_exam_id");
    exit();
}
?>
