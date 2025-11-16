<?php
require 'session_check.php';
require '../db_connect.php';
$student_id = $_SESSION['student_id'];

if($_SERVER['REQUEST_METHOD']==='POST'){
    $exam_id = intval($_POST['exam_id']);
    $exam = $conn->query("SELECT * FROM exams WHERE id=$exam_id")->fetch_assoc();
    $marks_per = $exam['marks_per_question'];
    $questions = $conn->query("SELECT * FROM questions WHERE exam_id=$exam_id");

    $correct=0; $wrong=0;

    $stmt = $conn->prepare("INSERT INTO student_exams (student_id, exam_id, total_questions) VALUES (?,?,?)");
    $stmt->bind_param("iii",$student_id,$exam_id,$exam['total_questions']);
    $stmt->execute();
    $student_exam_id = $stmt->insert_id;

    while($q=$questions->fetch_assoc()){
        $qid = $q['id'];
        $selected = $_POST['q'.$qid] ?? '';
        $is_correct = ($selected===$q['correct_option'])?1:0;
        if($is_correct) $correct++; else $wrong++;

        $stmt2 = $conn->prepare("INSERT INTO student_answers (student_exam_id, question_id, selected_option, is_correct) VALUES (?,?,?,?)");
        $stmt2->bind_param("iisi",$student_exam_id,$qid,$selected,$is_correct);
        $stmt2->execute();
    }

    $score = $correct * $marks_per;
    $conn->query("UPDATE student_exams SET score=$score, correct_answers=$correct, wrong_answers=$wrong WHERE id=$student_exam_id");

    header("Location: exam_result.php?id=$student_exam_id");
    exit();
}
