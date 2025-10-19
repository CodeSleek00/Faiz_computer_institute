<?php
include '../db/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course_name   = $_POST['course_name'];
    $description   = $_POST['description'];
    $duration      = $_POST['duration'];
    $company       = $_POST['company'];
    $total_exams   = $_POST['total_exams'];
    $admission_fee = $_POST['admission_fee'];
    $monthly_fee   = $_POST['monthly_fee'];
    $exam_fee      = $_POST['exam_fee'];

    // Handle image upload
    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imagePath = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    // Insert course data
    $stmt = $conn->prepare("INSERT INTO courses (course_name, description, duration, image, company, total_exams, admission_fee, monthly_fee, exam_fee) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssiddd", $course_name, $description, $duration, $imagePath, $company, $total_exams, $admission_fee, $monthly_fee, $exam_fee);
    $stmt->execute();
    $course_id = $stmt->insert_id;
    $stmt->close();

    // Insert documents
    if (!empty($_POST['documents'])) {
        foreach ($_POST['documents'] as $doc) {
            if (trim($doc) != "") {
                $stmt = $conn->prepare("INSERT INTO course_documents (course_id, document_name) VALUES (?, ?)");
                $stmt->bind_param("is", $course_id, $doc);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Insert syllabus
    if (!empty($_POST['syllabus'])) {
        foreach ($_POST['syllabus'] as $topic) {
            if (trim($topic) != "") {
                $stmt = $conn->prepare("INSERT INTO course_syllabus (course_id, syllabus_item) VALUES (?, ?)");
                $stmt->bind_param("is", $course_id, $topic);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Insert additional fees
    if (!empty($_POST['additional_fee_name'])) {
        for ($i = 0; $i < count($_POST['additional_fee_name']); $i++) {
            $feeName = $_POST['additional_fee_name'][$i];
            $feeAmt  = $_POST['additional_fee_amount'][$i];
            if (trim($feeName) != "" && $feeAmt != "") {
                $stmt = $conn->prepare("INSERT INTO course_additional_fees (course_id, fee_name, fee_amount) VALUES (?, ?, ?)");
                $stmt->bind_param("isd", $course_id, $feeName, $feeAmt);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    echo "<script>alert('Course added successfully!'); window.location.href='add_course.php';</script>";
} else {
    echo "Invalid Request.";
}
?>
